<?php 

$config['base_url'] = 'http://php-brcip.44fs.preview.openshiftapps.com/'; 			// Bazni URL ukljucujuci / na kraju (e.g. http://google.com/)
$config['default_index_controller'] = 'main'; 	// Defaultni controller koji se učitava ako nije specificiran
$config['default_error_controller'] = 'error'; 	// Defaultni controller koji se učitava pri raznim greškama

$config['mysql_host'] = getenv('OPENSHIFT_MYSQL_DB_HOST');
$config['mysql_username'] = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
$config['mysql_password'] = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
$config['mysql_db'] = 'basicreddit';



?>