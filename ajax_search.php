
<?php
 require_once("DB.php");
 $db=new DBhelper();
 if(isset($_POST['query'])){
 $search_text = $_POST['query'];
 $patients = $db->searchPatientAutocomplete($search_text);
 $patients = json_encode( $patients );
 }
 ?>

