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
	
	public function redirect($loc)
	{
		global $config;
		
		header('Location: ' . $config['base_url'] . $loc);
	}    
}

?>