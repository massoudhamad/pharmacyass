<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
    include 'DB.php';
    $db = new DBHelper();
    $patients = $db->getRows('patient', array('order_by' => 'patientNo ASC'));
    //print_r($patients);

    $URL =  'http://localhost/gvt-ehr-main/data/get_patients.php';
    //$URL =  'http://localhost/gvt-ehr-main/data/get_patients.php';
    $main_patients = $db->getAPI($URL);
    $json = json_decode($main_patients,$array = TRUE);
    print_r($json);
    //$admin_patients = json_decode($main_patients);
    $result = array_diff_assoc($patients,$main_patients);
    

              
} catch (PDOException $ex) {
    //header("Location:index3.php?sp=Check-updates&msg=error");
    echo $ex;
   }
?>




