<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$serviceID = $_REQUEST['serviceID'];
        $userData = array(
            'isActive'=>0,
            
        );
        $condition=array("serviceID"=>$serviceID);
        $update = $db->update("service",$userData,$condition);
        $boolStatus=true;
        
        header("Location:index3.php?sp=serviceCategory");
 

} catch (PDOException $ex) {
        //header("Location:index3.php?sp=patient&msg=error");
        echo $ex;
 }
?>