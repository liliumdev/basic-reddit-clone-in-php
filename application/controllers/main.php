<?php

class Main extends Controller 
{	
	function index_get()
	{
		$postsSel = $this->model('Post')->query("SELECT posts.*, users.username FROM posts, users WHERE posts.author_id = users.id ORDER BY votes DESC LIMIT 20", array());
		$posts = $postsSel->fetchAll(PDO::FETCH_CLASS);

		$latestPosts = $this->model('Post')->find(array(), 'and', false, 'ORDER BY created_at DESC LIMIT 5');
		$latestUsers = $this->model('User')->find(array(), 'and', false, 'ORDER BY id DESC LIMIT 5');
		$this->view('index')->set('posts', $posts)->set('latestPosts', $latestPosts)->set('latestUsers', $latestUsers)->render();
	}    

	function login_get()
	{
		if($this->loggedIn())
	        $this->redirect('');

		$this->view('login')->render();
	}  

	function logout_get()
	{
		if($this->loggedIn())
		{
			unset($_SESSION['user']);
			session_destroy();
		}

        $this->redirect('');
	}  

	function login_post()
	{
		if($this->loggedIn())
	        $this->redirect('');

		$v = $this->validator($this->post(), array(
			'username' => 'required',
			'password' => 'required|min:8|max:16'
			)
		);

		if(!$v->validate())
		{
			$this->view('login')->set('errors', $v->errors)->render();
			return;
		}

		$user = $this->model('User')->first(array('username' => $this->post('username')));
		if($user !== null && password_verify($this->post('password'), $user->password))
		{
	        $_SESSION['user'] = $this->post('username');
	        $_SESSION['user_id'] = $user->id;
	        $this->redirect('');
	        return;
		}

		$this->view('login')->message('error', 'Wrong credentials.')->render();
		return;

	}

	function register_get()
	{
		if($this->loggedIn())
	        $this->redirect('');

		$this->view('register')->render();
	}  	


	function register_post()
	{
		if($this->loggedIn())
	        $this->redirect('');

		$v = $this->validator($this->post(), array(
			'username'  => 'required',
			'password'  => 'required|min:8|identical:password2',
			'password2' => 'required',
			'email'     => 'required|email'
			)
		);

		if(!$v->validate())
			$this->view('register')->set('errors', $v->errors)->message('error', 'Could not register.')->render();


		// Je li vec postoji acc sa ovim username-om ili e-mailom ?
		if($this->model('User')->first(array('username' => $this->post('username'), 'email' => $this->post('email')), 'or') !== null)
		{
			$this->view('register')->set('errors', array('A user with the same username or email already exists.'))->message('error', 'Could not register.')->render();
			return;
		}

		// Mozemo registrovati korisnika
		$korisnik           = $this->model('User');
		$korisnik->username = $this->post('username');
		$korisnik->password = password_hash($this->post('password'), PASSWORD_DEFAULT);
		$korisnik->email    = $this->post('email');
		$korisnik->save();

		$this->view('login')->message('success', 'You have successfully registered, now you can log in.')->render();
	}

	function about_get()
	{
		$this->view('about')->render();
	} 

	function subreddits_get()
	{		
		$subscribed = [];

		if($this->loggedIn())
		{
			$subscriptions = $this->model('Subscriber')->find(array('user_id' => $_SESSION['user_id']));
			foreach($subscriptions as $subscription)
				$subscribed[] = $subscription->subreddit_id;
		}

		$this->view('subreddits')->set('subreddits', $this->model('Subreddit')->find(array(), 'and', false, 'ORDER BY subscribers DESC'))->set('subscribed', $subscribed)->render();
	}

	function search_get()
	{
		$this->view('search')->render();
	}

	function search_ajax_post($max)
	{
		if(!is_numeric($max))
		{
			echo "Wrong max param.";
			return;
		}
		
		$query = $this->post('query');

		/*
		// Ovo je za XML
		$subreddits = $this->model('Subreddit')->findNodesWithInConditions(array('title' => $query, 'description' => $query), ( (int)$max != -1 ? (int)$max : false));
		echo json_encode($subreddits);
		*/

		// Ovo je za MySQL model
		$subreddits = $this->model('Subreddit')->find(array('title' => array($query), 'description' => array($query)), 'like_or', ( (int)$max != -1 ? (int)$max : false));
		$json_subs = [];
		foreach($subreddits as $sub)
			$json_subs[] = $sub->toArray();
		echo json_encode($json_subs);
	}


	function admin_get()
	{
		if(!$this->isAdmin())
	        $this->redirect('');

		$this->view('admin')->render();
	}  	

	function import_xml_get()
	{
		if(!$this->isAdmin())
	        $this->redirect('');

        $subreddits = $this->model('SubredditXML')->all();
        $users = $this->model('UserXML')->all();

        foreach($subreddits as $sub)
        {
    		$sqlSub = $this->model('Subreddit');
    		if($sqlSub->first(array('title' => $sub->title)) == null)
    		{
    			foreach($sub->toArray() as $k => $v)
	        	{
	        		if($k != 'id')
	        			$sqlSub->$k = $v;
	        	}
	        	$sqlSub->save();
    		}
        }

        foreach($users as $user)
        {
        	$sqlUser = $this->model('User');
        	if($sqlUser->first(array('username' => $user->username, 'email' => $user->email), 'or') == null)
    		{
	        	foreach($user->toArray() as $k => $v)
	        	{
	        		if($k != 'id')
	        			$sqlUser->$k = $v;
	        	}
	        	$sqlUser->save();
	        }
        }


		$this->view('index')->message('success', 'Import finished.')->render();
        
	}
}

?>
