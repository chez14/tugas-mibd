<?php
require('config/autoload.php');

$DB = Config::get_db();
$user = Model\User::fetch_user();
if($user) {
    if($user['role'] == 'pemilik')
        header("Location: admin.php");
    else
        header("Location: kasus.php");
    exit();
}
View::render("index.php");
// phpnya jangan di tutup, inget.