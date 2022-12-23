<?php 
session_start();
require_once '../DB.php';
$db=new DBHelper();
$output = array('data' => array());

//
//$patientvisit=$db->getRows('triage',array('order_by'=>'patientNo DESC'));

$patientvisit=$db->getRows('triage',array('where'=>array('triageStatus'=>0,'hospitalCode'=>$_SESSION['hospitalCode']),'order_by'=>'patientNo DESC'));
if(!empty($patientvisit))
{
    $x=0;
    foreach ($patientvisit as $pvisits) 
    {
        $x++;
        $patientNo=$pvisits['patientNo'];
        $visitNo=$pvisits['visitNo'];
        
        $patients = $db->getRows('patient',array('where'=>array('patientNo'=>$patientNo),'order_by'=>'patientNo DESC'));
        if(!empty($patients))
        {
            foreach ($patients as $patient)
            {
                $fname=$patient['firstName'];
                $mname=$patient['middleName'];
                $lname=$patient['lastName'];
                $dob=$patient['dob'];
                $sex=$patient['sex'];
                $address=$patient['address'];
                $telNumber=$patient['telNumber'];
                $name="$fname $mname $lname";
            }
        }
        $visitsButton = '
	<div class="btn-group">
	    <a href="index3.php?sp=gototriage&patientNo='.$patientNo."&visitNo=".$visitNo.'"><span class="glyphicon glyphicon-edit"></span> Triage Info</a>
	</div>';
	$output['data'][] = array(
            $x,
            $patientNo,
            $name,
            $sex,
            $db->ageCalculator($dob),
            $address,
            $telNumber,
	        $visitNo,
            $visitsButton
	);

	//$x++;
}
}

// database connection close
//$db->close();

echo json_encode($output);