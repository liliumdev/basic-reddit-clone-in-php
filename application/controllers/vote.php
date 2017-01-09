<?php

class Vote extends Controller 
{	
	function post_post($id, $direction)
	{
		$post = $this->model('Post')->first(array("id" => $id));

		if($post == null)
			return;

		if(!$this->loggedIn())
			echo $post->votes;

		$uservote = $this->model('UserVote')->first(array("user_id" => $_SESSION['user_id'], "post_id" => $id));
		$votes = ($direction == "up") ? 1 : -1;
		if($uservote == null)
		{
			$newVote = $this->model('UserVote');
			$newVote->user_id = $_SESSION['user_id'];
			$newVote->post_id = $post->id;
			$newVote->value = $votes;
			$newVote->save();

			$post->votes = $post->votes + $votes;
			$post->save();
		}
		else 
		{
			if($uservote->value != $votes)
			{
				$post->votes = $post->votes + $votes;
				$post->save();
			}
			
			$uservote->value = $votes;
			$uservote->save();
		}


		echo $post->votes;
	}

	function comment_post($id, $direction)
	{
		$comment = $this->model('Comment')->first(array("id" => $id));

		if($comment == null)
			return;

		if(!$this->loggedIn())
			echo $comment->votes;

		$uservote = $this->model('UserCommentVote')->first(array("user_id" => $_SESSION['user_id'], "comment_id" => $id));
		$votes = ($direction == "up") ? 1 : -1;
		if($uservote == null)
		{
			$newVote = $this->model('UserCommentVote');
			$newVote->user_id = $_SESSION['user_id'];
			$newVote->comment_id = $comment->id;
			$newVote->value = $votes;
			$newVote->save();

			$comment->votes = $comment->votes + $votes;
			$comment->save();
		}
		else 
		{
			if($uservote->value != $votes)
			{
				$comment->votes = $comment->votes + $votes;
				$comment->save();
			}
			
			$uservote->value = $votes;
			$uservote->save();
		}


		echo $comment->votes;
	}
}

?>
