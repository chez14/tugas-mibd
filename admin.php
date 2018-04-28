<?php
require('config/autoload.php');

$user = Model\User::fetch_user();
if($user['role'] != 'pemilik')
    die(header('Location: index.php'));

$karyawan_total = Config::get_db()
    ->query("SELECT count(*) as total FROM user where `role`='karyawan'")
    ->fetch_assoc()['total'];


$karyawan_open = Config::get_db()
    ->query(
        "SELECT count(hasil.id) as total from (SELECT user.id as id FROM user " . 
            "LEFT JOIN kasus " . 
                "ON kasus.karyawan_id = user.id and kasus.closed_at is null " .    
            "where `role`='karyawan' and kasus.id is null group by user.id" . 
        ") as hasil")
    ->fetch_assoc()['total'];

$klien = Config::get_db()
        ->query("SELECT count(klien.id) as total from klien")
        ->fetch_assoc()['total'];

View::render("admin.php", [
    "title"=>"Admin",
    "kasus_open"=>Model\Kasus::count_open_kasus()[0]['total'],
    "karyawan_total" => $karyawan_total,
    "karyawan_open" => $karyawan_open,
    "klien_total" => $klien
]);