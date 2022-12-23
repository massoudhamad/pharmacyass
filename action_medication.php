<?php
// ini_set ( 'display_errors', 1 );
// error_reporting ( E_ALL | E_STRICT );
try {
    include 'DB.php';
    $db = new DBHelper();
    $patientNo = $_REQUEST['patientNo'];
    $visitNo = $_REQUEST['visitNo'];
    $id = $_POST['drugID'];
    // echo $patientNo;
    // echo $visitNo;
    if ( isset( $_REQUEST['action_type'] ) && !empty( $_REQUEST['action_type'] ) ) {
        if ( $_REQUEST['action_type'] == 'add' ) {
            foreach ( $id as $key=>$value ) {
                $drug = $_POST['drugID'][$key];
                $dose = $_POST['dose'][$key];
                $userData = array(
                    'patientNo'=>$_POST['patientNo'],
                    'visitNo'=>$visitNo,
                    'drugID'=>$drug,
                    'reportingDate'=>date( 'Y:m:d' ),
                    'dose'=>$dose,
                    'userID'=>$_SESSION['user_session']

                );
                $disgnosisData = array(
                    'pharmacy'=>1,

                );
                if ( $db->isFieldExistMult( 'patient_medication', array( 'patientNo'=>$patientNo, 'visitNo'=>$visitNo, 'drugID'=>$drug ) ) ) {
                    header( "Location:index3.php?sp=medication&patientNo=$patientNo&visitNo=$visitNo&msg=exist" );

                } else {
                    $conditions = array( 'patientNo'=>$patientNo, 'visitNo'=>$visitNo );
                    $insert = $db->update( 'consultation', $disgnosisData,$conditions );
                    $insert = $db->insert( 'patient_medication', $userData );
                    $boolStatus = true;
                    header( "Location:index3.php?sp=medication&patientNo=$patientNo&visitNo=$visitNo&msg=succ" );
                }
            }
        }
    }

} catch ( PDOException $ex ) {
    header( "Location:index3.php?sp=medication&patientNo=$patientNo&visitNo=$visitNo&msg=error" );
}
?>