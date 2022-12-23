<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$healthSchemes = $db->getRows('healthscheme',array('order_by'=>'healthSchemeID ASC'));
if(!empty($healthSchemes)){
        foreach($healthSchemes as $healthScheme){
            $output[] = array(
              $healthSchemeID = $healthScheme['healthSchemeID'],
              $healthScheme =  $healthScheme["healthScheme"],
             
             
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>