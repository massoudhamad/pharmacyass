<?php
 require_once("DB.php");
 $db=new DBhelper();
 $employeeId=$_POST['employeeId'];
$date=$_POST['date'];
$time=$_POST['time'];
 //echo patients;
 //if(isset($_POST['searchQuery'])){
 
$aptTime = $db->getAppTime($employeeId,$date,$time);
 echo json_encode($aptTime);
 ?>