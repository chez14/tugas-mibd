<?php
require('config/autoload.php');

// proses login disini

$error = null;

// tampilkan halaman login.php (dari folder views).
View::render("login.php", ["error"=>$error]);