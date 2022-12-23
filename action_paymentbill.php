<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$patientNo =$_REQUEST['patientNo'];
$visitNo = $_REQUEST['visitNo'];
$patientServiceID = $_REQUEST['patientServiceID'];

if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add')
    {
        $userData = array(
            'total'=>$_POST['num1'],
            'discount'=>$_POST['num2'],
            'amount'=>$_POST['subt'],
            'patientServiceID'=>$_POST['patientServiceID'],
            
        );
        $condition= array(
            'patientServiceID'=> $_POST['patientServiceID'],
        );
        if( $db->isFieldExistMult("patient_payment", array('patientServiceID'=> $_POST['patientServiceID'])) ){

            $update = $db->update("patient_payment",$userData,$condition);
            $boolStatus=true;
            header("Location:index3.php?&msg=succ");
        }else{
            $insert = $db->insert("patient_payment",$userData);
            $boolStatus=true;
            header("Location:index3.php?&msg=succ");
        }

        $patientNo =$_REQUEST['patientNo'];
        $visitNo = $_REQUEST['visitNo'];
        $Data = array(
            'saleStatus'=>1,
        );
        $condition = array("patientNo"=>$patientNo,'visitNo'=>$visitNo);
        $update=$db->update("patient_service",$Data,$condition);
        header("Location:index3.php?&msg=succ");

       
        
    }
    // else if($_REQUEST['action_type'] == 'addcategoryservice')
    // {
    //     $userData = array(
    //         'serviceName'=>$_POST['name'],
    //         'cash'=>$_POST['cash'],
    //         'credits'=>$_POST['credits'],
    //         'insurance'=>$_POST['insurance'],
    //         'costsharing'=>$_POST['costsharing'],
    //         'fasttrack'=>$_POST['fasttrack'],
    //         'subCategoryID'=>$_POST['subCategoryID']
    //     );
    //     $insert = $db->insert("service",$userData);
    //     $boolStatus=true;
        
    //     header("Location:index3.php?sp=managetest#health&msg=succ");
   
   
}

} catch (PDOException $ex) {
        //header("Location:index3.php?sp=patient&msg=error");
 }
?>