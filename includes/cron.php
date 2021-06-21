<?php
  define("_AXES_ALLOWED", true);
  require_once("init.php");
?>
<?php
	//0 * * * * /usr/bin/touch /public_html/includes/cron-test.txt >/dev/null 2>&1
	//0 * * * * /usr/bin/php /public_html/includes/cron.php >/dev/null 2>&1

//	if (php_sapi_name() == 'cli') {   
	//   if (isset($_SERVER['TERM'])) {   
	//      die("The script was run from a manual invocation on a shell");   
	//   } else {   
	      $core->setCron();
	      $user->cronUpdateInvestments();   
	//   }   
	//} else { 
	//   die("The script was run from a webserver, or something else");   
	//}

?>