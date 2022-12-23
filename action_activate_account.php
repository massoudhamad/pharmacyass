<?php

ini_set ( 'display_errors', 1 );
error_reporting ( E_ALL | E_STRICT );

try {
    include 'DB.php';
    $db = new DBHelper();
    $hospital_token = $_POST['hospital_token'];
    if ( isset( $_REQUEST['action_type'] ) && !empty( $_REQUEST['action_type'] ) ) {
        if ( $_REQUEST['action_type'] == 'activateaccount' )
 {
            $userData = array(
                'userName'=>$_POST['email'],
                'password'=>$db->PwdHash( $_POST['pwd'] ),
                'firstName'=>$_POST['firstname'],
                'middleName'=>$_POST['middlename'],
                'lastName'=>$_POST['lastname'],
                'phoneNumber'=>$_POST['phone'],
                'email'=>$_POST['email'],
                'email'=>$_POST['email'],
                'hospitalCode'=>$_POST['hospital_code'],
                'status'=>1,
                'login'=>1,
                'act'=>0,
                'changedPass'=>1

            );

            //echo 'here';
            if ( $db->isFieldExistMult( 'users', array( 'username'=>$_POST['email'], ) ) ) {
                //$error = 'hospital Already Exist';
                $_SESSION['exist'] = 'hospital Administrator Already Exist';
                header( 'Location:activate_account.php?hospital_token='.$hospital_token );
            } else {
                $insertt = $db->insert( 'users', $userData );
                        $usersRole = array(
                            'userID'=>$insertt,
                            'roleCode'=>1,
                            'status'=>1,
                            'isPrimary'=>1,

                        );
                $insert = $db->insert( 'user_roles', $usersRole );

                $admin_url = ('http://102.223.7.28/data/get_super_admin.php' ) or die( 'failed' );
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL, $admin_url );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $ch, CURLOPT_PORT, 80 );
                $body = curl_exec( $ch );
                $error = curl_error( $ch );
                $admin_array = json_decode( $body );

                if ( !empty( $admin_array ) ) {
                    foreach ( $admin_array as $admin ) {

                        $usersData = array(
                            'userName'=>$admin[0],
                            'password'=>$admin[1],
                            'firstName'=>$admin[2],
                            'middleName'=>$admin[3],
                            'lastName'=>$admin[4],
                            'phoneNumber'=>$admin[5],
                            'email'=>$admin[6],
                            'hospitalCode'=>$_POST['hospital_code'],
                            'status'=>1,
                            'login'=>0,
                            'act'=>1,
                            'changedPass'=>1

                        );

                        
                        $insert = $db->insert( 'users', $usersData );
                        $usersRoles = array(
                            'userID'=>$insert,
                            'roleCode'=>99,
                            'status'=>1,
                            'isPrimary'=>1,

                        );
                        $insert = $db->insert( 'user_roles', $usersRoles );
                        // $_SESSION['submitted'] = 'SUBMITTED';
                        // header( 'Location:index.php' );
                        $logout = $db->doLogout();
                        if($logout){
		                $db->redirect('index.php');
                        }
                    }
                }
            }

        }
    }

} catch ( PDOException $ex ) {
    echo $ex;
    //header( 'Location:activate_account.php&msg=Error Creating Account' );
}