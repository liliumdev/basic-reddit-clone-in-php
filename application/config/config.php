<?php 

$config['base_url'] = 'http://phps-brcip2.44fs.preview.openshiftapps.com/'; 			// Bazni URL ukljucujuci / na kraju (e.g. http://google.com/)
$config['default_index_controller'] = 'main'; 	// Defaultni controller koji se učitava ako nije specificiran
$config['default_error_controller'] = 'error'; 	// Defaultni controller koji se učitava pri raznim greškama

$config['mysql_host'] = getenv('MYSQL_SERVICE_HOST');
$config['mysql_username'] = 'liliumdev';
$config['mysql_password'] = 'open123shift123pw';
$config['mysql_db'] = 'basicreddit';



?>