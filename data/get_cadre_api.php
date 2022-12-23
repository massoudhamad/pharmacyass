<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$cadres = $db->getRows('cadre',array('order_by'=>'cadreID ASC'));
if(!empty($cadres)){
        foreach($cadres as $cadre){
            $output[] = array(
              $cadreID = $cadre['cadreID'],
              $cardename =  $cadre["cardename"],
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>