<?php

class Controller 
{	
	public function model($name)
	{
		require(APP_DIR . 'models/' . strtolower($name) . '.php');

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
		require(APP_DIR . 'utilities/' . strtolower($name) . '.php');

		$helper = new $name;
		return $helper;
	}

	public function validator($input, $rules)
	{
		require(APP_DIR . 'utilities/validator.php');

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
}

?>