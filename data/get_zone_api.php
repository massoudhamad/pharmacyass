<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$wards = $db->getRows('zone',array('order_by'=>'zoneID ASC'));
if(!empty($wards)){
        foreach($wards as $ward){
            $output[] = array(
              $zoneID = $ward['zoneID'],
              $zoneCode =  $ward["zoneCode"],
              $zoneName =  $ward["zoneName"],
             
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>