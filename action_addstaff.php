<?php
ini_set ( 'display_errors', 1 );
error_reporting ( E_ALL | E_STRICT );
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
try {
    include 'DB.php';
    require 'vendor/vendor/autoload.php';
    $db = new DBHelper();
    if ( isset( $_POST['action_type'] ) && !empty( $_REQUEST['action_type'] ) ) {
        if ( $_REQUEST['action_type'] == 'addstaff' ) {
            $imgFile = $_FILES['profile']['name'];
            $tmp_dir = $_FILES['profile']['tmp_name'];
            $imgSize = $_FILES['profile']['size'];
            $upload_dir = 'profile_img/';
            // upload directory

            $imgExt = strtolower( pathinfo( $imgFile, PATHINFO_EXTENSION ) );
            // get image extension

            // valid image extensions
            $valid_extensions = array( 'jpeg', 'jpg', 'png', 'gif' );
            // valid extensions

            // rename uploading image
            $userpic = rand( 1000, 1000000 ).'.'.$imgExt;
            //$_FILES['profile']['name'];
            //

            // allow valid image file formats
            if ( in_array( $imgExt, $valid_extensions ) ) {

                // Check file size '5MB'
                if ( $imgSize < 5000000 ) {
                    move_uploaded_file( $tmp_dir, $upload_dir.$userpic );
                } else {
                    $errMSG = 'Sorry, your file is too large.';
                }
            } else {
                $errMSG = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';

            }
            $resgisterData = array(
                'firstname'=>$_POST['firstName'],
                'middlename'=>$_POST['middleName'],
                'lastname'=>$_POST['lastName'],
                'physicalAddress'=>$_POST['physicalAddress'],
                'dateofbirth'=>$_POST['dateofbirth'],
                'tell'=>$_POST['tell'],
                'email'=>$_POST['email'],
                'profile'=>$userpic,
                'eduLevel'=>$_POST['eduLevel'],
                'graduationDate'=>$_POST['graduationDate'],
                'award'=>$_POST['award'],

            );
            $usersData = array(
                'firstName'=>$_POST['firstName'],
                'middleName'=>$_POST['middleName'],
                'lastName'=>$_POST['lastName'],
                'password'=>$db->PwdHash( $_POST['lastName'] ),
                'email'=>$_POST['email'],
                'status'=>1,
                'login'=>1,
                'roleCode'=>$_POST['roleId']

            );

            if ($db->isFieldExist('users', 'email', $_POST['email'])) {
                $boolStatus = false;
                $msg = "exists";
                $_SESSION['msg'] = "Staff Already Exist";
                header("Location:index3.php?sp=registerstaff");
            } else {
                
                   
            try {
                $mail = new PHPMailer( true );


				$pwd = $db->PwdHash( $_POST['lastName']);
                $pass =  $_POST['lastName'];
                $name = $_POST['firstName']." ".$_POST['middleName']." ".$_POST['lastName'];
				$email = $_POST['email'];
				$mail->isSMTP();
				$mail->Host = 'hmytechnologies.com';
				$mail->Port =587;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->Username = 'ehr-support@hmytechnologies.com';
				$mail->Password = 'Ehr@2021';
				$mail->From = 'ehr-support@hmytechnologies.com';
				$mail->FromName = 'HMY TECHNOLOGIES';
				
				$mail->addAddress($email);
				$mail->IsHTML(true);
				$mail->Subject = 'USER REGISTRATION';
				$mail->Body = "Congratulations. Your account have been created! <br /> <br />
					

				Hi  $name, <br /> <br />

				You have been registered for the use of Aspire EMR - an electronic medical records and hospital management system at Pharmacy Name.<br /> <br /> 
				
				To continue using ShuleYangu please login using the following credentials: <br /> 	
				Username: $email<br />
				Password: $pass <br />
				
				For security purpose, you will be required to change your password at your first login. You may always change your password whenever you want to.<br /><br />
				
				If you have any questions regarding your account, please contact your hospital IT administrator.<br /><br />

				Thank you for choosing HM&Y Technologies services, and we wish you happy and productive use of Aspire EHR.<br /><br />
				
				Aspire EMR Team,<br/><br />
				HM&Y Technologies  | HMIS - Ministry of Health, Zanzibar.<br />";


                }catch ( PDOException $e ) {
                    //echo $e;
                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    header("location:home.php?sp=registerstaff&msg=$mail->ErrorInfo");
                } 

            if($mail->Send()){
                $insert = $db->insert( 'staff', $resgisterData );
                $insert = $db->insert( 'users', $usersData );
                $boolStatus = true;
                $_SESSION['msg'] = "Staff Registered Successfully";
                header( 'Location:index3.php?sp=staff#&msg=succ' );
                
				}


					}
        } else if ( $_REQUEST['action_type'] == 'editstaff' ) {

            $imgFile = $_FILES['profile']['name'];
            $tmp_dir = $_FILES['profile']['tmp_name'];
            $imgSize = $_FILES['profile']['size'];
            $upload_dir = 'profile_img/';
            // upload directory

            $imgExt = strtolower( pathinfo( $imgFile, PATHINFO_EXTENSION ) );
            // get image extension

            // valid image extensions
            $valid_extensions = array( 'jpeg', 'jpg', 'png', 'gif' );
            // valid extensions

            // rename uploading image
            $userpic = rand( 1000, 1000000 ).'.'.$imgExt;
            //$_FILES['profile']['name'];
            //

            // allow valid image file formats
            if ( in_array( $imgExt, $valid_extensions ) ) {

                // Check file size '5MB'
                if ( $imgSize < 5000000 ) {
                    move_uploaded_file( $tmp_dir, $upload_dir.$userpic );
                } else {
                    $errMSG = 'Sorry, your file is too large.';
                }
            } else {
                $errMSG = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';

            }

            $userData = array(
                'firstname'=>$_POST['firstName'],
                'middlename'=>$_POST['middleName'],
                'lastname'=>$_POST['lastName'],
                'physicalAddress'=>$_POST['physicalAddress'],
                'dateofbirth'=>$_POST['dateofbirth'],
                'tell'=>$_POST['tell'],
                'cadreID'=>$_POST['cadreID'],
                'deptID'=>$_POST['deptID'],
                'schoolAttended'=>$_POST['schoolAttended'],
                'degreeHeld'=>$_POST['degreeHeld'],
                'licence'=>$_POST['Licence'],
                'email'=>$_POST['email'],
                'facebook'=>$_POST['facebook'],
                'employeeId'=>$_POST['employeeId'],
                'profile'=>$userpic,

            );

            $conditions = array( 'employeeId'=>$_POST['employeeId'] );
            $update = $db->update( 'staff', $userData, $conditions );
            $_SESSION['error'] = "Staff Update Successfully";
            header( 'Location:index3.php?sp=staff#&msg=succ' );
        }

    }

} catch ( PDOException $ex ) {
    $_SESSION['error'] = "OOps Something Occured";
    //header( 'Location:index3.php?sp=registerstaff&msg=error' );
    echo $ex;
}