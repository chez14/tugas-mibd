<?php
Namespace Model;

class User extends Base_Model {
    public static function get_user_by_id($id) {
        $statement = parent::get_db()->prepare("SELECT * FROM user WHERE id=?");
        $statement->bind_param("i", $id);
        $statement->execute();

        return \Helper\DB::fetch_all($statement->get_result())[0];
    }

    public static function get_user($id) {
        $statement = parent::get_db()->prepare("SELECT * FROM user WHERE email=? or username=?");
        $statement->bind_param("ss", $id,$id);
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

    public static function logout() {
        setcookie('user_id', "", time() + (24*(-7)), "/");
        session_destroy();
    }


    public static function delete($user_id) {
        // Will perform hard deletations
        $statement = Config::get_db()->prepare("DELETE FROM `pesan` WHERE `user_id`=?;");
        $statement->bind_param("i", $user_id);
        $statement->execute();

        $statement = Config::get_db()->prepare("SELECT * FROM `klien` WHERE `user_id`=?;");
        $statement->bind_param("i", $user_id);
        $statement->execute();
        $klien_id = $statement->get_result()->fetch_assoc()['id'];

        $statement = Config::get_db()->prepare("DELETE FROM `kasus` WHERE `klien_id`=?;");
        $statement->bind_param("i", $klien_id);
        $statement->execute();

        $statement = Config::get_db()->prepare("DELETE FROM `klien` WHERE `user_id`=?;");
        $statement->bind_param("i", $user_id);
        $statement->execute();

        $statement = Config::get_db()->prepare("DELETE FROM `user` WHERE `id`=?;");
        $statement->bind_param("i", $user_id);
        $statement->execute();

        // all references deleted successfully.
    }
}