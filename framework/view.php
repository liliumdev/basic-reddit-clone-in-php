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

	public function isPartlyActive($url)
	{
		echo (strpos($_SERVER['REQUEST_URI'], $url) !== false ? ' class="active"' : '');
	}

	public function isNotPartlyActive($url)
	{
		echo (strpos($_SERVER['REQUEST_URI'], $url) === false ? ' class="active"' : '');
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

	public function time_since($ptime) 
	{
	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}
    
}

?>