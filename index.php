<?php

session_start(); 

define('ROOT_DIR', realpath(dirname(__FILE__)) . '/');
define('APP_DIR', ROOT_DIR . 'application/');

require(APP_DIR  . 'config/config.php');
require(ROOT_DIR . 'framework/model.php');
require(ROOT_DIR . 'framework/view.php');
require(ROOT_DIR . 'framework/controller.php');
require(ROOT_DIR . 'framework/framework.php');

global $config;
define('BASE_URL', $config['base_url']);

setup_framework();

?>
