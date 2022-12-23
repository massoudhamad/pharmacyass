<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$userID = $_REQUEST['userID'];
        $userData = array(
            'login'=>1,
            
        );
        $condition=array("userID"=>$userID);
        $update = $db->update("users",$userData,$condition);
        $boolStatus=true;
        
        header("Location:index3.php?sp=users");
 

} catch (PDOException $ex) {
        header("Location:index3.php?sp=users&msg=error");
        //echo $ex;
 }
?>