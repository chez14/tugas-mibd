<?php
namespace Model;

class Kasus extends Base_Model {

    public static function get_kasus_by_id($kasus_id){
        $statement = parent::get_db()->prepare("SELECT * FROM kasus_lengkap where id=?");
        $statement->bind_param("i", $kasus_id);
        $statement->execute();
        return \Helper\DB::fetch_all($statement->get_result())[0];
    }

    public static function get_kasus_by_user($klien_id) {
        $statement = parent::get_db()->prepare("SELECT * from kasus_lengkap where klien_id=? ORDER BY closed_at ASC");
        $statement->bind_param("i", $klien_id);
        $statement->execute();
        return \Helper\DB::fetch_all($statement->get_result());
    }
    
    public static function count_open_kasus() {
        $statement = parent::get_db()->prepare("SELECT count(id) as total from kasus_lengkap  WHERE closed_at is null");
        $statement->execute();
        return \Helper\DB::fetch_all($statement->get_result());
    }


    public static function assign_kasus($kasus_id, $karyawan_id) {
        $statement = parent::get_db()->prepare("UPDATE kasus SET karyawan_id = ? WHERE id = ?");
        $statement->bind_param("ii", $karyawan_id, $kasus_id);
        $statement->execute();
        return $statement->insert_id;
    }

    public static function create_kasus($title, $user_id) {
        $statement = parent::get_db()->prepare("SELECT * FROM klien WHERE id_user=?");
        $statement->bind_param("i", $user_id);
        $statement->execute();
        $res = \Helper\DB::fetch_all($statement->get_result())[0];
        $statement = parent::get_db()->prepare("INSERT INTO kasus (nama, klien_id) values (?, ?)");
        $statement->bind_param("si", $title, $res['id']);
        $statement->execute();
        return $statement->insert_id;
    }

    public static function close_kasus($kasus_id) {
        $statement = parent::get_db()->prepare("UPDATE kasus SET closed_at = ? WHERE id = ?");
        $statement->bind_param("si", date("Y-m-d H:i:s"), $kasus_id);
        $statement->execute();
        return $statement->insert_id;
    }
}