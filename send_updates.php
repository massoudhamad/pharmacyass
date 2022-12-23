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
    $tblName = 'hospitallevel';
    $token = base64_encode( random_bytes( 32 ) );
    $hospital_token = strtr( $token, '+/', '-_' );

    $mail = new PHPMailer( true );

    //Server settings
    try {
        $mail->SMTPDebug = 1;
        // Enable verbose debug output
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
        $url = $db->returnClientUrl();
        $api_setting = $db->getRows( 'api_setting', array( 'order_by'=>'setting_id ASC' ) );
        foreach ( $api_setting as $api ) {
            $url = $api['URL'];

        }
        // Content
        // $mail->isHTML( true );
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        // Set email format to HTML
        //http://localhost/ehr/activate-hospital.php?hospital_token = '.$hospital_token.'
        //http://ehr.zenjtech.com/activate-hospital.php?hospital_token = '.$hospital_token.'
        $mail->Subject = 'HOSPITAL REGISTRATION';
        $mail->Body    =

        "Congratulations!

        Your Hospital has been registered for the use of Aspire EHR - an electronic medical records and hospital managmement system. An account has been created
        and a token generated for you to activate your hospital.
        To activate your hospital, please click the activation link below:
       
    
       '$url/activate_hospital.php?hospital_token=$hospital_token'
        

        If the link does not work please copy it to your browser address bar. 
        
        Thank you for choosing HM&Y Technologies.
        
        Aspire EHR Team.";

        if ( $mail->send() ) {

            $insert = $db->insert( 'hospital', $userData );
            $boolStatus = true;
            header( 'Location:index3.php?sp=manageHospital&msg=succ' );
        }

    } catch ( Exception $e ) {
        echo $e;
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

} catch ( PDOException $ex ) {
    echo $ex;
    //header( 'Location:index3.php?sp=manageHospital&msg=error' );
}