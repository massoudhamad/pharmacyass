<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$paymentTypeCode = $_REQUEST['paymentTypeCode'];
        $userData = array(
            'isAvailable'=>0,
            
        );
        $condition=array("paymentTypeCode"=>$paymentTypeCode);
        $update = $db->update("available_payment_types",$userData,$condition);
        $boolStatus=true;
        
        header("Location:index3.php?sp=paymenttypes");
 

} catch (PDOException $ex) {
        //header("Location:index3.php?sp=paymenttypes&msg=error");
        echo $ex;
 }
?>