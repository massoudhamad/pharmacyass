<?php
 ini_set ('display_errors', 1);
 error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
        $patientNo=$_REQUEST['patientNo'];
        $visitNo = $_REQUEST['visitNo'];
        $serviceCode = $_REQUEST['servicesCode'];


        $condition = array("patientNo"=>$patientNo,"visitNo"=>$visitNo,"servicesCode"=>$serviceCode,);
        $delete=$db->delete("patienttest",$condition);
        header("Location:index3.php?sp=ordertest&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
       
    }
    catch (PDOException $ex) {
        //header("Location:index3.php&msg=error");
        ECHO $ex;
    }   
?>