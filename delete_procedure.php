<?php
 ini_set ('display_errors', 1);
 error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
        $patientNo=$_REQUEST['patientNo'];
        $visitNo = $_REQUEST['visitNo'];
        $patientProcedureID = $_REQUEST['patientProcedureID'];


        $condition = array("patientProcedureID"=>$patientProcedureID,"visitNo"=>$visitNo);
        $delete=$db->delete("patientprocedure",$condition);
        header("Location:index3.php?sp=orderProcedure&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
       
    }
    catch (PDOException $ex) {
        //header("Location:index3.php&msg=error");
        ECHO $ex;
    }   
?>