<?php
require('config/autoload.php');

$users = null;
$user_type = null;
$allow_tambah = false;

$laporan = null;
try {
    if(isset($_GET['delete'])) {
        Model\User::delete($_GET['delete']);
        $laporan = "Successfully deleted " . $_GET['delete'] . ".";
    }
} catch(\Exception $e) {
    $laporan .= "Failed to delete " . $_GET['delete'] . ", with error: " . $e->getMessage();
}

if(isset($_GET['tipe']) && $_GET['tipe'] == 'karyawan') {   
    $users = Config::get_db()->query("SELECT * FROM user WHERE `role`='karyawan'");
    $users = Helper\DB::fetch_all($users);
    $user_type = "Karyawan";
    $allow_tambah = true;
} else {
    $users = Config::get_db()->query("SELECT * FROM user WHERE `role`='client'");
    $users = Helper\DB::fetch_all($users);
    $user_type = "Client";
    $allow_tambah = false;
}

View::render("admin_user.php", [
    "users"=>$users,
    "user_type" => $user_type,
    "allow_new" => $allow_tambah,
    "laporan" => $laporan
]);