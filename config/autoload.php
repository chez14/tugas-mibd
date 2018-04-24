<?php
if(!is_file("config/database.php"))
    die("Please set up your database.php first.");

require("config/database.php");
require("views/view.php");

class Config {
    /**
     * DO NOT EDIT THIS REGION
     */
    static function get_db() {
        $d = new mysqli(
            Config\DB::$db['host'],
            Config\DB::$db['username'],
            Config\DB::$db['password'],
            Config\DB::$db['dbname']
        );
        if($d->connect_error) {
            View::render("internal_error.html", ["err"=>$d->connect_error]);
            die();
        }
        return $d;
    }
}