<?php
require('config/autoload.php');

$DB = Config::get_db();
$user = Model\User::get_from_session();


View::render("index.php");
// phpnya jangan di tutup, inget.