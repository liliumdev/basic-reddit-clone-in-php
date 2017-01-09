<?php

require_once(ROOT_DIR . 'vendor/fpdf/pdf.php');


class Subs extends Controller 
{	
	function sub_get($title, $sortBy = 'votes')
	{
		$subreddit = $this->model('Subreddit')->first(array('title' => $title));
		$orderClause = '';
		if($sortBy == 'votes')
			$orderClause = 'ORDER BY votes DESC';
		else if($sortBy == 'new')
			$orderClause = 'ORDER BY created_at DESC';
		else
			$orderClause = 'ORDER BY comments DESC';

		//$posts = $this->model('Post')->find(array('subreddit_id' => $subreddit->id), 'and', false, $orderClause);

		$postsSel = $this->model('Post')->query("SELECT posts.*, users.username FROM posts, users WHERE posts.subreddit_id = ? AND posts.author_id = users.id " . $orderClause, array($subreddit->id));
		$posts = $postsSel->fetchAll(PDO::FETCH_CLASS);

		$this->view('subreddit')->set('subreddit', $subreddit)->set('posts', $posts)->render();
	}

	function sub_post_get($id)
	{
		$post = $this->model('Post')->first(array('id' => $id));
		if($post == null)
		{
			$this->redirect('');
			return;
		}

		$subreddit = $this->model('Subreddit')->first(array('id' => $post->subreddit_id));
		$comStat = $this->model('Comment')->query("SELECT comments.*, users.username FROM comments, users WHERE comments.post_id = ? AND comments.author_id = users.id ORDER BY comments.votes DESC", array($id));
		$comments = $comStat->fetchAll(PDO::FETCH_ASSOC);

		$this->view('post')->set('post', $post)->set('comments', $comments)->set('subreddit', $subreddit)->render();
	}

	function delete_post_get($id)
	{
		if(!$this->loggedIn())
		{
	        $this->redirect('');
			return;
		}

		$post = $this->model('Post')->first(array('id' => $id));
		if($post == null)
		{
			$this->redirect('');
			return;
		}
		
		$subreddit = $this->model('Subreddit')->first(array('id' => $post->subreddit_id));

		if($post->author_id == $_SESSION['user_id'])
			$post->delete();

		$this->redirect('/subs/sub/' . $subreddit->title);
	}

	function create_post_get($id)
	{
		if(!$this->loggedIn())
		{
	        $this->redirect('');
			return;
		}

		$subreddit = $this->model('Subreddit')->first(array('id' => $id));

		$this->view('post_create')->set('subreddit', $subreddit)->render();
	}

	function create_comment_post($id)
	{
		if(!$this->loggedIn())
		{
	        $this->redirect('');
			return;
		}

		$post = $this->model("Post")->first(array('id' => $id));
		if($post == null)
		{
			$this->redirect('');
			return;
		}

		$v = $this->validator($this->post(), array(
			'content' => 'required|alphaplus'
			)
		);

		if(!$v->validate())
		{	
			$subreddit = $this->model('Subreddit')->first(array('id' => $post->subreddit_id));
			$comStat = $this->model('Comment')->query("SELECT comments.*, users.username FROM comments, users WHERE comments.post_id = ? AND comments.author_id = users.id ORDER BY comments.votes DESC", array($id));
			$comments = $comStat->fetchAll(PDO::FETCH_ASSOC);
			$this->view('post')->set('post', $post)->set('errors', $v->errors)->set('comments', $comments)->set('subreddit', $subreddit)->message('error', 'Could not add post (disallowed characters in content)')->render();
			return;
		}

	    $comment = $this->model('Comment');
	    $comment->post_id = $post->id;
	    $comment->content = $this->post('content');
	    $comment->author_id = $_SESSION['user_id'];
	    $comment->votes = 1;
	    $comment->save();

	    $post->comments = $post->comments + 1;
	    $post->save();

		$this->redirect('/subs/sub_post/' . $post->id);
	}

