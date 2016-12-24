<?php

function setup_framework()
{
	global $config;
    
    $controller = $config['default_index_controller'];
    $action = 'index';
    $url = '';
	
	$requested_url 	  = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	$this_script_url  = (isset($_SERVER['PHP_SELF'])) 	 ? $_SERVER['PHP_SELF']    : '';
    	
	// Uzmi trazeni URL i obrisi viska '/'' karaktere s lijeva i desna
	if($requested_url != $this_script_url) 
		$url = trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $this_script_url)) . '/', '', $requested_url, 1), '/');
    
	$segments = explode('/', $url);

	if(isset($segments[0]) && $segments[0] != '') $controller = $segments[0];
	if(isset($segments[1]) && $segments[1] != '') $action 	  = $segments[1];

	// Nadji odgovarajuci kontroler (prvi segment)
    $path = APP_DIR . 'controllers/' . $controller . '.php';

	if(file_exists($path))
	{
        require_once($path);
	} 
	else 
	{
        $controller = $config['default_error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
	}
    
    // Je li ovaj kontroler ima ovu akciju? Ako nema, pozovi defaultnu
    // Funkcija mora biti striktno definisana za tip requesta (get ili post)
	$action = $action . '_' . strtolower($_SERVER['REQUEST_METHOD']);
    if(!method_exists($controller, $action)){
        $controller = $config['default_error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
        $action = 'index';
    }
	
	// Pozovi datu akciju kontrolera sa svim preostalim parametrima (segmentima)

	$obj = new $controller;
    die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
}

?>
