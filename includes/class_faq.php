<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class Faq{
      
	  const fTable = "faq";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();

		  self::$db = Registry::get("Database");
		  $this->getFaqs();
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::fTable . " WHERE static_id = 1 OR static_id = 2";
          $row = self::$db->fetch_all($sql);
          
          $this->title = $row[0]->question;
          $this->description = $row[1]->question;
      }
       
      private function getFaqs(){

          $sql = "SELECT * FROM " . self::fTable . " WHERE static_id != 1 AND static_id != 2";
          $row = self::$db->fetch_all($sql);
          $result = self::$db->query($sql);
          $this->faqs = $row;
          $total = ceil(self::$db->numrows($result)/2);

          $chunked_row = array_chunk($row, $total);
          
          $this->faqs1 = $chunked_row[0];
          $this->faqs2 = $chunked_row[1];

      }

      public function setFaq($item){

        $data = Array(
          'question' => sanitize($item['item1'])
        );

        self::$db->update(self::fTable, $data, "static_id = 1");

        $data = Array(
          'question' => sanitize($item['item2'])
        );

        self::$db->update(self::fTable, $data, "static_id = 2");

        return true;

      }

      public function updateFaq($item){

        $data = Array(
          'question' => sanitize($item['item1']),
          'answer' => sanitize($item['item2'])
        );

        self::$db->update(self::fTable, $data, "id ='".$item['item3']."'");

        return true;

      }

      public function setNewFaq($item){

        $data = Array(
          'static_id' => 0,
          'question' => sanitize($item['item1']),
          'answer' => sanitize($item['item2'])
        );

        self::$db->insert(self::fTable, $data);

        return true;

      }

      public function deleteFaq($item){

        self::$db->delete(self::fTable, "id ='".$item."'");

        return true;

      }
   }