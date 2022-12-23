<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$departments = $db->getRows('department',array('order_by'=>'deptID ASC'));
if(!empty($departments)){
        foreach($departments as $department){
            $output[] = array(
              $deptID = $department['deptID'],
              $deptname =  $department["deptname"],
              $category =  $department["category"],
             
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>