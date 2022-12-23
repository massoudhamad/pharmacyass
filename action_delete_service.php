<?php
 ini_set ('display_errors', 1);
 error_reporting (E_ALL | E_STRICT);
 try {
        include("DB.php");
        $db = new DBHelper();
        $visitNo=$db->my_simple_crypt($_REQUEST['vno'],'d'); 
        $patientNo=$db->my_simple_crypt($_REQUEST['pno'],'d');   
        $pid=$db->my_simple_crypt($_GET['pid'],'d');
        $saleStatus=$_REQUEST['saleStatus'];
        //echo $saleStatus;


        if($saleStatus==0){
        $condition = array("patientServiceID"=>$pid,"visitNo"=>$visitNo);
        $update=$db->delete("patient_service",$condition);
        header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
        }else{
            header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=fail");
        }
    }
    catch (PDOException $ex) {
        header("Location:index3.php?sp=addvisit&msg=error");
    }   
?>