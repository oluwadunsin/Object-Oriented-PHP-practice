<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class Reviews{
      
	  const rTable = "reviews";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();

		  self::$db = Registry::get("Database");
		  $this->getReviews();
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::rTable . " WHERE static_id = 1 OR static_id = 2";
          $row = self::$db->fetch_all($sql);
          
          $this->title = $row[0]->stars;
          $this->description = $row[1]->stars;
      }
       
      private function getReviews(){

          $sql = "SELECT * FROM " . self::rTable . " WHERE static_id != 1 AND static_id != 2 ";
          $row = self::$db->fetch_all($sql);
          
          $this->reviews_arr = $row;

      }

      public function setReview($item){

        $data = Array(
          'stars' => sanitize($item['item1'])
        );

        self::$db->update(self::rTable, $data, "static_id = 1");

        $data = Array(
          'stars' => sanitize($item['item2'])
        );

        self::$db->update(self::rTable, $data, "static_id = 2");

        return true;

      }

      public function updateReview($item){

        $data = Array(
          'stars' => sanitize($item['item1']),
          'description' => sanitize($item['item2']),
          'reviewer' => sanitize($item['item3']),
          'occupation' => sanitize($item['item4']),
        );

        self::$db->update(self::rTable, $data, "id ='".$item['item5']."'");

        return true;

      }

      public function setNewReview($item){

        $data = Array(
          'static_id' => 0,
          'stars' => sanitize($item['item1']),
          'description' => sanitize($item['item2']),
          'reviewer' => sanitize($item['item3']),
          'occupation' => sanitize($item['item4']),
        );

        self::$db->insert(self::rTable, $data);

        return true;

      }

      public function deleteReview($item){

        self::$db->delete(self::rTable, "id ='".$item."'");

        return true;

      }
   }