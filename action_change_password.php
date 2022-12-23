<?php 
  require_once("session.php");
  require_once("DB.php");
  $auth_user = new DBHelper();
  $userID = $_SESSION['user_session'];
  $user_privilege=$_SESSION['user_privilege'];
    /*This is Mine*/
try{   
$err = array();
$msg = array();

if($_POST['doUpdate'])  
{
    $userID=$_POST['userID'];
$user=$auth_user->getRows("users",array('where'=>array('userID'=>$userID),'order_by'=>'userID'));
foreach($user as $usr)
{
    $password=$usr['password'];
    $auth_user->PwdHash($_POST['pwd_old'],$old_salt);
    $old_salt = substr($password,0,9);
//check for old password in md5 format
    if($password === $auth_user->PwdHash($_POST['pwd_old'],$old_salt))
    {
        
        $newsha1 = $auth_user->PwdHash($_POST['pwd_new']);
        $userData=array(
            'password'=>$newsha1,
        );
        $condition=array('userID'=>$userID);
        $update=$auth_user->update("users",$userData, $condition);
        $_SESSION['pass_msg'] = 'Password Changed Successfully';
        header("Location:index3.php?msg=Password Changed Successfully");
    } 
    else{
        $err = "Your old password is invalid";
        $_SESSION['pass_error'] = $err;
        header("Location:index3.php?sp=change_password&msg=Your old password is invalid"); 
        //$err[] = "Your old password is invalid";
    }
}
}
} catch (PDOException $ex) {
    echo $ex;
 header("Location:index3.php?sp=change_password&msg=error_changing_password");
 }
?>