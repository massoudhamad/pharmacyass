<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$users = $db->getRows('hospitallevel',array('order_by'=>'hospitalLevelID ASC'));
if(!empty($users)){
        foreach($users as $user){
            $output[] = array(
              $hospitalLevelID =  $user["hospitalLevelID"],
              $hospitalLevelName =  $user["hospitalLevelName"],
              $hospitalLevelCode = $user['hospitalLevelCode'],
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>