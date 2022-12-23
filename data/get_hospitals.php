<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$hospitalLevel = $_REQUEST['hospitalLevelID'];

$output = array();

$hospital = $db->getRows('hospital',array('where'=>array('hospitalLevelID'=>$hospitalLevel),'order_by'=>'hospitalID ASC'));
if(!empty($hospital)){
        foreach($hospital as $hosp){
            $output[] = array(
              $hospitalName =  $hosp["hospitalName"],
              $hospitalCode = $hosp['hospitalCode'],
              $districtID = $hosp['districtID'],
               
            );
    } 
    
}

echo json_encode($output);
http_response_code(200);
?>