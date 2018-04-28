<?php
Namespace Model;

class User extends Base_Model {
    public static function get_user_by_id($id) {
        $statement = parent::get_db()->prepare("SELECT * FROM user WHERE id=?");
        $statement->bind_param("i", $id);
        $statement->execute();

        return \Helper\DB::fetch_all($statement->get_result());
    }

    public static function fetch_user() {
        $user = null;
        
        if(!isset($_COOKIE['user_id']) && !isset($_COOKIE['user_id']))
            return null;

        if(isset($_COOKIE['user_id'])) {
            $user = self::get_user_by_id($_COOKIE['user_id']);
        } else {
            $user = self::get_user_by_id($_SESSION['user_id']);
        }

        return $user;
    }
}