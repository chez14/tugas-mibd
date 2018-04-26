<?php

namespace Model;

abstract class Base_Model {
    private static $db;
    protected function get_db() {
        if(!self::$db){
            self::$db = \Config::get_db();
        }
        return self::$db;
    }
    
}