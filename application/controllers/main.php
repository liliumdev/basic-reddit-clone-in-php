<?php

class Main extends Controller 
{	
	function index()
	{
		$template = $this->view('index');
		$template->render();
	}    

	function test($varijabla1, $varijabla2, $varijabla3)
	{
		echo $varijabla1;
	}
}

?>
