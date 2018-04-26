<?php
namespace Model;
class Pesan extends Base_Model {
    public static function get_pesan($case_id, $from = "2000-01-01") {
        $statement = parent::get_db()->prepare("SELECT * FROM pesan_lengkap where kasus_id = ? and created_on > ?");
        $from = date("Y-m-d H:i:s", strtotime($from));
        $statement->bind_param("is", $case_id, $from);
        $statement->execute();
        return Helper\DB::fetch_all($statement->get_result());
    }

    public static function add_pesan_karyawan($pesan, $kasus, $karyawan_id=null) {
        $statement = parent::get_db()->prepare("INSERT INTO pesan (content, created_on, kasus_id) values(?,?,?)");
        $created = date("Y-m-d H:i:s");
        $statement->bind_param("ssi", $pesan, $created, $kasus);
        $statement->execute();
        $pesan_id = $statement->insert_id;
        $statement = parent::get_db()->prepare("INSERT INTO pesan_karyawan (id, karyawan_id) values(?,?)");
        $statement->bind_param("ss", $pesan_id, $karyawan_id);
        $statement->execute();
        
        return $pesan_id;
    }

    public static function add_pesan_klien($pesan, $kasus, $klien_id=null) {
        $statement = parent::get_db()->prepare("INSERT INTO pesan (content, created_on, kasus_id) values(?,?,?)");
        $created = date("Y-m-d H:i:s");
        $statement->bind_param("ssi", $pesan, $created, $kasus);
        $statement->execute();
        $pesan_id = $statement->insert_id;
        $statement = parent::get_db()->prepare("INSERT INTO pesan_klien (id, klien_id) values(?,?)");
        $statement->bind_param("ss", $pesan_id, $klien_id);
        $statement->execute();
        
        return $pesan_id;
    }
}