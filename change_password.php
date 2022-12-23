<?php 
  require_once("session.php");
  require_once("DB.php");
  $auth_user = new DBHelper();
  $userID = $_SESSION['user_session'];
  $user_privilege=$_SESSION['user_privilege'];
    /*This is Mine*/
    
$err = array();
$msg = array();

if($_POST['doUpdate'] == 'Update')  
{
    $userID=$_POST['userID'];
$user=$auth_user->getRows("users",array('where'=>array('userID'=>$userID),'order_by'=>'userID'));
foreach($user as $usr)
{
    $password=$usr['password'];
    $old_salt = substr($password,0,9);
    
//check for old password in md5 format
    if($password === $auth_user->PwdHash($_POST['pwd_old'],$old_salt))
    {
        $newsha1 = $auth_user->PwdHash($_POST['pwd_new']);
        $userData=array(
            'password'=>$newsha1,
            'login'=>1
        );
        $condition=array('userID'=>$userID);
        $update=$auth_user->update("users",$userData, $condition);
        header("Location: index3.php");
    } 
    else
    {
         $err[] = "Your old password is invalid";
    }
}
}
?>






<div class="card-content collapse show">
    <div class="card-body">
        <form class="form" style="margin-left:200px;margin-right:200px;margin-top:80px" name="" method="post" action="">
            <div class="form-body">
                <h3 class="form-section"><i class="la la-lock"></i> Change Password</h3>
                <?php
                         /******************** ERROR MESSAGES*************************************************
                            This code is to show error messages 
                         **************************************************************************/
                            if(!empty($err))  {
                                 echo "<div class=\"msg\">";
                                foreach ($err as $e) {
                                    echo "$e <br>";
                                     }
                                     echo "</div>";	
                                     }
                                     /******************************* END ********************************/	  
                                     ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="userinput1">Enter Password</label>
                            <span class="danger">*</span>
                            <input type="password" id="pwd_old" name="pwd_old" class="form-control border-primary"
                                required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userinput3">Neww Password</label>
                            <span class="danger">*</span>
                            <input type='password' id="password" name="pwd_new" class="form-control border-primary"
                                required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userinput3">Conform Password</label>
                            <span class="danger"> *</span>
                            <input type='password' id="confirm_password" name="pwd_new"
                                class="form-control border-primary" required />
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="userID" value="<?php echo $_SESSION['user_session'];?>">
            <input type="submit" name="doUpdate" class="form-control btn btn-default btn-primary" value="Update">
            <!--<button OnClick="LogIn" Text="Log in" class="form-control btn btn-default btn-primary">Sign In</button>-->
        </div>
    </div>
    </form>

</div>
</div>
</div>
</div>
</div>