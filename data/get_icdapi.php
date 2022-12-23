<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$drug = $db->getRows('icdcode',array('order_by'=>'icdID ASC'));
if(!empty($drug)){
        foreach($drug as $dru){
            $output[] = array(
              $icdCode =  $dru["icdCode"],
              $icdName = $dru['icdName'],
               
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>