<?php
namespace Helper;

class DB {
    public static function fetch_all($db_result) {
        return $db_result->fetch_all(MYSQLI_ASSOC);
    }
}