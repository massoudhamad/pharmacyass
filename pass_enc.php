<?php
include 'DB.php';
require 'vendor/vendor/autoload.php';
$db = new DBHelper();
$tblName='users';
$pass = $db->PwdHash("12345");

echo $pass;