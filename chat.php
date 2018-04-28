<?php
require('config/autoload.php');

if(!isset($_GET['id']))
    die(View::render('internal_error.html', ['err'=>'You need to specity the ID of the case.']));

$kasus = Model\Kasus::get_kasus_by_id($_GET['id']);
View::render("chatbox.php", [
    "kasus"=>$kasus, 
    "user"=>Model\User::fetch_user()
]);