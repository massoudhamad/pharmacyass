<?php
//session_start();
include_once "DB.php";
$user = new DBHelper();
$error = '';

if($user->is_loggedin()!="")
{
 $user->redirect('index.php');
}

$username=strip_tags($_POST['usr']);
$upass=strip_tags($_POST['pwd']);
if(isset($_POST['doLogin']))
{
    $ch = curl_init();
    $login_url = ("http://localhost/ehr-server/data/server-login.php?username='$username'") or die("failed");
    $postData = "usr=".$username&"username=".$upass;
    curl_setopt($ch, CURLOPT_URL,$login_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    echo $server_output;
    curl_close ($ch);
	
    
    
}else{

    if($user->doLogin($username,$upass))
    {
       
                $user->redirect('index3.php');
    }
    else
    { echo 'new';
             $error  = "Invalid Username and/or Password !";
    } 
   
}

?>