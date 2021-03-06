<?php
namespace Model;
class Pesan extends Base_Model {
    public static function get_pesan($case_id, $from = "2000-01-01") {
        $sql =  "SELECT * ";
        $sql .=     "FROM pesan_lengkap ";
        $sql .=     "where ";
        $sql .=         "kasus_id = ? and created_at > ?";
        $statement = parent::get_db()->prepare($sql);
        $from = date("Y-m-d H:i:s", ($from));
        $statement->bind_param("is", $case_id, $from);
        $statement->execute();
        return \Helper\DB::fetch_all($statement->get_result());
    }

    public static function get_pesan_since_id($id, $case_id) {
        $statement = parent::get_db()->prepare("SELECT * FROM pesan_lengkap WHERE id>=? AND kasus_id = ?");
        $statement->bind_param("ii", $id, $case_id);
        $statement->execute();
        return \Helper\DB::fetch_all($statement->get_result());
    }

    public static function add_pesan($pesan, $kasus, $user_id=null) {
        $statement = parent::get_db()->prepare("INSERT INTO pesan (`konten`, `created_at`, `kasus_id`, `user_id`) values(?,?,?,?)");
        $created = date("Y-m-d H:i:s");
        $statement->bind_param("ssii", $pesan, $created, $kasus, $user_id);
        $statement->execute();
        
        return $statement->insert_id;
    }
}