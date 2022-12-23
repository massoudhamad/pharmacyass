<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$regionID = $_REQUEST['regionCode'];
$output = array();
$districts= $db->getRows('district',array('where'=>array('regionCode'=>$regionID),'order_by'=>'districtName ASC'));
if(!empty($districts)){
        foreach($districts as $district){
            $output[] = array(
              $districtID =  $district["districtID"],
              $districtCode =  $district["districtCode"],
              $districtName = $district['districtName'],
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>