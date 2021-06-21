<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class Pages{
      
	  const pTable = "pages";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::pTable;
          $row = self::$db->first($sql);
          
          $this->privacy = $row->privacy;
          $this->terms = $row->terms;

      }

      public function setTerms($item){

        $data = Array(
          'terms' => sanitize($item['item1'])
        );

        self::$db->update(self::pTable, $data, "id = 1");

        return true;

      }

      public function setPolicy($item){

        $data = Array(
          'privacy' => sanitize($item['item1'])
        );

        self::$db->update(self::pTable, $data, "id = 1");

        return true;

      }
   }