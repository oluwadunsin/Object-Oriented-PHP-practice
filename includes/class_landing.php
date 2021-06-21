<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class Landing{
      
	  const lTable = "landing";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::lTable;
          $row = self::$db->first($sql);
          
          $this->slider_title = $row->slider_title;
          $this->slider_description = $row->slider_description;
		  $this->members = $row->members;
          $this->deposits = $row->deposits;
		  $this->countries = $row->countries;
		  $this->choose_title = $row->choose_title;
		  $this->choose_description = $row->choose_description;
		  $this->choose_title1 = $row->choose_title1;
		  $this->choose_description1 = $row->choose_description1;
		  $this->choose_title2 = $row->choose_title2;
          $this->choose_description2 = $row->choose_description2;
		  $this->choose_title3 = $row->choose_title3;
		  $this->choose_description3 = $row->choose_description3;
		  $this->choose_title4 = $row->choose_title4;
          $this->choose_description4 = $row->choose_description4;
		  $this->choose_title5 = $row->choose_title5;
		  $this->choose_description5 = $row->choose_description5;
		  $this->choose_title6 = $row->choose_title6;
          $this->choose_description6 = $row->choose_description6;
		  $this->referral_title = $row->referral_title;
		  $this->referral_description = $row->referral_description;
		  $this->referral_level1 = $row->referral_level1;
          $this->referral_level2 = $row->referral_level2;
		  $this->referral_level3 = $row->referral_level3;
		  $this->footer_about_title = $row->footer_about_title;
          $this->footer_about_description = $row->footer_about_description;
		  $this->footer_about_point1 = $row->footer_about_point1;
		  $this->footer_about_point2 = $row->footer_about_point2;
		  $this->footer_about_point3 = $row->footer_about_point3;
		  $this->paymentgateways_title = $row->paymentgateways_title;
		  $this->paymentgateways_description = $row->paymentgateways_description;
		  $this->subscribe = $row->subscribe;

      }

      public function setLanding($item){

	      $data = Array(
	      	'slider_title' => sanitize($item['item1']),
	      	'slider_description' => sanitize($item['item2']),
	      	'members' => sanitize($item['item3']),
	      	'deposits' => sanitize($item['item4']),
	      	'countries' => sanitize($item['item5']),
	      	'choose_title' => sanitize($item['item6']),
	      	'choose_description' => sanitize($item['item7']),
	      	'choose_title1' => sanitize($item['item8']),
	      	'choose_description1' => sanitize($item['item9']),
	      	'choose_title2' => sanitize($item['item10']),
	      	'choose_description2' => sanitize($item['item11']),
	      	'choose_title3' => sanitize($item['item12']),
	      	'choose_description3' => sanitize($item['item13']),
	      	'choose_title4' => sanitize($item['item14']),
	      	'choose_description4' => sanitize($item['item15']),
	      	'choose_title5' => sanitize($item['item16']),
	      	'choose_description5' => sanitize($item['item17']),
	      	'choose_title6' => sanitize($item['item18']),
	      	'choose_description6' => sanitize($item['item19']),
	      	'referral_title' => sanitize($item['item20']),
	      	'referral_description' => sanitize($item['item21']),
	      	'referral_level1' => sanitize($item['item22']),
	      	'referral_level2' => sanitize($item['item23']),
	      	'referral_level3' => sanitize($item['item24']),
	      	'footer_about_title' => sanitize($item['item25']),
	      	'footer_about_description' => sanitize($item['item26']),
	      	'footer_about_point1' => sanitize($item['item27']),
	      	'footer_about_point2' => sanitize($item['item28']),
	      	'footer_about_point3' => sanitize($item['item29']),
	      	'paymentgateways_title' => sanitize($item['item30']),
	      	'paymentgateways_description' => sanitize($item['item31']),
	      	'subscribe' => sanitize($item['item32'])
	      );

	      self::$db->update(self::lTable, $data, "id = 1");

	      //upload imgs
	      if(check_image($_FILES['sliderImg'])) image_upload($_FILES['sliderImg'],'png','slide-bg','../img/background/');
	      if(check_image($_FILES['sliderBckg'])) image_upload($_FILES['sliderBckg'],'jpg','slide1','../img/background/');

	      return true;

      }
   }