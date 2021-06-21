<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');
  	  
    abstract class Registry{
        static $objects = array();

        public static function get($name){
            return isset(self::$objects[$name]) ? self::$objects[$name] : null;
        }

        public static function set($name, $object){
            self::$objects[$name] = $object;
        }
    }
?>