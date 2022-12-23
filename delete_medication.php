<?php
 ini_set ('display_errors', 1);
 error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
        $patientNo=$_REQUEST['patientNo'];
        $visitNo = $_REQUEST['visitNo'];
        $drugID = $_REQUEST['drugID'];


        $condition = array("drugID"=>$drugID,"visitNo"=>$visitNo);
        $delete=$db->delete("patient_medication",$condition);
        header("Location:index3.php?sp=medication&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
       
    }
    catch (PDOException $ex) {
        //header("Location:index3.php&msg=error");
        ECHO $ex;
    }   
?>