<?php

class View 
{
	private $baseTemplate;
	private $pageVariables = array();

	public function __construct($template)
	{
		$this->baseTemplate = APP_DIR . 'views/' . $template . '.php';
	}

	public function set($var, $val)
	{
		$this->pageVariables[$var] = $val;
	}

	public function render()
	{
		extract($this->pageVariables);

		ob_start();
		require($this->baseTemplate);
		echo ob_get_clean();
	}
    
}

?>