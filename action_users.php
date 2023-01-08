<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
try {
include 'DB.php';
require 'vendor/vendor/autoload.php';
$db = new DBHelper();
$tblName='users';
$pass = $db->PwdHash($_POST['lname']);
$userID = $_POST['userID'];
if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add')
    {
                $userData = array(
                    'userName'=>$_POST['email'],
                    'firstName'=>$_POST['fname'],
                    'middleName'=>$_POST['mname'],
                    'lastName'=>$_POST['lname'],
                    'gender'=>$_POST['gender'],
                    'password'=>$pass,
                    'phoneNumber'=>$_POST['phone'],
                    'email'=>$_POST['email'],
                    'hospitalCode'=>$_POST['hospitalCode'],
                    'status'=>1,
                    'login'=>1,
                    'act'=>1,
                );

               
                $password= $_POST['lname'];
                if ($db->isFieldExist($tblName, 'email', $_POST['email'])) {
                    $boolStatus = false;
                    $_SESSION['msg'] = 'Data Already Exist';
                header("Location:index3.php?sp=users");
                } else {
                    try {
                    
                $mail = new PHPMailer( true );

                //Server settings
              
                    $mail->SMTPDebug = 0;
                    //Enable verbose debug output
                    $mail->isSMTP();
                    // Send using SMTP
                    //$mail->Host       = 'abdulmajeedhajji@gmail.com';

                    $mail->Host = 'smtp.gmail.com';
                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;
                    // Enable SMTP authentication
                    $mail->Username   = 'abdulmajeedhajji@gmail.com';
                    // SMTP username
                    $mail->Password   =   'somebody567890';
                    // SMTP password
                    $mail->SMTPSecure = 'tls';
                    // Enable TLS encryption;
                    //`PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port = 587;
                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom( 'abdulmajeedhajji@gmail.com' );
                    $mail->addAddress( $_POST['email'] );
                    // Add a recipient
                    $mail->addReplyTo( 'abdulmajeedhajji@gmail.com' );
                    // $url = $db->returnClientUrl();
                    $email=$_POST['email'];
                    
                    $mail->Subject = 'ACCOUNT CREATION';
                    $mail->Body    =

                    "Congratulations!

        You has been registered for the use of Aspire EMR - an electronic medical records and hospital managmement system. An account has been created
        The following are your Account Credention for Login.You should change your password once after successfully
        login for security purpose:
        
        Username: $email
        Password: $password
        
 
        Thank you for choosing EMR.
        
        Aspire EMR Team.";

        if ( $mail->send() ) {
            $insert = $db->insert($tblName,$userData);
            foreach($_POST['roleID'] as $key=>$value){
                
                 $userRole = array(
                    'userID'=>$insert,
                    'roleCode'=>$_POST['roleID'][$key],
                    'status'=>1,
                    
                );
                 $insertRole = $db->insert('user_roles',$userRole);
            }
            
           
            $boolStatus=true;
            $_SESSION['msg'] = 'Data Inserted Successfully';
            header("Location:index3.php?sp=users");
        }
    }
        //code...
                     catch (Exception $e) {
                        $_SESSION['msg'] = 'Something Went Wrong';
                        header("Location:index3.php?sp=users&error=$mail->ErrorInfo");
                    }
                }
                
    }else if($_REQUEST['action_type'] == 'edit'){
   
    $userData = array(
        // 'userName'=>$_POST['email'],
        'firstName'=>$_POST['fname'],
        'middleName'=>$_POST['mname'],
        'lastName'=>$_POST['lname'],
        'gender'=>$_POST['gender'],
        // 'password'=>$pass,
        'phoneNumber'=>$_POST['phone'],
        'email'=>$_POST['email'],
        //'roleCode'=>$_POST['roleID'],
        'hospitalCode'=>$_SESSION['hospitalCode'],
        'status'=>1,
        'login'=>1,
    );


    // if(isset($_POST['primaryroleID'])){
    //     $condition = array('userID'=>$userID);
    //     $roles = $_POST['roleID'];
    //     print_r($_POST['roleID']);
        //$update = $db->update($tblName,$userData,$condition);
    //     $delete=$db->delete("user_roles",$condition);
    //     if($delete){
            
    //         $newRole = $_POST['primaryroleID'];
    //         $userRole = array(
    //             'userID'=>$userID,
    //             'roleCode'=>$newRole,
    //             'status'=>1,
    //         );
    //         $conditions = array('userID'=>$userID);
    //         $insertRole = $db->insert('user_roles',$userRole);
    //     }
    // }else if(isset($_POST['roleID[]'])){
        $condition = array('userID'=>$userID);
        $roles = $_POST['roleID'];
        print_r($_POST['roleID']);
        echo $_POST['primaryroleID'];
        //$update = $db->update($tblName,$userData,$condition);
        $delete=$db->delete("user_roles",$condition);
        if($delete){
            foreach( $roles  as $key=>$value){
                $newRole = $_POST['roleID'][$key];
                $userRole = array(
                'userID'=>$userID,
                'roleCode'=>$newRole,
                'status'=>0,
                );
                $conditions = array('userID'=>$userID);
                $insertRole = $db->insert('user_roles',$userRole);
            }
            $data=array(
                'roleCode'=>$_POST['primaryroleID'],
                'userID'=>$userID,
                'status'=>1,
                'isPrimary'=>1
            );
            $conditions = array('userID'=>$userID);
            $insertRole = $db->insert('user_roles',$data);
        }
    //}

    
    // $condition = array('userID'=>$userID);
    // $roles = $_POST['roleID'];
    // print_r($_POST['roleID']);
    //$update = $db->update($tblName,$userData,$condition);
    // $delete=$db->delete("user_roles",$condition);
    // if($delete){
    //         foreach( $roles  as $key=>$value){
    //             $newRole = $_POST['roleID'][$key];
    //              $userRole = array(
    //                 'userID'=>$userID,
    //                 'roleCode'=>$newRole,
    //                 'status'=>1, 
    //             );
    //                 $conditions = array('userID'=>$userID);
    //                 $insertRole = $db->insert('user_roles',$userRole);
    //         }
    //     }
            
    header("Location:index3.php?sp=users&msg=succ");
}
}
}catch (PDOException $ex) {
    $_SESSION['msg'] = 'Something Went Wrong';
    header("Location:index3.php?sp=users");
 //echo $ex;
 }

?>