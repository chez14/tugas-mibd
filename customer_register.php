<?php
require('config/autoload.php');
$DB = Config::get_db();
$error = null;

if(isset($_POST['username']))
{
	if(isset($_POST['password']) && $_POST['password']!=null)
	{
		$statement = $DB->prepare("INSERT INTO user(`email`,`name`,`username`,`password`,`role`) VALUES (?, ?, ?, ?, ?)");
		$statement->bind_param("sssss", 
			$_POST['email'], 
			$_POST['name'],
			$_POST['username'], 
			md5($_POST['password']),
			($role='client')
		);
		header("Location: index.php");
		exit();
	}
	else
	{
		$error .= "Both username and password must be filled. ";
	}
}

View::render("customer_register.php", ["error"=>$error, "title"=>"Register"]);