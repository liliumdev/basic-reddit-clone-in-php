<?php

class URL 
{
	function base_url()
	{
		global $config;
		return $config['base_url'];
	}
	
	function segment($seg)
	{		
		$parts = explode('/', $_SERVER['REQUEST_URI']);
	    return isset($parts[$seg]) ? $parts[$seg] : false;
	}	
}

?>