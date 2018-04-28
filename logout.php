<?php
require('config/autoload.php');

// clear all cookies
Model\User::logout();
header("Location: index.php");