	function create_post_post($id)
	{
		if(!$this->loggedIn())
		{
	        $this->redirect('');
			return;
		}

		$v = $this->validator($this->post(), array(
			'title' => 'required|alphaplus',
			'content' => 'required|alphaplus'
			)
		);

		if(!$v->validate())
		{
			$this->view('post_create')->set('errors', $v->errors)->message('error', 'Could not add post')->render();
			return;
		}

		$subreddit = $this->model('Subreddit')->first(array('id' => $id));

	    $post = $this->model('Post');
	    $post->subreddit_id = $subreddit->id;
	    $post->title = $this->post('title');
	    $post->content = $this->post('content');
	    $post->author_id = $_SESSION['user_id'];
	    $post->votes = 1;
	    $post->comments = 0;
	    $post->save();

		$this->redirect('/subs/sub/' . $subreddit->title);
	}

	function subscribe_get($id)
	{
		if(!$this->loggedIn())
		{
	        $this->redirect('');
			return;
		}

		$subscription = $this->model('Subscriber')->first(array('user_id' => $_SESSION['user_id'], 'subreddit_id' => $id));
		if($subscription != null)
		{
			$this->redirect('');
			return;
		}		

		$sub = $this->model('Subscriber');
		$sub->user_id = $_SESSION['user_id'];
		$sub->subreddit_id = $id;
		$sub->save();

		$subreddit = $this->model('Subreddit')->first(array('id' => $id));
		$subreddit->subscribers = $subreddit->subscribers + 1;
		$subreddit->save();

        $this->redirect('/main/subreddits');
	}

	function unsubscribe_get($id)
	{
		if(!$this->loggedIn())
		{
	        $this->redirect('');
			return;
		}

		$subscription = $this->model('Subscriber')->first(array('user_id' => $_SESSION['user_id'], 'subreddit_id' => $id));
		if($subscription == null)
		{
			$this->redirect('');
			return;
		}		

		$subscription->delete();

		$subreddit = $this->model('Subreddit')->first(array('id' => $id));
		$subreddit->subscribers = $subreddit->subscribers - 1;
		$subreddit->save();

        $this->redirect('/main/subreddits');
	}

	function create_get()
	{
		if(!$this->isAdmin())
	        $this->redirect('');

		$this->view('subreddit_create')->render();
	}

	function create_post()
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $v = $this->validator($this->post(), array(
			'title' => 'required|alphanumeric',
			'description' => 'required|alphaplus'
			)
		);

		if(!$v->validate())
		{
			$this->view('subreddit_create')->set('errors', $v->errors)->message('error', 'Could not add subreddit')->render();
			return;
		}

	    $sub = $this->model('Subreddit');
	    $sub->title = $this->post('title');
	    $sub->description = $this->post('description');
	    $sub->subscribers = 0;
	    $sub->save();

        $this->redirect('/main/subreddits');
	}

	function edit_get($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $sub = $this->model('Subreddit')->getById($id);
		$this->view('subreddit_edit')->set('subreddit', $sub)->render();
	}   

	function edit_post($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $v = $this->validator($this->post(), array(
			'title' => 'required|alphanumeric',
			'description' => 'required|alphaplus'
			)
		);

		if(!$v->validate())
		{
			$this->view('subreddit_edit')->set('errors', $v->errors)->message('error', 'Could not edit subreddit')->render();
			return;
		}

	    $sub = $this->model('Subreddit')->getById($id);
	    $sub->title = $this->post('title');
	    $sub->description = $this->post('description');
	    $sub->save();

        $this->redirect('/main/subreddits');
	}     

	function delete_get($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $subreddit = $this->model('Subreddit')->getById($id);
	    $subreddit->delete();
        $this->redirect('/main/subreddits');
	}  

	function reportcsv_get()
	{
		$name = 'static/reports/csv/sub_report_' . date('dmY') . '.csv';
		$path = ROOT_DIR . $name;
		$subs = $this->model('Subreddit')->all();
		$fp = fopen($name, 'w');
		foreach($subs as $sub)
			fputcsv($fp, array($sub->id, $sub->title, $sub->description, $sub->subscribers));

		fclose($fp);

		$this->redirect($name);
	}

	function reportpdf_get()
	{
		$subs = $this->model('Subreddit')->all();
		$data = [];
		foreach($subs as $sub)
			$data[] = array($sub->id, $sub->title, $sub->subscribers);

		$pdf = new PDF();

		$header = array('ID', 'Subreddit title', 'Subscribers');
		$data = $pdf->LoadData($data);
		$pdf->SetFont('Arial', '', 14);
		$pdf->AddPage();
		$pdf->FancyTable($header, $data);
		$pdf->Output();
	}

}

?>
