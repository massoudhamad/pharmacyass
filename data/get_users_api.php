<?php 
header('Content-Type: application/json');
include("../DB.php");
$db=new DBHelper();
$output = array();

$users = $db->getRows('users',array('order_by'=>'userID ASC'));
if(!empty($users)){
        foreach($users as $user){
            $output[] = array(
              $userID =  $user["userID"],
              $username =  $user["userName"],
              $firstname = $user['firstName'],
              $middlename = $user['middleName'],
              $lastname = $user['lastName'],
               
            );
    }   
}
echo json_encode($output);
http_response_code(200);
?>