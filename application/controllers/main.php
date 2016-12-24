<?php

class Main extends Controller 
{	
	function index_get()
	{
		$this->view('index')->render();
	}    

	function login_get()
	{
		$this->view('login')->render();
	}  

	function login_post()
	{
		$v = $this->validator($this->post(), array(
			'username' => 'required',
			'password' => 'required|min:8|max:16'
			)
		);

		if(!$v->validate())
		{
			$view = $this->view('login');
			$view->set('errors', $v->errors);
			$view->render();
		}
	}

	function register_get()
	{
		$this->view('register')->render();
	}  	

	function register_post()
	{
		$v = $this->validator($this->post(), array(
			'username'  => 'required',
			'password'  => 'required|min:8|identical:password2',
			'password2' => 'required',
			'email'     => 'required|email'
			)
		);

		if(!$v->validate())
			$this->view('register')->set('errors', $v->errors)->render();


		// Je li vec postoji acc sa ovim username-om ili e-mailom ?

	}

	function test($varijabla1, $varijabla2, $varijabla3)
	{
		echo $varijabla1;
	}
}

?>
