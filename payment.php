<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
       
        $patientNo=$db->my_simple_crypt($_REQUEST['pno'],'d');   
        $pid=$db->my_simple_crypt($_GET['pid'],'d');
        $visitNo= $_REQUEST['visitNo'];
        $Data = array(
            'saleStatus'=>1,
        );
        $condition = array("patientServiceID"=>$pid);
        $update=$db->update("patient_service",$Data,$condition);
        header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
    }
    catch (PDOException $ex) {
        header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=fail");
    }   
?>