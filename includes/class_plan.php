<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');


  class Plan{
      
	  const pTable = "plan";
    const dTable = "deposit";
    const wTable = "withdrawal";
	  private static $db;
	  
	  
      function __construct(){
		  self::$db = Registry::get("Database");
		  $this->getSettings();

		  self::$db = Registry::get("Database");
		  $this->getPlans();

      self::$db = Registry::get("Database");
      $this->getDepositHistory();

      self::$db = Registry::get("Database");
      $this->getWithdrawalHistory();
      }
       
      private function getSettings(){

          $sql = "SELECT * FROM " . self::pTable . " WHERE static_id = 1 OR static_id = 2 OR static_id = 3 OR static_id = 4";
          $row = self::$db->fetch_all($sql);
          
          $this->title = $row[0]->name;
          $this->description = $row[1]->name;
          $this->deposits_title = $row[2]->name;
          $this->deposits_description = $row[3]->name;
      }
       
      private function getPlans(){

          $sql = "SELECT * FROM " . self::pTable . " WHERE static_id != 1 AND static_id != 2 AND static_id != 3 AND static_id != 4";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
            if($rowItem->period_name == 1){$real_name = "Hour"; $multiplier = 3600; }
            if($rowItem->period_name == 2){$real_name = "Day"; $multiplier = 86400; }
            if($rowItem->period_name == 3){$real_name = "Week"; $multiplier = 604800; }
            if($rowItem->period_name == 4){$real_name = "Month"; $multiplier = 2628288; }
            if($rowItem->period_name == 5){$real_name = "Year"; $multiplier = 31556952; }

            $rowItem->period_name = $real_name.(($rowItem->period > 1) ? 's' : '');
            $rowItem->period_multiply = $rowItem->period * $multiplier;
          }
          
          $this->table_arr = $row;
      }
       
      private function getDepositHistory(){

          $sql = "SELECT * FROM " . self::dTable . " WHERE status= 1 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
            static $cnt = 0;
            $rowItem->username = getValue('username', 'user', 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y");
            $rowItem->icon = $cnt;
            $cnt++;
            if($cnt > 5) $cnt = 0;
          }
          
          $this->deposit_arr = $row;
      }
       
      private function getWithdrawalHistory(){

          $sql = "SELECT * FROM " . self::wTable . " WHERE status= 1 ORDER by id DESC";
          $row = self::$db->fetch_all($sql);

          foreach($row as $rowItem){
            static $cnt = 0;
            $rowItem->username = getValue('username', 'user', 'id='.$rowItem->user_id);
            $rowItem->time = to_date($rowItem->time,"M d, Y");
            $rowItem->icon = $cnt;
            $cnt++;
            if($cnt > 5) $cnt = 0;
          }
          
          $this->withdrawal_arr = $row;
      }
   }