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
		return $this;
	}

	public function message($type, $msg)
	{
		$this->pageVariables['_message'] = $msg;
		$this->pageVariables['_messageType'] = $type;
		return $this;
	}

	public function render()
	{
		// Uvijek neka view ima informaciju da li smo loginovani
		// ili ne
		$_loggedIn = false;
		if(isset($_SESSION['user']))
			$_loggedIn = true;

		extract($this->pageVariables);

		ob_start();
		require($this->baseTemplate);
		echo ob_get_clean();
	}

	public function isActive($url)
	{
		if($_SERVER['REQUEST_URI'] == $url)
			echo ' class="active" ';
	}

	public function printErrorsForForms()
	{
		if(array_key_exists('errors', $this->pageVariables))
		{
			echo "<ul class='form-errors'>";
			foreach($this->pageVariables['errors'] as $error)
				echo "<li>$error</li>";
			echo "</ul>";
		}
	}
    
}

?>