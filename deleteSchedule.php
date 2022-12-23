<?php
 ini_set ('display_errors', 1);
 error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
        $date=$_REQUEST['date'];
        $doctor = $_REQUEST['employeeId'];


        $condition = array("date"=>$date,"employeeId"=>$doctor);
        $delete=$db->delete("schedule",$condition);
        header("Location:index3.php?sp=doctorScheduling&msg=succ");
       
    }
    catch (PDOException $ex) {
        header("Location:doctorScheduling&msg=error");
    }   
?>