<?php
require('config/autoload.php');

$DB = Config::get_db();
$user = Model\User::fetch_user();
if($user) {
    if($user['role'] == 'pemimpin')
        header("Location: admin.php");
    else
        header("Location: kasus.php");
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $statement = $DB->prepare("SELECT * FROM user WHERE (`username` = ? or `email` = ?) AND `password` = ?");
    $statement->bind_param("sss",$_POST['username'], $_POST['username'], md5($_POST['password']));
    $statement->execute();
    $res=$statement->get_result()->fetch_assoc();
    if(!$res) {
        $error = "The combination of username and password doesn't exists. Please try again.";
    } else {
        //login ok!
        Model\User::save_login($res['id']);
        header("Location: index.php");
        exit();
    }
} else if(isset($_POST['username']) || isset($_POST['password'])) {
    $error = "Please enter both username and password.";    
}
View::render("index.php", ["error"=>$error]);
// phpnya jangan di tutup, inget.