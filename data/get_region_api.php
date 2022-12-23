<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$regions = $db->getRows('region',array('order_by'=>'regionCode ASC'));
if(!empty($regions)){
        foreach($regions as $region){
            $output[] = array(
              $regionCode =  $region["regionCode"],
              $regionName =  $region["regionName"],
              //$wardShortCode = $ward['wardShortCode'],
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>