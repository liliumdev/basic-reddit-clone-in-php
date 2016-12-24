<?php

class Controller 
{	
	public function model($name)
	{
		require_once(APP_DIR . 'models/' . strtolower($name) . '.php');

		$model = new $name;
		return $model;
	}
	
	public function view($name)
	{
		$view = new View($name);
		return $view;
	}
		
	public function utility($name)
	{
		require_once(APP_DIR . 'utilities/' . strtolower($name) . '.php');

		$helper = new $name;
		return $helper;
	}

	public function validator($input, $rules)
	{
		require_once(APP_DIR . 'utilities/validator.php');

		$validator = new Validator($input, $rules);
		return $validator;
	}
	
	public function redirect($loc)
	{
		global $config;
		
		header('Location: ' . $config['base_url'] . $loc);
	}   

	public function post($field = null)
	{
		if($field == null)
			return $_POST;

		if(isset($_POST[$field]))
			return $_POST[$field];

		return null;
	} 

	public function loggedIn()
	{		
		return isset($_SESSION['user']);
	}

	public function isAdmin()
	{
		return $this->loggedIn() && $_SESSION['user'] == 'admin';
	}
}

?>