<?php

 
	 if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');
	 
	 // Error Reporting Turn On
	 ini_set('error_reporting', E_ALL);
	 //error_reporting(false);

 
	/** 
	* Database Constants - these constants refer to 
	* the database configuration settings. 
	*/
	 define('DB_SERVER', 'localhost'); 
	 define('DB_USER', 'frosttra_frosttrader'); 
	 define('DB_PASS', '@frosttrader!'); 
	 define('DB_DATABASE', 'frosttra_frosttrader');
 
	/** 
	* Show MySql Errors. 
	* Not recomended for live site. true/false 
	*/
	 define('DEBUG', false);
?>