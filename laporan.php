<?php
require('config/autoload.php');


$open_case = Helper\DB::fetch_all(
    Config::get_db()
        ->query("SELECT * FROM kasus where closed_at is null")
);

$unassigned_case = Helper\DB::fetch_all(
    Config::get_db()
        ->query("SELECT * FROM kasus where closed_at is null and karyawan_id is null")
);

$karyawan_free = Helper\DB::fetch_all(
    Config::get_db()
    ->query(
        "SELECT user.* from user cross join (SELECT user.id as id FROM user " . 
            "LEFT JOIN kasus " . 
                "ON kasus.karyawan_id = user.id and kasus.closed_at is null " .    
            "where `role`='karyawan' and kasus.id is null group by user.id" . 
        ") as hasil ON user.id = hasil.id")
);

$waktu_rata = Config::get_db()
        ->query("SELECT avg(convert(kambing.durasi,DECIMAL)) as rata FROM (select TIMESTAMPDIFF(DAY, kasus.created_at, kasus.closed_at) as durasi from kasus where not(closed_at is null)) as kambing")
        ->fetch_assoc()['rata'];

View::render("laporan.php", [
    "case_open" => $open_case,
    "case_unassign" => $unassigned_case,
    "karyawan_free"=> $karyawan_free,
    "case_rata_rata" => $waktu_rata,
]);