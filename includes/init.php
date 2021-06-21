<?php

  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');

  $form = array();
  $form_error = array();

  if(!isset($debug_error)) $debug_error = array();
  else if (!is_array($debug_error))  $debug_error = array();
  
  $BASEPATH = str_replace("init.php", "", realpath(__FILE__));
  
  define("BASEPATH", $BASEPATH);
  
  require_once('config.ini.php');
  
  require_once("db.php");

  $con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
      // to read a connection error access the member properties
      if(DEBUG)array_push($debug_error, $con->connect_errno,'<br>');
  
	require_once("registry.php");

  Registry::set('Database',new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE));
  $db = Registry::get("Database");
  $db->connect();
  
  //Include Functions
  require_once(BASEPATH . "functions.php");
  start_form();

  //set referral
  if(isset($_GET['ref']) && !empty($_GET['ref'])) $_SESSION['ref'] = $_GET['ref'];


  //Start Mail Class
  require ('mail/PHPMailer.php');
  require ('mail/Exception.php');
	
  //Start Csrf Class 
  require_once('csrf.php');
  Registry::set('Csrf',new CSRF_Protect());
  $csrf = Registry::get("Csrf");

  //Start Core Class 
  require_once(BASEPATH . "class_core.php");
  Registry::set('Core',new Core());
  $core = Registry::get("Core");
   
  define("SITEURL", $core->site_url);
  define("TIMEZONE", 'Asia/Manila');
  // Setting up the time zone
  date_default_timezone_set(TIMEZONE);
  define("ADMINURL", $core->site_url."/admin");

  //Start Coinpayments
  //require_once('cpay.php');
  
  //Start Browser Detection Class
  require_once('BrowserDetection.php');
  
  //StartUser Class 
  require_once(BASEPATH . "class_user.php");
  Registry::set('User',new User($core));
  $user = Registry::get("User");

  if(check_path("/about") || check_path("/") || check_path("") || check_path("/index") || isset($_SESSION['admin'])) {
    require_once(BASEPATH . "class_about.php");
    Registry::set('About',new About());
    $about = Registry::get("About");
  }

  if(check_path("/review") || isset($_SESSION['admin'])) {
    require_once(BASEPATH . "class_reviews.php");
    Registry::set('Reviews',new Reviews());
    $review = Registry::get("Reviews");
  }

  if(check_path("/faq") || isset($_SESSION['admin'])) {
    require_once(BASEPATH . "class_faq.php");
    Registry::set('Faq',new Faq());
    $faq = Registry::get("Faq");
  }

  if(check_path("/investment") || check_path("/") || check_path("") || check_path("/index") || check_path("/invest.php") || check_path("/deposit.php")) {
    require_once(BASEPATH . "class_plan.php");
    Registry::set('Plan',new Plan());
    $investment = Registry::get("Plan");
  }

  if(true) {
    require_once(BASEPATH . "class_landing.php");
    Registry::set('Landing',new Landing());
    $landing = Registry::get("Landing");
  }

  if(check_path("/pages") || isset($_SESSION['admin'])) {
    require_once(BASEPATH . "class_pages.php");
    Registry::set('Pages',new Pages());
    $pages = Registry::get("Pages");
  }

  //check if on maintenance mode
  if($core->maintenance_mode && (!check_path("admin") || !check_path("/maintenance"))){
    redirect_to(SITEURL."/maintenance.php");
  }

  //check if on auto verify
  if(!$core->auto_verify && check_path('/activate')){
    redirect_to(SITEURL."/index.php");
  }
  
  //redirect user if logged in already
  if(isset($_SESSION['user']) && (check_path("/login.") || check_path("/register") || check_path("/forgot") || check_path("/reset") || check_path("/activate")))  redirect_to("../index.php");

  // restrict logged in access
  if(!isset($_SESSION['user']) && check_path("/user")){
    redirect_to("../login.php");
  }

  // restrict logged in access
  if(!isset($_SESSION['admin']) && check_path("/admin")){
    redirect_to("../login.php");
  }

  if(isset($_SESSION['user']) && (check_path("/profile-login") || check_path("/profile-setting"))){
    $user->login_activity();
  }

  if(isset($_SESSION['user']) && check_path("/profile-withdrawal")){
    $user->withdrawal_activity();
  }

  if(isset($_SESSION['user']) && check_path("/profile-deposits")){
    $user->deposit_activity();
  }

  if(isset($_SESSION['user']) && check_path("/profile-referral")){
    $user->referral_activity();
  }

  //check if cron is running
  if(isset($_SESSION['admin'])){
    if (file_exists(__DIR__.'./cron-test.php')) {
        clearstatcache(false,__DIR__.'./cron-test.php');
        if(time() - filemtime(__DIR__.'./cron-test.php') > 3600) {
          if (DEBUG) array_push($debug_error, '"warning, cron not running"','<br>');
        }
    }
  }
  interprete_form();
?>