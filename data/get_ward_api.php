<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$wards = $db->getRows('ward',array('order_by'=>'wardCode ASC'));
if(!empty($wards)){
        foreach($wards as $ward){
            $output[] = array(
              $wardCode =  $ward["wardCode"],
              $wardName =  $ward["wardName"],
              $wardShortCode = $ward['wardShortCode'],
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>