<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$email = $_POST['email'];
    if($_POST['doLogin'])
    {
        $checkEmail=$db->getRows("users",array('where'=>array('email'=>$email)));
        if($checkEmail){
            $_SESSION['forgot_email'] = $email;
            header("Location:change_pass.php");

        }else{
            header("Location:forgot_password.php?smg=userDoestExisit");
            
        }
        
    }

} catch (PDOException $ex) {
 header("Location:forgot_password.php?smg=error");
 }