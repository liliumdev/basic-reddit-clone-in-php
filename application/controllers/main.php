<?php

class Main extends Controller 
{	
	function index_get()
	{
		$this->view('index')->render();
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
		$this->view('subreddits')->set('subreddits', $this->model('Subreddit')->all())->render();
	}

	function search_get()
	{
		$this->view('search')->render();
	}

	function search_ajax_post($max)
	{
		$query = $this->post('query');
		$subreddits = $this->model('Subreddit')->findNodesWithInConditions(array('title' => $query, 'description' => $query), ( (int)$max != -1 ? (int)$max : false));
		echo json_encode($subreddits);
	}
}

?>
