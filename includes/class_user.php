<?php
	 if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');

	class User{

	    const uTable = "user";
	    const lTable = "login";
    	const dTable = "deposit";
    	const wTable = "withdrawal";
    	const rTable = "referral";
    	const pTable = "plan";
    	const iTable = "investments";
	  	const wmTable = "withdrawal_method";
		public $form = array();
		public $form_error = array();
	  	private static $db;
	  	public $core;
	  	public $last_login = "";
	  	public $ip = "";
	  	public $browser = "";
	  	public $location = "";
	  	public $activate_link = "";
	  
	  
	      function __construct($cored){
	      	  $this->core = $cored;

			  self::$db = Registry::get("Database");
			  $this->startSession();

			  if(isset($_SESSION['user'])) $this->account_balance();

			 //self::$db = Registry::get("Database");
			 // $this->getSettings();
	      }
	 

	      /**
	       * Users::startSession()
	       */
	        private function startSession(){
	          if (strlen(session_id()) < 1) session_start();
	        }

			  /**
			   * Users::captchaCheck()
			   */
		      private function captchaCheck($response){
			      	if($this->core->captcha_enabled){
				        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$this->core->captcha_secret.'&response='.$response);
				        $responseData = json_decode($verifyResponse);
				        if($responseData->success) return true;
				        else return false;
			    	}else return true;
		      }

			  /**
			   * Users::login()
			   */
			  public function login($username, $pass, $capt){
		      	  clean_form();
                  
                  $username = sanitize($username);
                  set_form('username',$username);
                  set_form('password',$pass);

			  	  if(!$this->core->allow_login){
					  set_form_error('login_error','Login is not allowed.');
					  return false;
				  }else if(!$this->captchaCheck($capt)){
					  set_form_error('login_error','Captcha error.');
					  return false;
				  }else if ($username == "") {
					  set_form_error('name_error','Enter a valid username.');
					  return false;
				  }else if ($pass == "") {
					  set_form_error('password_error','Enter a valid password.');
					  return false;
				  }else {
					  $status = $this->checkStatus($username, $pass);
		              switch ($status) {
		                  case 0:
		                      set_form_error('login_error','The login and / or password do not match in the database.');
		                      break;

		                  case 1:
		                      set_form_error('login_error','You must verify your email address before log in.<br> click <a href="'.SITEURL.'/activate.php"> Here to activate your account</a>');//probably insert a resend option here
		                      break;

		                  case 2:
		                      set_form_error('login_error','Your account is banned.');
		                      break;
		              }
		              if($status != 3) return false;;
				  }
		          if ($status == 3) {
		              $row = $this->getUserInfo($username);
		              $_SESSION['user'] = json_decode(json_encode($row), true);
		              if($row->admin) $_SESSION['admin'] = 1;

		              $browserz = new Wolfcast\BrowserDetection();
		              $locationz = json_decode(file_get_contents('http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR'].'?fields=status,country,city'));
		              $this->last_login = time();
		              $this->ip = sanitize($_SERVER['REMOTE_ADDR']);
		              $this->browser = sanitize($browserz->getName().' '.$browserz->getVersion());
		              $this->location = $locationz->city.', '.$locationz->country;
					  $data = array(
					  		'user_id' => $row->id,
					  		'time' => $this->last_login,
						    'ip' => $this->ip,
							'browser' => $this->browser,
							'location' => (($locationz->status = 'success') ? $this->location : "")
					  );
					  $_SESSION['last_login'] = $this->last_login;
					  self::$db->insert(self::lTable, $data);

					  //send mail
					  $subject = $this->core->name.' New Login';
					  $message = read_template('email-template/login.html',$this->core,$this);
					  send_mail($_SESSION['user']['email'],$_SESSION['user']['username'],$subject,$message,$this->core);
						  
					  return true;
				  }
			  }
	  
		      /**
		       * User::passForgot()
		       */
			  public function passForgot($email,$capt){	
		      	  clean_form();
			  	 
                  $email = sanitize($email);
			  	  $verify_status = getValue('verified', self::uTable, 'email="'. $email.'"');
                  set_form('email',$email);

			  	  if (empty($email)){
					  set_form_error('email_error', 'Enter a valid email address');
					  return false;
				  }else if (!$this->emailExists($email)){
					  set_form_error('email_error', 'The email address you entered does not exist.');
					  return false;
		          }else if(!$verify_status){
			  	  	  set_form_error('forgot_error','You must verify your email address before password reset.<br> click <a href="activate.php"> Here to activate your account</a>');
			  	  	  return false;
			  	  }else if(!$this->captchaCheck($capt)){
					  set_form_error('forgot_error','Captcha error.');
					  return false;
				  }else{
					  $token = $this->getUniqueCode(6);
					  $expiry = time()+600;
					  $reset = 1;

			  	  	  $u_link = getValue('id', self::uTable, 'email="'. $email.'"');
					  $this->activate_link = SITEURL."/reset.php?u=".$u_link."&t=".$token."&m=".time();
					  
					  $data= array(
					  	'verify_code' => $token,
					  	'verify_time' => $expiry,
					  	'reset_pass' => $reset,

					  );
					  
					  self::$db->update(self::uTable, $data, "email = '" . $email . "'");

					  //send mail
					  $subject = $this->core->name.' Reset Password';
					  $message = read_template('email-template/forgot.html',$this->core,$this);
			  	      $username = getValue('username', self::uTable, 'email="'. $email.'"');
					  send_mail($email,$username,$subject,$message,$this->core);

					  //notify
                      set_form('success','A password reset link has been sent to your email inbox/spam.<br>Please use the code before the 10 minutes expiry time.');
                      set_form('email',null);
						  
					  return true;
				}
		      }
	  
		      /**
		       * User::passForgot()
		       */
			  public function passReset($password,$conf_password,$uid,$token_code,$capt){	
		      	  clean_form();

			  	  $uid = sanitize($uid);

                  set_form('password',$password);
                  set_form('conf_password',$conf_password);

			  	  $valid_id = getValueById('id', self::uTable, $uid);

			  	  if($valid_id == '' ||  empty($uid)){
					  set_form_error('reset_error','User does not exist');
					  return false;
				  }
			  	  $verify_status = getValue('verified', self::uTable, 'id="'.$uid.'"');
			  	  $reset_status = getValue('reset_pass', self::uTable, 'id='.$uid);
			  	  $token = getValue('verify_code', self::uTable, 'id='.$uid);
			  	  $token_time = getValue('verify_time', self::uTable, 'id='.$uid);
			  	  $email = getValue('email', self::uTable, 'id='.$uid);

				  if(!$verify_status){
			  	  	set_form_error('reset_error','You must verify your email address before password reset.<br> click <a href="activate.php"> Here to activate your account</a>');
			  	  }else if(!$reset_status){
					  set_form_error('reset_error','Illegal Process');
					  return false;
				  }else if($token_time < time()){
					  set_form_error('reset_error','Reset Link Expired.<br>Click <a href="forgot.php">here</a> to request a new reset link');
					  return false;
				  }else if($token_code != $token){
					  set_form_error('reset_error','Reset Token Wrong.<br>Click <a href="forgot.php">here</a> to request a new reset token');
					  return false;
				  }else if(!$this->captchaCheck($capt)){
					  set_form_error('reset_error','Captcha error.');
					  return false;
				  }else if (empty($password) || empty($conf_password)){
					  set_form_error('password_error', 'Enter a valid password');
					  return false;
				  }else if ($password != $conf_password){
					  set_form_error('password_error', 'Passwords do not match');
					  return false;
				  }else{

					  $reset = 0;
					  $new_pass = md5($password.'gr!regg14)5734263#');
					  
					  $data= array(
					  	'password' => $new_pass,
					  	'reset_pass' => $reset,

					  );
					  
					  self::$db->update(self::uTable, $data, "id = '" . $uid . "'");

					  //send mail
					  $subject = $this->core->name.' Password Reseted';
					  $message = read_template('email-template/reset.html',$this->core,$this);
			  	      $username = getValue('username', self::uTable, 'id="'.$uid.'"');
					  send_mail($email,$username,$subject,$message,$this->core);

					  //notify
                      set_form('success','Your password has been reset successfully.<br>Click <a href="login.php">here</a> to login now.');
                  	  set_form('password',null);
                      set_form('conf_password',null);
						  
					  return true;
				}
		      }
	  
		      /**
		       * User::activateUser()
		       */
			  public function activateUser($uid,$token_code){		
		      	  clean_form();

			  	  $uid = sanitize($uid);

			  	  $valid_id = getValueById('id', self::uTable, $uid);

			  	  if($valid_id == '' ||  empty($uid)){
					  set_form_error('activate_error','User does not exist');
					  return false;
				  }
			  	  $verify_status = getValue('verified', self::uTable, 'id="'.$uid.'"');
			  	  $token = getValue('verify_code', self::uTable, 'id='.$uid);
			  	  $token_time = getValue('verify_time', self::uTable, 'id='.$uid);
			  	  $email = getValue('email', self::uTable, 'id='.$uid);

				  if($verify_status){
			  	  	set_form_error('activate_error','This account has already been activated!');
			  	  }else if($token_time < time()){
					  set_form_error('activate_error','Reset Link Expired.<br>Click <a href="activate.php">here</a> to request a new reset link');
					  return false;
				  }else if($token_code != $token){
					  set_form_error('activate_error','Reset Token Wrong.<br>Click <a href="activate.php">here</a> to request a new reset token');
					  return false;
				  }else{

					  $verified = 1;
					  $new_pass = md5($password.'gr!regg14)5734263#');
					  
					  $data= array(
					  	'password' => $new_pass,
					  	'verified' => $verified,
					  );
					  
					  self::$db->update(self::uTable, $data, "id = '" . $uid . "'");

					  //send mail
					  $subject = $this->core->name.' Account Activated';
					  $message = read_template('email-template/activated.html',$this->core,$this);
			  	      $username = getValue('username', self::uTable, 'id="'.$uid.'"');
					  send_mail($email,$username,$subject,$message,$this->core);

					  //notify
                      set_form('success','Your Account has been Activated Successfully.<br>Click <a href="login.php">here</a> to login now.');
						  
					  return true;
				}
		      }
	  
		      /**
		       * User::activateResend()
		       */
			  public function activateResend($email,$capt){	
		      	  clean_form();

			  	 
                  $email = sanitize($email);
			  	  $verify_status = getValue('verified', self::uTable, 'email="'. $email.'"');
                  set_form('email',$email);

                  if(!$this->core->auto_verify){
			  	  	set_form_error('activate_error','Contact Admin to get your Account Activated!');
			  	  }else if($verify_status){
			  	  	set_form_error('activate_error','This account has already been activated!');
			  	  }else if(!$this->captchaCheck($capt)){
					  set_form_error('activate_error','Captcha error.');
					  return false;
				  }else if (empty($email)){
					  set_form_error('email_error', 'Enter a valid email address');
					  return false;
				  }else if (!$this->emailExists($email)){
					  set_form_error('email_error', 'The email address you entered does not exist.');
					  return false;
		          }else{

					  $token = getUniqueCode(6);
					  $expiry = time()+600;
					  $reset = 1;

			  	  	  $u_link = getValue('id', self::uTable, 'email="'. $email.'"');
					  $this->activate_link = SITEURL."/activate.php?u=".$u_link."&t=".$token."&m=".time();
					  
					  $data= array(
					  	'verify_code' => $token,
					  	'verify_time' => $expiry,
					  	'reset_pass' => $reset,

					  );
					  
					  self::$db->update(self::uTable, $data, "email = '" . $email . "'");

					  //send mail
					  $subject = $this->core->name.' Account Activation';
					  $message = read_template('email-template/forgot.html',$this->core,$this);
			  	      $username = getValue('username', self::uTable, 'email="'.$email.'"');
					  send_mail($email,$username,$subject,$message,$this->core);

					  //notify
                      set_form('success','A password reset link has been sent to your email inbox/spam.<br>Please use the code before the 10 minutes expiry time.');
                      set_form('email',null);
						  
					  return true;
				}
		      }

		      /**
		       * User::register()
		       */
			  public function register($username,$fname,$lname,$email,$pword,$cpword,$terms,$capt){		
		      	  clean_form();
                  
                  $username = strtolower(sanitize($username));
                  $fname = sanitize($fname);
                  $lname = sanitize($lname);
                  $email = strtolower(sanitize($email));
                  $pword = sanitize($pword);
                  $cpword = sanitize($cpword);
                  $terms = sanitize($terms);

                  set_form('username',$username);
                  set_form('firstname',$fname);
                  set_form('lastname',$lname);
                  set_form('email',$email);
                  set_form('password',$pword);
                  set_form('conf_password',$cpword);

			  	  if(!$this->core->allow_signup){
					  set_form_error('register_error','Sign Up is not allowed.');
					  return false;
				  }else if (empty($_POST['username'])){
					  set_form_error('username_error','Enter a valid username.');
					  return false;
				  }else if ($value = $this->usernameExists($_POST['username'])) {
					  if ($value == 1){
						  set_form_error('username_error','Username is too short (less than 3 characters long).');
					  	  return false;
					  }else if ($value == 2){
						  set_form_error('username_error','Invalid characters found in the username.');
					  	  return false;
					  }else if ($value == 3){
						  set_form_error('username_error','Sorry, this username is already taken');
					  	  return false; 
					  }
				  }

				  if (empty($fname)){
				  		set_form_error('firstname_error','Please enter the first name');
					     return false;
				  }else if (empty($lname)){
				  		set_form_error('lastname_error','Please enter the last name');
					     return false;
				  }else if (empty($pword)){
					  set_form_error('password_error','Enter a valid password.');
					     return false;
				  }else if (strlen($pword) < 6){
					  set_form_error('password_error','Password is too short (less than 6 characters)');	
					     return false;	  
				  }else if ($pword != $cpword){
					  set_form_error('password_error','Your password does not match the confirmed password!.');
					     return false;
				  }else if (empty($email)){
					  set_form_error('email_error','Enter a valid email address');
					     return false;
				  }else if ($this->emailExists($email)){
					  set_form_error('email_error','The email address you entered is already in use.');
					     return false;
				  }else if (!$this->isValidEmail($email)){
					  set_form_error('email_error','The email address you entered is invalid.');
					     return false;
				  }else if(!$this->captchaCheck($capt)){
					  set_form_error('register_error','Captcha error.');
					  return false;
				  }else if (!$terms){
					  set_form_error('register_error','Please accept the terms and conditions');
					     return false;
				  }else{

					  $token = getUniqueCode(6);
					  $expiry = time()+600;
					  $reset = 1;

						  
					  $data = array(
							  'status' => 1, 
							  'admin' => 0,
							  'verified' => 0,
							  'username' => $username, 
							  'firstname' => $fname,
							  'lastname' => $lname,
							  'gender' => "",				  
							  'email' => $email,
							  'phone' => "",
							  'address' => "",
						      'country' => "",
						      'reg_date' => time(),
							  'verify_code' => $token,
							  'verify_time' => $expiry,
							  'reset_pass' => 0, 
							  'password' => md5($pword.'gr!regg14)5734263#'),
							  'referral_id' => "",
					  );
					  
					  self::$db->insert(self::uTable, $data);
					  $data = array('referral_id' => self::$db->insertid()); 
					  self::$db->update(self::uTable, $data, "email = '" . $email . "'");
			  	  	  $u_link = getValue('id', self::uTable, 'email="'. $email.'"');
					  $this->activate_link = SITEURL."/activate.php?u=".$u_link."&t=".$token."&m=".time();

					  //set referral
					  if(isset($_SESSION['ref'])){
						  $data = array(
						  	'user_id' => self::$db->insertid(),
						  	'referer' => substr($_SESSION['ref'],4),
						  	'time_i' => time(),
						  	'time_o' => "",
						  	'valid' => 0,
						  	'status' => 0,
						  	'commission' => 0,
						  );
						  self::$db->insert(self::rTable, $data);
					  }

					  if($this->core->auto_verify){
					      //send mail
						  $subject = $this->core->name.' Account Created';
						  $message = read_template('email-template/confirm.html',$this->core,$this);
						  send_mail($email,$username,$subject,$message,$this->core);
	                      
	                      set_form('success','Your Account Has been created Successfully.<br>An activation link has been sent to your email inbox/spam.<br>Please use the code before the 10 minutes expiry time.');
					  }else{ set_form('success','Your Account Has been created Successfully.<br>The Admin will activate your account in few moments after verifying your details.');}

	                  set_form('username',null);
	                  set_form('firstname',null);
	                  set_form('lastname',null);
	                  set_form('email',null);
	                  set_form('password',null);
	                  set_form('conf_password',null);
						  
					  return true;
		          }
		      }

		      /**
		       * User::profile()
		       */
			  public function profile($fname,$lname,$phone,$email,$gender,$country,$address,$username=null,$special=false){		
		      	  clean_form();
                  
                  $username = strtolower(sanitize($username));
                  $fname = sanitize($fname);
                  $lname = sanitize($lname);
                  $email = sanitize($email);
                  $phone = sanitize($phone);
                  $gender = sanitize($gender);
                  $country = sanitize($country);
                  $address = sanitize($address);


                  if($special != false){
				  	  if (empty($username)){
						  set_form_error('profile_error','Enter a valid username.');
						  return false;
					  }else if ($value = $this->usernameExists($username)) {
						  if ($value == 1){
							  set_form_error('profile_error','Username is too short (less than 3 characters long).');
						  	  return false;
						  }else if ($value == 2){
							  set_form_error('profile_error','Invalid characters found in the username.');
						  	  return false;
						  }else if ($value == 3 && (strtolower($username)!= strtolower($_SESSION['i_user']['username']))){
							  set_form_error('profile_error','Sorry, this username is already taken');
						  	  return false; 
						  }
					  }
				  }

				  if (empty($fname)){
				  		set_form_error('profile_error','Please enter the first name');
					     return false;
				  }else if (empty($lname)){
				  		set_form_error('profile_error','Please enter the last name');
					     return false;
				  }else if (empty($phone)){
					     set_form_error('profile_error','Enter a valid phone number.');
					     return false;
				  }else if (empty($email)){
					     set_form_error('profile_error','Enter a valid email address');
					     return false;
				  }else if ($this->emailExists($email) && ($email != $_SESSION['i_user']['email'])){
					  set_form_error('profile_error','The email address you entered is already in use.');
					     return false;
				  }else if (!$this->isValidEmail($email)){
					  set_form_error('profile_error','The email address you entered is invalid.');
					     return false;
				  }else if (empty($gender)){
					     set_form_error('profile_error','Enter a valid gender');
					     return false;
				  }else if (empty($country)){
					     set_form_error('profile_error','Enter a valid country');
					     return false;
				  }else if (empty($address)){
					     set_form_error('profile_error','Enter a valid address');
					     return false;
				  }else{
						  
					  $data = array(
							  'username' => (($special != false) ? $username : $_SESSION['user']['username']), 
							  'firstname' => $fname,
							  'lastname' => $lname,
							  'gender' => $gender,				  
							  'email' => $email,
							  'phone' => $phone,
							  'address' => $address,
						      'country' => $country
					  );
					  
					  $uid = (($special != false) ? $special : $_SESSION['user']['id']);

					  self::$db->update(self::uTable, $data, "id = '" . $uid . "'");

		              if($special == false){
			              $row = $this->getUserInfo($_SESSION['user']['username']);
							unset($_SESSION['user']);
							unset($_SESSION['admin']);
			              $_SESSION['user'] = json_decode(json_encode($row), true);
			              if($row->admin) $_SESSION['admin'] = 1;
		              }
						  
					  return true;
		          }
		      }

		      /**
		       * User::password()
		       */
			  public function changePassword($pword,$cpword,$special=false){		
		      	  clean_form();
                  
                  $pword = sanitize($pword);
                  $cpword = sanitize($cpword);

                  set_form('password',$pword);
                  set_form('conf_password',$cpword);

			  	  if (empty($pword) || empty($cpword)){
					  set_form_error('password_error','Enter a valid password.');
					     return false;
				  }else if (strlen($pword) < 6){
					  set_form_error('password_error','Password is too short (less than 6 characters)');	
					     return false;	  
				  }else if ($pword != $cpword){
					  set_form_error('password_error','Your password does not match the confirmed password!.');
					     return false;
				  }else{
						  
					  $data = array(
						      'password' => md5($pword.'gr!regg14)5734263#')
					  );

					  $uid = (($special != false) ? $pecial : $_SESSION['user']['id']);
					  
					  self::$db->update(self::uTable, $data, "id = '" . $uid . "'");
                  
	                  set_form('password',null);
	                  set_form('conf_password',null);
						  
					  return true;
		          }
		      }

		      /**
		       * User::contact()
		       */
			  public function contact($name,$email,$subject,$message,$capt){		
		      	  clean_form();
                  
                  $name = sanitize($name);
                  $email = sanitize($email);
                  $message = sanitize($message);
                  $subject = sanitize($subject);

                  set_form('name',$name);
                  set_form('email',$email);
                  set_form('message',$message);
                  set_form('subject',$subject);

				  if (empty($name)){
				  		set_form_error('firstname_error','Please enter the your name');
					     return false;
				  }else if (empty($email)){
				  		set_form_error('email_error','Enter a valid email address');
					     return false;
				  }else if (empty($message)){
					  set_form_error('message_error','A message is needed');
					     return false;
				  }else if (empty($subject)){
					  set_form_error('subject_error','Please state your subject');	
					     return false;	  
				  }else if(!$this->captchaCheck($capt)){
					  set_form_error('contact_error','Captcha error.');
					  return false;
				  }else{

				      //send mail
					  $subject = $this->core->name.' Your Inquiry';
					  $message = read_template('email-template/contact.html',$this->core,$this);
					  send_mail($email,$name,$subject,$message,$this->core);
                      
                      set_form('success','Your Inquiry has been successfully sent.<br>We will respond as fast as possible.<br>Thanks.');

	                  set_form('name',null);
	                  set_form('email',null);
	                  set_form('message',null);
	                  set_form('subject',null);
						  
					  return true;
				  }
               }

			  /**
			   * Users::checkStatus()
			   */
		      public function checkStatus($username, $pass){

		          $username = sanitize($username);
		          $username = self::$db->escape($username);
		          $pass = sanitize($pass);

		          $sql = "SELECT password, status, verified FROM " . self::uTable . "\n WHERE username = '" . $username . "'";
		          $result = self::$db->query($sql);

		          if (self::$db->numrows($result) == 0)return 0;

		          $row = self::$db->fetch($result);
		          $entered_pass = md5($pass.'gr!regg14)5734263#');

		          if(!$row->verified) return 1;
		          if(!$row->status) return 2;
		          if($entered_pass == $row->password) return 3;
		      }

			  /**
			   * Users::getUserInfo()
			   */
		      private function getUserInfo($username){
		          $username = sanitize($username);
		          $username = self::$db->escape($username);

		          $sql = "SELECT * FROM " . self::uTable . " WHERE username = '" . $username . "'";
		          $row = self::$db->first($sql);
		          if (!$username)
		              return false;

		          return ($row) ? $row : 0;
		      }
	  
        	  /**
        	   * Users::getUniqueCode()
        	   */
        	  private function getUniqueCode($length = "")
        	  {
        		  $code = md5(uniqid(rand(), true));
        		  if ($length != "") {
        			  return substr($code, 0, $length);
        		  } else
        			  return $code;
        	  }
	  
			  /**
			   * User::emailExists()
			   */
			  private function emailExists($email){
				  
		          $sql = self::$db->query("SELECT email" 
				  . "\n FROM " . self::uTable 
				  . "\n WHERE email = '" . sanitize($email) . "'" 
				  . "\n LIMIT 1");

		          if (self::$db->numrows($sql) == 1) {
		              return true;
		          } else return false;
			  }

			  /**
			   * Users::getUserData()
			   */
			  public function getUserData(){
				  
		          $sql = "SELECT *, DATE_FORMAT(created, '%a. %d, %M %Y') as cdate," 
				  . "\n DATE_FORMAT(lastlogin, '%a. %d, %M %Y') as ldate" 
				  . "\n FROM " . self::uTable 
				  . "\n WHERE id = " . $this->uid;
		          $row = self::$db->first($sql);

				  return ($row) ? $row : 0;
			  }
	  
			  /**
			   * User::isValidEmail()
			   */
			  private function isValidEmail($email){
				  if (function_exists('filter_var')) {
					  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						  return true;
					  } else
						  return false;
				  } else
					  return preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email);
			  } 	
			  	  	  	  
			  /**
			   * Users::usernameExists()
			   */
			  private function usernameExists($username){
		          $username = sanitize($username);
		          if (strlen(self::$db->escape($username)) < 3)
		              return 1;

		          //Username should contain only alphabets, numbers, underscores or hyphens.Should be between 4 to 15 characters long
				  $valid_uname = "/^[a-z0-9_-]{4,15}$/"; 
		          if (!preg_match($valid_uname, $username))
		              return 2;

		          $sql = self::$db->query("SELECT username" 
				  . "\n FROM " . self::uTable 
				  . "\n WHERE username = '" . $username . "'" 
				  . "\n LIMIT 1");

		          $count = self::$db->numrows($sql);

		          return ($count > 0) ? 3 : false;
			  }  

			  public function login_activity(){

			  	  $sql = "SELECT * FROM " . self::lTable . " WHERE user_id='".$_SESSION['user']['id'] ."' ORDER by id DESC LIMIT 20";
		          $row = self::$db->fetch_all($sql);

		          foreach($row as $rowItem){
		            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
		          }

		          $this->login_records = $row;

			  }  

			  public function withdrawal_activity(){

			  	  $sql = "SELECT * FROM " . self::wTable . " WHERE user_id='".$_SESSION['user']['id'] ."' ORDER by id DESC LIMIT 30";
		          $row = self::$db->fetch_all($sql);

		          foreach($row as $rowItem){
		            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Processed</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Pending</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		          }

		          $this->withdrawal_records = $row;

			  }	

			  public function deposit_activity(){

			  	  $sql = "SELECT * FROM " . self::dTable . " WHERE user_id='".$_SESSION['user']['id'] ."' ORDER by id DESC LIMIT 30";
		          $row = self::$db->fetch_all($sql);

		          foreach($row as $rowItem){
		            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
		            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
		            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
		            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
		            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
		            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
		            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
		            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
		          }

		          $this->deposit_records = $row;

			  }	

			  public function referral_activity(){

			  	  $sql = "SELECT * FROM " . self::rTable . " WHERE referer='".$_SESSION['user']['id'] ."' ORDER by time_o DESC LIMIT 50";
		          $row = self::$db->fetch_all($sql);

		          foreach($row as $rowItem){
		            $rowItem->time = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		          }

		          $this->referral_records = $row;

			  }

			  public function processDeposit($plan,$amount){
				  $_SESSION['cpay'] = Array();

		          $sql = "SELECT * FROM " . self::pTable . " WHERE id='".$plan."'";
		          $result = self::$db->query($sql);

		          if($plan < 5){
		          	$_SESSION['cpay']['status'] = false;
		          	$_SESSION['cpay']['msg'] = "Plan is Invalid";
		          	return false;
		          }else if (self::$db->numrows($result) == 0){
		          	$_SESSION['cpay']['status'] = false;
		          	$_SESSION['cpay']['msg'] = "Plan does not exist";
		          	return false;
		          }else{
		          	$row = self::$db->first($sql);
		          	if(!$row->active){
		          		$_SESSION['cpay']['status'] = false;
		          		$_SESSION['cpay']['msg'] = "Plan is no longer active";
		          		return false;
		          	}else if($row->minimum > $amount){
		          		$_SESSION['cpay']['status'] = false;
		          		$_SESSION['cpay']['msg'] = "Your chosen amount is less than plan minimum ";
		          		return false;
		          	}else if($row->maximum < $amount){
		          		$_SESSION['cpay']['status'] = false;
		          		$_SESSION['cpay']['msg'] = "Your chosen amount is greater than plan maximum ";
		          		return false;
		          	}else{
		          		$ref = 'cpay-'.$_SESSION['user']['id'].'_'.time();
		          		$data = Array(
		          			'user_id' => $_SESSION['user']['id'],
		          			'status' => 0,
		          			'time' => time(),
		          			'init_amount' => $amount,
		          			'amount' => "",
		          			'currency' => "",
		          			'txn_id' => "",
		          			'reference' => "Coinpayments",
		          			'ref_id' => $ref,
		          			'description' => "",
		          			'plan_id' => $row->id

		          		);

					    self::$db->insert(self::dTable, $data);

		          		$_SESSION['cpay']['status'] = true;
		          		$_SESSION['cpay']['amount'] = $amount;
		          		$_SESSION['cpay']['name'] = $row->name;
		          		$_SESSION['cpay']['desc'] = $row->description;
		          		$_SESSION['cpay']['plan_id'] = $row->id;
		          		$_SESSION['cpay']['ref_id'] = $ref;
		          		$_SESSION['cpay']['plan_id'] = $row->id;

		          		return true;

		          	}

		          }

			  }	

			  public function updateDeposit($amount1,$currency2,/**$txn_id,**/$invoice,$status){
			  	  $sql = "SELECT * FROM " . self::dTable . " WHERE ref_id='".$invoice ."'";
		          $row = self::$db->first($sql);

		          if($row->init_amount < $amount1) $lstatus = 3;
		          else if($status >= 100 || $status == 2) $lstatus = 1;
		          else if ($status < 0) $lstatus = 4;
		          else if ($status > 0 && $status < 100) $lstatus = 2;
		          else $lstatus = 0;

		          $data = Array(
		          	'status' => $lstatus,
		          	'amount' => $amount1,
		          	'currency' => $currency2,
		          	//'txn_id' => $txn_id,
		          	'description' => (($lstatus==3) ? 'Insuffucient funds' : "")
		          );

		          self::$db->update(self::dTable, $data, "ref_id = '" . $invoice . "'");

		          $sql = "SELECT ref_id FROM " . self::iTable . "\n WHERE ref_id = '" . $invoice . "'";
		          $result = self::$db->query($sql);

		          if($lstatus == 1 && self::$db->numrows($result) == 0){

			          $period = getValue('period', self::pTable, 'id='.$row->plan_id);
			          $period_name = getValue('period_name', self::pTable, 'id='.$row->plan_id);

			          if($period_name == 1) $period_name = 1;
			          else if($period_name == 2) $period_name = 24;
			          else if($period_name == 3) $period_name = 168;
			          else if($period_name == 4) $period_name = 730.001;
			          else $period_name = 8760;

			          $end_time = (next_hour(time()) + (($period*$period_name)*3600));

			          $percent = getValue('percent', self::pTable, 'id='.$row->plan_id)/$period;

			          	$data = Array(
			          		'user_id' => $row->user_id,
			          		'plan' => $row->plan_id,
			          		'percent' => $percent,
			          		'compound' => 0,
			          		'time' => time(),
			          		'start' => next_hour(time()),
			          		'end' => next_hour($end_time),
			          		'invested' => $amount1,
			          		'profit' => "",
			          		'status' => 1,
			          		'ref_id' => $invoice
			          	);
						self::$db->insert(self::iTable, $data);

						if(!getValue('valid', self::rTable, 'user_id='.$row->user_id)){
							//update referrals
							$data = Array(
								'time_o' => time(),
								'valid' => 1,
								'commission' => ($amount1*($this->core->referral_rate/100))
							);
		          			self::$db->update(self::rTable, $data, "user_id = " . $row->user_id);
						}
		          }

		      }

		      public function cronUpdateInvestments(){

		      	  $ctime = time();

			  	  $sql = "SELECT * FROM " . self::iTable;
		          $row = self::$db->fetch_all($sql);

		          foreach($row as $rowItem){
		          	$plan_min = getValue('minimum', self::pTable, 'id='.$rowItem->plan);
		          	if(($rowItem->invested < $plan_min) || ($rowItem->end < $ctime)){
		          		$data = Array('status' => 0);
		          		self::$db->update(self::iTable, $data, "id = " . $rowItem->id);
		          	}
		          }


			  	  $sql = "SELECT * FROM " . self::iTable . " WHERE start<='".$ctime ."' AND '".$ctime."'<=end AND status=1";
		          $row = self::$db->fetch_all($sql);

		          foreach($row as $rowItem){
		            $start = $rowItem->start;
		            $end = $rowItem->end;
		            $hour = ($end- $start)/3600;
		            $percent = $rowItem->percent/$hour;
		            $profit = $rowItem->profit;
		          	if($rowItem->compound){
		          		$tprofit = $rowItem->invested + $profit;
		          		$profit += $tprofit * ($percent/100);
		          	}else $profit += $rowItem->invested * ($percent/100);

		          	$data = Array(
		          		'time' => time(),
		          		'profit' => $profit
		          	);
		          	self::$db->update(self::iTable, $data, "id = " . $rowItem->id);
		          }

		      }
	

			  public function account_balance(){

			  	  $sql = "SELECT * FROM " . self::iTable . " WHERE user_id='".$_SESSION['user']['id'] ."' AND status=1";
		          $row = self::$db->fetch_all($sql);
		          $result = self::$db->query($sql);
		          $this->total_active = self::$db->numrows($result);

		          $this->investment_profits = 0;
		          $this->investment_invested = 0;
		          foreach ($row as $rowItem) {
		          	$rowItem->name = getValue('name', self::pTable, 'id='.$rowItem->plan);
		          	$rowItem->percent = getValue('percent', self::pTable, 'id='.$rowItem->plan);
		          	$rowItem->period = getValue('period', self::pTable, 'id='.$rowItem->plan);
		          	$rowItem->period_name = plan_name(getValue('period_name', self::pTable, 'id='.$rowItem->plan));
		          	$this->investment_profits += $rowItem->profit;
		          	$this->investment_invested += $rowItem->invested;
		          }
		          $this->investment_total = $this->investment_profits+$this->investment_invested;
		          $this->active_investments = $row;
		          //==============================================================================================================================

		          $sql = "SELECT * FROM " . self::rTable . " WHERE referer='".$_SESSION['user']['id'] ."'";
		          $result = self::$db->query($sql);
		          $this->referral_joined = self::$db->numrows($result);
		          $row = self::$db->fetch_all($sql);
		          $this->commission1 = 0;
		          $this->commission2 = 0;
		          foreach($row as $rowItem){
		          	$this->commission1 += $rowItem->commission;
		          	if($rowItem->valid == 1 && $rowItem->status == 0) $this->commission2 += $rowItem->commission; 
		          }

		          $this->total_profits = $this->commission2+$this->investment_profits;
		          if($this->investment_invested != 0)$this->total_profits_percent = (($this->commission2+$this->investment_profits)/$this->investment_invested)*100;
		          else $this->total_profits_percent = 0;

		          $this->available_balance = $this->total_profits+$this->investment_invested;
		          if($this->investment_invested != 0)$this->available_balance_percent = ($this->available_balance/$this->investment_invested)*100;
		          else $this->available_balance_percent = 0;
		          //==============================================================================================================================

			  	  $sql = "SELECT * FROM " . self::iTable . " WHERE user_id='".$_SESSION['user']['id'] ."' AND status=0";
		          $row = self::$db->fetch_all($sql);
		          $result = self::$db->query($sql);
		          $this->total_active2 = self::$db->numrows($result);

		          $this->investment_profits = 0;
		          $this->investment_invested = 0;
		          foreach ($row as $rowItem) {
		          	$rowItem->name = getValue('name', self::pTable, 'id='.$rowItem->plan);
		          	$rowItem->percent = getValue('percent', self::pTable, 'id='.$rowItem->plan);
		          	$rowItem->period = getValue('period', self::pTable, 'id='.$rowItem->plan);
		          	$rowItem->period_name = plan_name(getValue('period_name', self::pTable, 'id='.$rowItem->plan));
		          	$this->investment_profits += $rowItem->profit;
		          	$this->investment_invested += $rowItem->invested;
		          }
		          $this->investment_total2 = $this->investment_profits+$this->investment_invested;
		          $this->active_investments2 = $row;
		          //====================================================================================================================================

			  }
			
			  public function schemeInfo($i){

			  	  $sql = "SELECT * FROM " . self::iTable . " WHERE user_id='".$_SESSION['user']['id'] ."' AND id='".$i."'";
		          $result = self::$db->query($sql);
		          if(self::$db->numrows($result) <= 0)redirect_to('schemes.php');
		          else{
		            $row = self::$db->first($sql);
		          	$row->name = getValue('name', self::pTable, 'id='.$row->plan);
		          	$row->percent_div = $row->percent;
		          	$row->percent = getValue('percent', self::pTable, 'id='.$row->plan);
		          	$row->period = getValue('period', self::pTable, 'id='.$row->plan);
		          	$row->period_name = plan_name(getValue('period_name', self::pTable, 'id='.$row->plan));
		          	$row->status_color = (($row->status == 1) ? "badge-primary" : "badge-danger");
		          	$row->status = (($row->status == 1) ? "Running" : "Ended");
		          	$row->profit_percent = ($row->profit/$row->invested)*100; 
		          	$row->net_return = $row->profit+$row->invested;
		          	$row->net_return_percent = (($row->profit+$row->invested)/$row->invested)*100;
		          	$row->order_date = getValue('time', self::dTable, 'ref_id="'.$row->ref_id.'"');
		          	//=========================================================================================
		          	//Graph
		          	$row->final_profit = ($row->percent/100)*$row->invested;
		          	$row->final_capital = ($row->final_profit)+$row->invested;
		          	$row->final_capital_percent = (($row->profit)/$row->final_profit)*100;

		            if($row->period_name == 1)$multiplier = 3600;
		            if($row->period_name == 2)$multiplier = 86400;
		            if($row->period_name == 3)$multiplier = 604800;
		            if($row->period_name == 4)$multiplier = 2628288;
		            else $multiplier = 31556952;

		          	$row->final_day = round((time() - $row->end)/$multiplier,2);
		          	if($row->final_day < 0) $row->final_day = abs($row->final_day);
		          	if(time() > $row->end) $row->final_day = 0;
		          	$row->final_day_percent = ($row->final_day/(($row->end-$row->start)/$multiplier))*100;

		          	if($row->final_day_percent == 0)$row->final_day_percent = 100;

		          	return $row;
		          }
			  }

			  public function makeWithdraw($amount,$method,$address){
			      	clean_form();

			      	$amount = sanitize($amount);
			      	$method = sanitize($method);
			      	$address = sanitize($address);

			      	$min = getValue('minimum', self::wmTable, 'id="'.$method.'"');
			      	$max = getValue('maximum', self::wmTable, 'id="'.$method.'"');
			      	$charge = getValue('charge', self::wmTable, 'id="'.$method.'"');

			      	if($amount < $min){
			      		set_form_error('withdraw_error','The Amount is less then method Minimum');
			      		return false;
			      	}else if($amount > $max){
			      		set_form_error('withdraw_error','The Amount is more then method Maximum');
			      		return false;
			      	}else if($amount > $this->total_profits){
			      		set_form_error('withdraw_error','The Amount is greater than your withdrawable amount');
			      		return false;
			      	}else if(empty($address)){
			      		set_form_error('withdraw_error','The Paymeny Info cannot be empty');
			      		return false;
			      	}else{
						
				        $data = Array(
				          'user_id' => $_SESSION['user']['id'],
				          'status' => 0,
				          'time' => time(),
				          'amount' => $amount,
				          'currency' => getValue('currency', self::wmTable, 'id="'.$method.'"'),
				          'txn_id' => 'WITDR-'.time(),
				          'reference' => getValue('method', self::wmTable, 'id="'.$method.'"'),
				          'description' => $address
				        );
		        		self::$db->insert(self::wTable, $data);

		        		return true;
		            }

			  }
	}
?>