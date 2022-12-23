<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$insurer_company = $db->getRows('insurer_company',array('order_by'=>'insurerID ASC'));
if(!empty($insurer_company)){
        foreach($insurer_company as $insurer){
            $output[] = array(
              $insurerID =  $insurer["insurerID"],
              $insurerTypeID =  $insurer["insurerTypeID"],
              $insurerName = $insurer['insurerName'],
              $insurerAddress = $insurer['insurerAddress'],
              $insurerTelophone = $insurer['insurerTelophone'],
               
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>