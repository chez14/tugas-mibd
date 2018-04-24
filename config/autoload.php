<?php
if(!is_file("config/database.php"))
    die(View::render("internal_error.html", [
        "err"=>"Your database is not correctly configured. Please check!"
    ]));

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
            die(View::render("internal_error.html", ["err"=>$d->connect_error]));
        }
        return $d;
    }

    static function boot() {
        spl_autoload_register(function($class_name) {
            $realpath = realpath(__DIR__ . "/..") . "/";
            $file = str_replace("\\", DIRECTORY_SEPARATOR, trim($class_name, "\\") . ".php");
            if(!is_file($realpath . $file))
                $file = strtolower($file);
            include ($realpath . $file);
        });
    }
}

Config::boot();