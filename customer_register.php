<?php
require('config/autoload.php');

$error = null;

// tampilkan halaman login.php (dari folder views).
View::render("customer_register.php", ["error"=>$error, "title"=>"Register"]);