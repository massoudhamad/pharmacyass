<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();
$shehiaID = $_REQUEST['districtID'];

$shehias =  $db->getRows('shehia',array('where'=>array('districtID'=>$shehiaID),'order_by'=>'shehiaName ASC'));
if(!empty($shehias)){
        foreach($shehias as $shehia){
            $output[] = array(
              $shehiaID =  $shehia["shehiaID"],
              $shehiaCode =  $shehia["shehiaCode"],
              $shehiaName =  $shehia["shehiaName"],
              $districtID =  $shehia["districtID"],
              //$wardShortCode = $ward['wardShortCode'],
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>