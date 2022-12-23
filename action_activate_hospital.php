<?php
// ini_set ( 'display_errors', 1 );
// error_reporting ( E_ALL | E_STRICT );

try {
    include 'DB.php';
    $db = new DBHelper();
    $_SESSION['user_session'] = 0;
    if ( isset( $_REQUEST['action_type'] ) && !empty( $_REQUEST['action_type'] ) ) {
        if ( $_REQUEST['action_type'] == 'activatehospital' ){

$hospital_token = $_POST['hospital_token'];
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
$logo = rand( 1000, 1000000 ).'.'.$imgExt;
//$_FILES['profile']['name'];
//

// allow valid image file formats
if ( in_array( $imgExt, $valid_extensions ) ) {

// Check file size '5MB'
if ( $imgSize < 5000000 ) { move_uploaded_file( $tmp_dir, $upload_dir.$logo ); } else {
    $errMSG='Sorry, your file is too large.' ; } } else { $errMSG='Sorry, only JPG, JPEG, PNG & GIF files are allowed.'
    ; } $userData=array( 'hospitalID'=>$_POST['last_id'],
    'hospitalName'=>$_POST['name'],
    'hospitalCode'=>$_POST['code'],
    'hosp_short_name'=>$_POST['shortname'],
    'address'=>$_POST['address'],
    'telephoneNumber'=>$_POST['pnumber'],
    'email'=>$_POST['email'],
    'url'=>$_POST['website'],
    'hosp_short_name'=>$_POST['shortname'],
    'firstname'=>$_POST['firstname'],
    'middlename'=>$_POST['middlename'],
    'lastname'=>$_POST['lastname'],
    'hospitalLevelID'=>$_POST['FacilityLevel'],
    'districtCode'=>$_POST['districtID'],
    'hospitallevelrank'=> $_POST['hospitallevelrank'],
    'hospital_token'=> $_POST['hospital_token'],
    'hospital_logo'=>$logo,
    'createdBy'=>$_POST['createdBy'],
    'isRegistered'=>1,
    );
   $token = $_POST['hospital_token'];
    if ( $db->isFieldExistMult( 'hospital', array( 'hospitalName'=>$_POST['name'], ) ) ) {
    $error = 'hospital Already Exist';
    $_SESSION['hospital_token'] = $_POST['hospital_token'];
    header( 'Location:activate_account.php?hospital_token='.$token );
    } else {
    $insert = $db->insert( 'hospital', $userData );

    $roles_json = ('http://hmis.skychuo.com/data/get_roles_api.php' ) or die( 'failed' );
    
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $roles_json );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $roles_json_array = json_decode( $body );

    if ( !empty( $roles_json_array ) ) {
    foreach ( $roles_json_array as $roles ) {

    $userData = array(
    'roleCode'=> $roles->roleCode,
    'role'=> $roles->role,
    );

    $insert = $db->insert( 'roles', $userData );
    $boolStatus = true;
    //$_SESSION['msg'] = 'Services Have been Downloaded successfully';

    }
    }

    $boolStatus = true;
    $_SESSION['hospital_token'] = $_POST['hospital_token'];
    header( 'Location:activate_account.php?hospital_token='.$token );
    }

    }
    }
    } catch ( PDOException $ex ) {
    //echo $ex;
    header( 'Location:index3.php?sp = manageHospital&msg = error' );
    }