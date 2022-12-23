<?php
 require_once("DB.php");
 $db=new DBhelper();
 //echo patients;
 //if(isset($_POST['searchQuery'])){
 $search_text = $_POST['query'];
 $patients = $db-> searchPatientAutocomplete($search_text);
 echo json_encode($patients);
 ?>