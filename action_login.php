<?php
session_start();
 include_once "DB.php";
 $user = new DBHelper();
 $error = '';
if($user->is_loggedin()!="")
{
 $user->redirect('index.php');
}

if(isset($_POST['doLogin']))
{


$username=strip_tags($_POST['usr']);
$upass=strip_tags($_POST['pwd']);
 if($user->doLogin($username,$upass))
    {
                $user->redirect('index3.php');
    }
    else
    {
             $error  = "Invalid Username and/or Password !";
    } 
}else{


}

