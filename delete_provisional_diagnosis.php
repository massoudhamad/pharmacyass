<?php
//  ini_set ('display_errors', 1);
//  error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
        $patientNo=$_REQUEST['patientNo'];
        $visitNo = $_REQUEST['visitNo'];
        $icdcode = $_REQUEST['icdcode'];


        $condition = array("icdcode"=>$icdcode,"visitNo"=>$visitNo);
        $delete=$db->delete("patientdiagnosis",$condition);
        header("Location:index3.php?sp=consultation&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
       
    }
    catch (PDOException $ex) {
        header("Location:index3.php?sp=consultation&patientNo=$patientNo&visitNo=$visitNo&msg=error");
    }   
?>