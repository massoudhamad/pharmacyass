<?php
include 'DB.php';
$db = new DBHelper();
$patientNo = $_REQUEST['patientNo'];
$visitNo = $_REQUEST['visitNo'];
$testNo = $_REQUEST['testNo'];
$subscriptions=$db->getRows('patienttest',array('where'=>array('visitNo'=>$visitNo,'patientNo'=>$patientNo,'testNo'=>$testNo),'order_by'=>'testNo DESC'));
print_r($subscriptions);
foreach ($subscriptions as $subscriptions)
{
    $subscri = $subscriptions['fileurl'];
    echo  $file = "profile_img/$subscri";
}
$file =  "profile_img/".$subscri;
header('Content-type: image/png');
readfile($file);
?>
