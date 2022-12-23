<?php 
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
  require_once("DB.php");
  $auth_user = new DBHelper();
  $email = $_POST['email'];

try{   
$err = array();
$msg = array();

if($_POST['updatePassword'])  
{
$email=$_POST['email'];

    $password=$_POST['password'];     
        $newsha1 = $auth_user->PwdHash($password);
        $userData=array(
            'password'=>$newsha1,
        );
        //var_dump($userData);
        $condition=array('email'=>$email);
        $update=$auth_user->update("users",$userData, $condition);
        $_SESSION['pass_msg'] = 'Password Changed Successfully';
        header("Location:index.php");
    } 


} catch (PDOException $ex) {
    echo $ex;
 header("Location:index3.php?sp=change_pass&msg=error_changing_password");
 }
?>