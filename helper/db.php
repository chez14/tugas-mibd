<?php
namespace Helper;

class DB {
    public static function fetch_all($db_result) {
        $temp = [];
        while($res = $db_result->fetch_array())
            $temp[] = $res;
        return $temp;
    }
}