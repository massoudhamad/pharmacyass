<?php
 ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
    include 'DB.php';
    $db = new DBHelper();
    $patientNo = $_REQUEST['patientNo'];
    $visitNo = $_REQUEST['visitNo'];
    $userID =  $_REQUEST['userID'];
    $userData = array(
        'checkin'=>1,

    );
    $doctotData = array(
        'userID'=> $userID,

    );
    $statusData = array(
        'progressStatus'=> 1,

    );
    $condition = array( 'patientNo'=>$patientNo, 'visitNo'=>$visitNo );
    $update = $db->update( 'patientvisit', $userData, $condition );
    $update = $db->update( 'patient_service', $doctotData, $condition );
    $updateprogress = $db->update( 'patienttest', $statusData, $condition );
    $boolStatus = true;

    header( "Location:index3.php?sp=radiologyView&patientNo=$patientNo&visitNo=$visitNo&msg = succ" );
    //header( 'Location:index3.php?sp=consultation&patientNo=$patientNo&visitNo=$visitNo' );

} catch ( PDOException $ex ) {
    //header( 'Location:index3.php?sp=serviceOffered&msg=error' );
    echo $ex;
}
?>