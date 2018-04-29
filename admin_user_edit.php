<?php
require('config/autoload.php');

$user=Model\User::fetch_user();
if(!$user || $user['role'] != 'pemimpin')
    die(header("Location: index.php"));

$user = null;
if(isset($_REQUEST['id']))
    $user=Model\User::get_user_by_id($_REQUEST['id']);
$laporan = null;
try {
if($_POST['name']) {
    if($user) {
        // update
        $statement = Config::get_db()->prepare("UPDATE user SET name=?, email=?, username=?, `password`=? WHERE id=?");
        $statement->bind_param(
            "ssssi",
            $_POST['name'],
            $_POST['email'],
            $_POST['username'],
            ($pass=(isset($_POST['password'])?md5($_POST['password']):$user['password'])),
            $user['id']
        );
        $statement->execute();
        $user = Model\User::get_user_by_id($user['id']);
        $laporan = "Saved Successfully.";
    } else {
        $statement = Config::get_db()->prepare("INSERT INTO user (`name`, `email`, username, `password`, `role`) VALUES(?, ?, ?, ?, ?)");
        $statement->bind_param(
            "sssss",
            $_POST['name'],
            $_POST['email'],
            $_POST['username'],
            md5($_POST['password']),
            ($role='karyawan')
        );
        $statement->execute();
        
        header("location: admin_user_edit.php?id=" . $statement->insert_id);
        exit();
    }
}
} catch (\Exception $e) {
    $laporan = $e->getMessage();
}

View::render("admin_user_edit.php", ["user"=>$user, "laporan"=>$laporan]);