<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class About{
      
	  const aTable = "about";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::aTable;
          $row = self::$db->first($sql);
          
          $this->step1 = $row->step1;
          $this->step1_description = $row->step1_description;
		  $this->step2 = $row->step2;
          $this->step2_description = $row->step2_description;
		  $this->step3 = $row->step3;
		  $this->step3_description = $row->step3_description;
		  $this->youtube = $row->youtube;
		  $this->about_title = $row->about_title;
		  $this->about_description = $row->about_description;
		  $this->sub_about_title1 = $row->sub_about_title1;
          $this->sub_about_description1 = $row->sub_about_description1;
		  $this->sub_about_title2 = $row->sub_about_title2;
		  $this->sub_about_description2 = $row->sub_about_description2;

      }

      public function setAbout($item){

	      $data = Array(
	      	'step1' => sanitize($item['item1']),
	      	'step1_description' => sanitize($item['item2']),
	      	'step2' => sanitize($item['item3']),
	      	'step2_description' => sanitize($item['item4']),
	      	'step3' => sanitize($item['item5']),
	      	'step3_description' => sanitize($item['item6']),
	      	'youtube' => sanitize($item['item7']),
	      	'about_title' => sanitize($item['item8']),
	      	'about_description' => sanitize($item['item9']),
	      	'sub_about_title1' => sanitize($item['item10']),
	      	'sub_about_description2' => sanitize($item['item11']),
	      	'sub_about_title2' => sanitize($item['item12']),
	      	'sub_about_description2' => sanitize($item['item13']),
	      );

	      self::$db->update(self::aTable, $data, "id = 1");

	      //upload imgs
	      if(check_image($_FILES['utubeCover'])) image_upload($_FILES['utubeCover'],'jpg','ab','../img/about/');
	      
	      return true;

      }
   }