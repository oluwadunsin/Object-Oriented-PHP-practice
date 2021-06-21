<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class Core{
      
	  const sTable = "settings";
	  const wmTable = "withdrawal_method";
      const wTable = "withdrawal";
      const dTable = "deposit";
      const pTable = "plan";
      const rTable = "referral";
	  const uTable = "user";
	  const lTable = "login";
      const iTable = "investments";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();

		  $this->getwMethods();

		  if(isset($_SESSION['admin'])){
		  	$this->all_withdrawal_activity();
		  	$this->all_deposit_activity();
		  	$this->all_referral_activity();
		  	$this->all_login_activity();
		  	$this->manage_users();
		  	$this->manage_plans();
		  	$this->admin_dashboard();
		  }
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::sTable;
          $row = self::$db->first($sql);
          
          $this->title = $row->title;
          $this->name = $row->name;
		  $this->site_url = $row->site_url;
          //logo
          //favicon
		  $this->site_currency = $row->site_currency;
          $this->site_currency_letter = $row->site_currency_letter;
          $this->maintenance_mode = $row->maintenance_mode;

          $this->meta_description = $row->meta_description;
		  $this->meta_keywords = $row->meta_keywords;

		  $this->contact_mail = $row->contact_mail;
		  $this->contact_phone = $row->contact_phone;
		  $this->contact_address = $row->contact_address;
		  $this->contact_facebook = $row->contact_facebook;
		  $this->contact_instagram = $row->contact_instagram;
          $this->contact_twitter = $row->contact_twitter;
		  $this->contact_whatsapp = $row->contact_whatsapp;

		  $this->support_mail = $row->support_mail;
		  $this->sender_email = $row->sender_email;
          $this->sender_name = $row->sender_name;
		  $this->debug_mail = $row->debug_mail;

		  $this->captcha_enabled = $row->captcha_enabled;
		  $this->captcha_key = $row->captcha_key;
		  $this->captcha_secret = $row->captcha_secret;

          $this->before_head = $row->before_head;
		  $this->after_body = $row->after_body;
		  $this->before_body = $row->before_body;

		  $this->announcement_pri = $row->announcement_pri;
		  $this->announcement_pub = $row->announcement_pub;

		  $this->allow_signup = $row->allow_signup;
		  $this->allow_login = $row->allow_login;
		  $this->auto_verify = $row->auto_verify;

		  $this->auto_compounding = $row->compounding;
		  $this->referral_rate = $row->referral_rate;
		  $this->allow_pay = $row->allow_pay;
		  $this->allow_withdraw = $row->allow_withdraw;

		  $this->cpay_merchant = $row->cpay_merchant;
		  $this->cpay_ipn = $row->cpay_ipn;
		  

		  $this->cron = $row->cron;

      }

      private function getwMethods(){

          $sql = "SELECT * FROM " . self::wmTable;
          $row = self::$db->fetch_all($sql);

		    foreach($row as $rowItem){
		    	if($rowItem->status == 1){
		    		$rowItem->status = "<span class ='badge badge-dot badge-success'>active</span>";
		    		$rowItem->istatus = 1;
		    	}else{
		    		 $rowItem->status = "<span class ='badge badge-dot badge-danger'>inactive</span>";
		    		 $rowItem->istatus = 0;
		    	}
		    }

          $this->wMethods = $row;

      }

      public function updatePmethod($item){

	        $data = Array(
	          'method' => sanitize($item['item1']),
	          'currency' => sanitize($item['item2']),
	          'charge' => sanitize($item['item3']),
	          'minimum' => sanitize($item['item4']),
	          'maximum' => sanitize($item['item5']),
	          'delay' => sanitize($item['item6']),
	          'status' => sanitize($item['item7']),
	        );

	        self::$db->update(self::wmTable, $data, "id ='".$item['item8']."'");

	        return true;

      }

      public function setNewPmethod($item){

	        $data = Array(
	          'method' => sanitize($item['item1']),
	          'currency' => sanitize($item['item2']),
	          'charge' => sanitize($item['item3']),
	          'minimum' => sanitize($item['item4']),
	          'maximum' => sanitize($item['item5']),
	          'delay' => sanitize($item['item6']),
	          'status' => sanitize($item['item7']),
	        );

	        self::$db->insert(self::wmTable, $data);

	        return true;

      }

      public function deletePmethod($item){

	        self::$db->delete(self::wmTable, "id ='".$item."'");

	        return true;

      }

      public function setLogo(){
      	  //upload imgs
	      if(check_image($_FILES['logo'])) image_upload($_FILES['logo'],'png','logo','../img/logo/');
	      if(check_image($_FILES['favicon'])) image_upload($_FILES['favicon'],'ico','favicon','../img/logo/');
      }

      public function setName($item){

	        $data = Array(
	          'title' => sanitize($item['item1']),
	          'name' => sanitize($item['item2']),
	          'site_url' => sanitize($item['item3']),
	          'site_currency' => sanitize($item['item4']),
	          'site_currency_letter' => sanitize($item['item5']),
	          'maintenance_mode' => sanitize($item['item6'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setSeo($item){

	        $data = Array(
	          'meta_keywords' => sanitize($item['item1']),
	          'meta_description' => sanitize($item['item2'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setContact($item){

	        $data = Array(
	          'contact_mail' => sanitize($item['item1']),
	          'contact_phone' => sanitize($item['item2']),
	          'contact_address' => sanitize($item['item3']),
	          'contact_facebook' => sanitize($item['item4']),
	          'contact_instagram' => sanitize($item['item5']),
	          'contact_twitter' => sanitize($item['item6']),
	          'contact_whatsapp' => sanitize($item['item7'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setMail($item){

	        $data = Array(
	          'support_mail' => sanitize($item['item1']),
	          'sender_email' => sanitize($item['item2']),
	          'sender_name' => sanitize($item['item3']),
	          'debug_mail' => sanitize($item['item4'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setCaptcha($item){

	        $data = Array(
	          'captcha_enabled' => sanitize($item['item1']),
	          'captcha_key' => sanitize($item['item2']),
	          'captcha_secret' => sanitize($item['item3'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setScript($item){

	        $data = Array(
	          'before_head' => $item['item1'],
	          'after_body' => $item['item2'],
	          'before_body' => $item['item3']
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setAnnounce($item){

	        $data = Array(
	          'announcement_pri' => sanitize($item['item1']),
	          'announcement_pub' => sanitize($item['item2'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setCron(){

	        $data = Array(
	          'cron' => time()
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setAuth($item){

	        $data = Array(
	          'allow_signup' => sanitize($item['item1']),
	          'allow_login' => sanitize($item['item2']),
	          'auto_verify' => sanitize($item['item3'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setRates($item){

	        $data = Array(
	          'compounding' => sanitize($item['item1']),
	          'referral_rate' => sanitize($item['item2']),
	          'allow_pay' => sanitize($item['item3']),
	          'allow_withdraw' => sanitize($item['item4'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setCpay($item){

	        $data = Array(
	          'cpay_merchant' => sanitize($item['item1']),
	          'cpay_ipn' => sanitize($item['item2'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

      public function setWithdraw($item){

	        $data = Array(
	          'allow_withdraw' => sanitize($item['item1'])
	        );

	        self::$db->update(self::sTable, $data, "id = 1");

	        return true;

      }

	  public function all_withdrawal_activity(){

	  	  $sql = "SELECT * FROM " . self::wTable . " ORDER by id DESC";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Processed</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Pending</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }

          $this->all_withdrawal_records = $row;

	  	  $sql = "SELECT * FROM " . self::wTable . " WHERE status=0 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Processed</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Pending</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_withdrawal_records_pending = $row;

	  	  $sql = "SELECT * FROM " . self::wTable . " WHERE status=1 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Processed</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Pending</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_withdrawal_records_processed = $row;

	  	  $sql = "SELECT * FROM " . self::wTable . " WHERE status=2 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Processed</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Pending</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_withdrawal_records_cancelled = $row;

	  }	

	  public function updateWithdrawals($status,$did){
	        $data = Array(
	          'status' => sanitize($status)
	        );

	        self::$db->update(self::wTable, $data, "id ='".sanitize($did)."'");

	        return true;

	  }

      public function deleteWithdrawals($did){

	        self::$db->delete(self::wTable, "id ='".$did."'");

	        return true;

      }

	  public function all_deposit_activity(){

	  	  $sql = "SELECT * FROM " . self::dTable . " ORDER by id DESC";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
          }
          $this->all_deposits_records = $row;

	  	  $sql = "SELECT * FROM " . self::dTable . " WHERE status=0 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
          }
          $this->all_deposits_records_waiting = $row;

	  	  $sql = "SELECT * FROM " . self::dTable . " WHERE status=1 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
          }
          $this->all_deposits_records_processed = $row;

	  	  $sql = "SELECT * FROM " . self::dTable . " WHERE status=2 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
          }
          $this->all_deposits_records_pending = $row;

	  	  $sql = "SELECT * FROM " . self::dTable . " WHERE status=3 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
          }
          $this->all_deposits_records_insufficient = $row;

	  	  $sql = "SELECT * FROM " . self::dTable . " WHERE status>3 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
            $rowItem->user = getValueById('username',self::uTable,$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y h:i A");
            $rowItem->plan_id = getValue('name', self::pTable, 'id='.$rowItem->plan_id);
            //0=waiting, 1=processed, 2 = pending, 3=insufficient, 4=cancelled;
            if($rowItem->status == 0) $rowItem->status = "<span class ='badge badge-dot'>Waiting</span>";
            else if($rowItem->status == 1) $rowItem->status = "<span class ='badge badge-dot badge-success'>Processed</span>";
            else if($rowItem->status == 2) $rowItem->status = "<span class ='badge badge-dot badge-warning'>Pending</span>";
            else if($rowItem->status == 3) $rowItem->status = "<span class ='badge badge-dot badge-primary'>Insufficient</span>"; 
            else $rowItem->status = "<span class ='badge badge-dot badge-danger'>Cancelled</span>"; 
          }
          $this->all_deposits_records_cancelled = $row;
      }


	  public function updateDeposits($status,$did){

	        $did = sanitize($did);
	        $status = sanitize($status);

	        $data = Array(
	          'status' => $status
	        );
	        self::$db->update(self::dTable, $data, "id ='".$did."'");

	        if($status==1){
	          Registry::set('User',new User($this));
			  $user = Registry::get("User");

			  $amount1 =  getValue('init_amount', self::dTable, 'id="'.$did.'"');
			  $currency2 =  getValue('currency', self::dTable, 'id="'.$did.'"');
			  $txn_id = 'Man-Adm-'.time();
			  $invoice = getValue('ref_id', self::dTable, 'id="'.$did.'"');

			  $user->updateDeposit($amount1,$currency2/*,$txn_id*/,$invoice,2);
	        }

	        return true;

	  }

      public function deleteDeposits($did){

	        self::$db->delete(self::dTable, "id ='".$did."'");

	        return true;

      }

      public function all_referral_activity(){

	  	  $sql = "SELECT * FROM " . self::rTable . " ORDER by id DESC";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
		            $rowItem->time_i = to_date($rowItem->time_i,"d-j-Y");
		            $rowItem->time_o = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->referer =  getValue('username', self::uTable, 'id='.$rowItem->referer);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }

          $this->all_referral_records = $row;

	  	  $sql = "SELECT * FROM " . self::rTable . " WHERE status=0 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
		            $rowItem->time_i = to_date($rowItem->time_i,"d-j-Y");
		            $rowItem->time_o = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->referer =  getValue('username', self::uTable, 'id='.$rowItem->referer);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_referral_records_unpaid = $row;

	  	  $sql = "SELECT * FROM " . self::rTable . " WHERE status=1 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
		            $rowItem->time_i = to_date($rowItem->time_i,"d-j-Y");
		            $rowItem->time_o = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->referer =  getValue('username', self::uTable, 'id='.$rowItem->referer);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_referral_records_paid = $row;

	  	  $sql = "SELECT * FROM " . self::rTable . " WHERE status=2 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
		            $rowItem->time_i = to_date($rowItem->time_i,"d-j-Y");
		            $rowItem->time_o = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->referer =  getValue('username', self::uTable, 'id='.$rowItem->referer);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_referral_records_cancelled = $row;

	  	  $sql = "SELECT * FROM " . self::rTable . " WHERE valid=1 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
		            $rowItem->time_i = to_date($rowItem->time_i,"d-j-Y");
		            $rowItem->time_o = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->referer =  getValue('username', self::uTable, 'id='.$rowItem->referer);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_referral_records_invested = $row;

	  	  $sql = "SELECT * FROM " . self::rTable . " WHERE valid=0 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
		            $rowItem->time_i = to_date($rowItem->time_i,"d-j-Y");
		            $rowItem->time_o = to_date($rowItem->time_o,"d-j-Y");
		            $rowItem->user_id =  getValue('username', self::uTable, 'id='.$rowItem->user_id);
		            $rowItem->referer =  getValue('username', self::uTable, 'id='.$rowItem->referer);
		            $rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>Paid</span>" : (($rowItem->status == 0) ? "<span class ='badge badge-dot badge-warning'>Unpaid</span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
		            $rowItem->valid = (($rowItem->valid == 1) ? "<span class ='badge badge-dot badge-success'>Invested</span>" : (($rowItem->valid == 0) ? "<span class ='badge badge-dot badge-warning'></span>" : "<span class ='badge badge-dot badge-danger'>Cancelled</span>"));
          }
          $this->all_referral_records_uninvested = $row;

      }


	  public function updateReferrals($status,$validity,$did){

	        $did = sanitize($did);
	        $status = sanitize($status);
	        $validity = sanitize($validity);

	        $data = Array(
	          'status' => $status,
	          'valid' => $validity
	        );
	        self::$db->update(self::rTable, $data, "id ='".$did."'");

	        return true;

	  }

      public function deleteReferrals($did){

	        self::$db->delete(self::rTable, "id ='".$did."'");

	        return true;

      }

      public function all_login_activity(){

	  	  $sql = "SELECT * FROM " . self::lTable . " ORDER by id DESC";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
          	$rowItem->user = getValue('username', self::uTable, 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
          }

          $this->all_login_records = $row;

          $last_hour = strtotime("last hour");
          $today = strtotime("today");
          $yesterday = strtotime("yesterday");
          $week = strtotime("first day of this week");
          $month = strtotime("first day of this month");
          $year = strtotime("first day of this year");


	  	  $sql = "SELECT * FROM " . self::lTable . " WHERE time >= '".$last_hour."' ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
          	$rowItem->user = getValue('username', self::uTable, 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
          }
          $this->all_login_records_last_hour = $row;

	  	  $sql = "SELECT * FROM " . self::lTable . " WHERE time >= '".$yesterday."' AND time <= '".$today."' ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
          	$rowItem->user = getValue('username', self::uTable, 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
          }
          $this->all_login_records_yesterday = $row;

	  	  $sql = "SELECT * FROM " . self::lTable . " WHERE time >= '".$week."' ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
          	$rowItem->user = getValue('username', self::uTable, 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
          }
          $this->all_login_records_week = $row;

	  	  $sql = "SELECT * FROM " . self::lTable . " WHERE time >= '".$month."' ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
          	$rowItem->user = getValue('username', self::uTable, 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
          }
          $this->all_login_records_month = $row;

	  	  $sql = "SELECT * FROM " . self::lTable . " WHERE time >= '".$year."' ORDER by id DESC";
          $row = self::$db->fetch_all($sql);
          foreach($row as $rowItem){
          	$rowItem->user = getValue('username', self::uTable, 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y g:i A");
          }
          $this->all_login_records_year = $row;

      }

      public function manage_users(){

			$sql = "SELECT * FROM " . self::uTable . " ORDER by id DESC";
			$result = self::$db->query($sql);

			$this->total_users = self::$db->numrows($result);
	        $row = self::$db->fetch_all($sql);
	        $urow = Array();
	        $randClr = Array('blue','azure','indigo','purple','pink','orange','teal');

	          foreach($row as $rowItem){
	            $temp = Array();
	            $temp['clr'] = $randClr[array_rand($randClr,1)];
	            $temp['id'] = $rowItem->id;
	            $temp['user'] = ucwords($rowItem->firstname[0].$rowItem->lastname[0]);
	            $temp['name'] = ucwords($rowItem->firstname.' '.$rowItem->lastname);
	            $temp['username'] = strtolower($rowItem->username);
	            $temp['phone'] = $rowItem->phone;
	            $temp['email'] = $rowItem->email;
	            $temp['gender'] = strtolower($rowItem->gender);
	            $temp['country'] = ucfirst($rowItem->country);
	            $temp['address'] = $rowItem->address;
	            $temp['reg'] = to_date($rowItem->reg_date,"d-m-Y");
	            $temp['last'] =   to_date(getValue('MAX(time) AS max', self::lTable, 'user_id = "'.$rowItem->id.'"',true,'max'),"d-m-Y");
	            $temp['verified'] = (($rowItem->verified) ? '<em class="icon text-success ni ni-check-circle"></em>' : '<em class="icon text-danger ni ni-cross-circle"></em>');
	            $temp['iverified'] = $rowItem->verified;
			    $temp['status'] = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>active</span>" : "<span class ='badge badge-dot badge-danger'>banned</span>");
			    $temp['istatus'] = $rowItem->status;
			    
				 $sql = "SELECT * FROM " . self::iTable . " WHERE user_id= ".$rowItem->id." ORDER by id DESC";
				 $result = self::$db->query($sql);
			     $temp['plans'] = self::$db->numrows($result);

			     $temp['invested'] = getValue('SUM(invested) AS sum', self::iTable, 'user_id = "'.$rowItem->id.'"',true,'sum');
			     $temp['profits_invested'] = getValue('SUM(profit) AS sum', self::iTable, 'user_id = "'.$rowItem->id.'"',true,'sum');
			     $temp['profits_referral'] = getValue('SUM(commission) AS sum', self::rTable, 'referer = "'.$rowItem->id.'" AND valid = 1 AND status = 0',true,'sum');

			     //========================================================================================
			        $rowItem->locked =  $temp['invested'];
			        $rowItem->tprofit = $temp['profits_invested']+$temp['profits_referral'];
			     	$temp['raw_data'] = json_decode(json_encode($rowItem), true);
			     //============================================================================================

			     //array_push($urow,$temp);
			     $urow[$rowItem->id] = $temp;
	          }
	          $_SESSION['all_users'] = $urow;
              $this->urow = json_decode(json_encode($urow,JSON_INVALID_UTF8_IGNORE));
      }

      public function deleteUsers($did){

	        self::$db->delete(self::uTable, "id ='".$did."'");

	        return true;

      }


	  public function suspendUsers($status,$did){

	        $did = sanitize($did);

	        $data = Array(
	          'status' => $status
	        );
	        self::$db->update(self::uTable, $data, "id ='".$did."'");

	        return true;

	  }


	  public function activateUsers($did){

	        $did = sanitize($did);

	        $data = Array(
	          'verified' => 1,
	          'username' => getValue('username', self::uTable, 'id="'.$did.'"'),
	        );
	        self::$db->update(self::uTable, $data, "id ='".$did."'");
			  
			  //send mail
	  	      $username = getValue('username', self::uTable, 'id="'.$did.'"');
	          $duser= Array(
	          	'ip'=>null,
	          	'username' => $username,
	          	'browser' => null,
	          	'time' => null,
	          	'location' => null,
	          	'activate_link' => null,
	          	'last_login' => null
	          );
              $duser = json_decode(json_encode($duser));
			  $email = getValue('email', self::uTable, 'id='.$did);

			  $subject = $this->name.' Account Activated';
			  $message = read_template('email-template/activated.html',$this,$duser,true);
			  send_mail($email,$username,$subject,$message,$this);

	        return true;

	  }

	  public function manage_plans(){
			$sql = "SELECT * FROM " . self::pTable . " WHERE static_id !=1 AND static_id !=2 AND static_id !=3 ANd static_id !=4 ORDER by id DESC";
	        $row = self::$db->fetch_all($sql);

 		  $all_plans = Array();
          foreach($row as $rowItem){
            if($rowItem->period_name == 1) $real_name = "Hour";
            if($rowItem->period_name == 2) $real_name = "Day";
            if($rowItem->period_name == 3) $real_name = "Week";
            if($rowItem->period_name == 4) $real_name = "Month";
            if($rowItem->period_name == 5) $real_name = "Year";

            $rowItem->period_name = $real_name.(($rowItem->period > 1) ? 's' : '');
		    $rowItem->status = (($rowItem->active == 1) ? "<span class ='badge badge-dot badge-success'>active</span>" : "<span class ='badge badge-dot badge-danger'>inactive</span>");

		    array_push($all_plans,$rowItem->id);
          }

	      $this->planz = $row;

          $this->all_planz = Array();
          foreach($all_plans as $rowItem){
			  	$sql = "SELECT * FROM " . self::iTable . " WHERE plan='".$rowItem ."'";
		        $row = self::$db->fetch_all($sql);
          			foreach($row as $rowItem){
			          	$rowItem->name = getValue('username', self::uTable, 'id='.$rowItem->user_id);
			          	$rowItem->plan = getValue('name', self::pTable, 'id='.$rowItem->plan);
			          	$rowItem->invested = $rowItem->invested;
			          	$rowItem->profit = $rowItem->profit;
			          	$rowItem->ordered = getValue('time', self::dTable, 'ref_id="'.$rowItem->ref_id.'"');
			          	$rowItem->start = $rowItem->start;
			          	$rowItem->end = $rowItem->end;
			          	$rowItem->method = "";
			          	$rowItem->status = (($rowItem->status == 1) ? "<span class ='badge badge-dot badge-success'>active</span>" : "<span class ='badge badge-dot badge-danger'>inactive</span>");
		            }
		        array_push($this->all_planz,$row);
		  }
              $this->all_planz = json_decode(json_encode($this->all_planz));

	  }

      public function deletePlans($did){

	        self::$db->delete(self::pTable, "id ='".$did."'");

	        return true;

      }

      public function setNewPlan($item){

	        $data = Array(
	          'static_id' => 0,
	          'name' => sanitize($item['item1']),
	          'maximum' => sanitize($item['item2']),
	          'minimum' => sanitize($item['item3']),
	          'percent' => sanitize($item['item4']),
	          'period' => sanitize($item['item5']),
	          'period_name' => sanitize($item['item6']),
	          'description' => sanitize($item['item7']),
	          'feature1' => sanitize($item['item8']),
	          'feature2' => sanitize($item['item9']),
	          'feature3' => sanitize($item['item10']),
	          'feature4' => sanitize($item['item11']),
	          'feature5' => sanitize($item['item12']),
	          'active' => sanitize($item['item13'])
	        );

	        self::$db->insert(self::pTable, $data);

	        return true;

      }

      public function updatePlan($item){

	        $data = Array(
	          'static_id' => 0,
	          'name' => sanitize($item['item1']),
	          'maximum' => sanitize($item['item2']),
	          'minimum' => sanitize($item['item3']),
	          'percent' => sanitize($item['item4']),
	          'period' => sanitize($item['item5']),
	          'period_name' => sanitize($item['item6']),
	          'description' => sanitize($item['item7']),
	          'feature1' => sanitize($item['item8']),
	          'feature2' => sanitize($item['item9']),
	          'feature3' => sanitize($item['item10']),
	          'feature4' => sanitize($item['item11']),
	          'feature5' => sanitize($item['item12']),
	          'active' => sanitize($item['item13'])
	        );

        self::$db->update(self::pTable, $data, "id ='".$item['item14']."'");

        return true;

      }

      public function deleteUserPlans($did){

	        self::$db->delete(self::iTable, "id ='".$did."'");

	        return true;

      }

      public function updateUPlan($item){

		        $data = Array(
		          'invested' => sanitize($item['item1']),
		          'profit' => sanitize($item['item2']),
		          'status' => sanitize($item['item3'])
		        );

		        self::$db->update(self::iTable, $data, "id ='".$item['item4']."'");

		        return true;

      }

      public function admin_dashboard(){
		 $this->adm_tdeposit = getValue('SUM(amount) AS sum', self::dTable, ' status = 1',true,'sum');
          $week = strtotime("first day of this week");
          $month = strtotime("first day of this month");
		 $this->adm_tdeposit_m = getValue('SUM(amount) AS sum', self::dTable, ' status = 1 AND time >= "'.$month.'"',true,'sum');
		 $this->adm_tdeposit_w = getValue('SUM(amount) AS sum', self::dTable, ' status = 1 AND time >= "'.$week.'"',true,'sum');

		 $this->adm_twithdraw = getValue('SUM(amount) AS sum', self::wTable, ' status = 1',true,'sum');
		 $this->adm_twithdraw_m = getValue('SUM(amount) AS sum', self::wTable, ' status = 1 AND time >= "'.$month.'"',true,'sum');
		 $this->adm_twithdraw_w = getValue('SUM(amount) AS sum', self::wTable, ' status = 1 AND time >= "'.$week.'"',true,'sum');

		 $sql = "SELECT * FROM " . self::uTable;
		 $result = self::$db->query($sql);
		 $this->adm_tuser = self::$db->numrows($result);

		 $sql = "SELECT * FROM " . self::uTable. " WHERE reg_date > '".$month."'";
		 $result = self::$db->query($sql);
		 $this->adm_tuser_m =  self::$db->numrows($result);

		 $sql = "SELECT * FROM " . self::uTable. " WHERE reg_date > '".$week."'";
		 $result = self::$db->query($sql);
		 $this->adm_tuser_w = self::$db->numrows($result);

		 $sql = "SELECT * FROM " . self::pTable. " WHERE active = 1";
		 $result = self::$db->query($sql);
		 $this->adm_tplans = self::$db->numrows($result);

		 $this->adm_tinvested = getValue('SUM(invested) AS sum', self::iTable, 'status = 1',true,'sum');
		 $this->adm_tprofit = getValue('SUM(profit) AS sum', self::iTable, 'status = 1',true,'sum');

      }

   }