<?php
 
include(APP_DIR . 'config/config.php');

class DB
{
	 
	protected static $db;
	 
	private function __construct() 
	{	 
		global $config;

		try 
		{
			self::$db = new PDO('mysql:host=' . $config['mysql_host'] . ';dbname=' . $config['mysql_db'], $config['mysql_username'], $config['mysql_password']);
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) 
		{
			echo "PDO error: " . $e->getMessage();
		}
	 
	}
	 
	public static function get() 
	{	 
		if (!self::$db) 
		{
			new DB();
		}
	 
		return self::$db;
	}
 
}
 
?>