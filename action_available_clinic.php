<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$clinicCodes=$_POST['clinicCode'];
// print_r($clinicCodes);
if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
        if($_REQUEST['action_type'] == 'addclinic')
             {  
            foreach( $clinicCodes as $key=>$value)
            {
                $clinicCode = $_POST['clinicCode'][$key];
                $deptCode = $_POST['deptCode'][$key];
                $clinicShortCode = $_POST['clinicShortCode'][$key];
                $clinicName = $_POST['clinicName'][$key];
                    
            $userData = array(
                'clinicCode'=>$clinicCode,
                'clinicName'=>$clinicName,
                'deptCode'=>$deptCode,
                'hospitalCode'=>$_SESSION['hospitalCode'],
                'clinicShortCode'=>$clinicShortCode,
   
           );
           if($db->isFieldExistMult('hospital_clinic', array('clinicCode'=>$clinicCode)) ){
            $_SESSION['msg'] = 'Data Already Exist';
            header("Location:index3.php?sp=clinic");

        }else{
           $insert = $db->insert("hospital_clinic",$userData);
            $boolStatus=true;
            $_SESSION['msg'] = 'Data Inserted Successfully';
            header("Location:index3.php?sp=clinic");
           }
        }
    }else{
        $servicesData = array(
            'serviceCode'=>$_POST['serviceCode'],
            'paymenttypeCode'=>$_POST['paymentTypeCode'],
            'actualCost'=>$_POST['cost'],
           );
           $condition = array('costingID'=>$_POST['costingID']);
            $update = $db->update("service_costing",$servicesData,$condition);
            $boolStatus=true;
            header("Location:index3.php?sp=clinic&msg=succ");
           
        }
    }
     } catch (PDOException $ex) {
         $_SESSION['msg'] = 'Something Went Wrong';
        //header("Location:index3.php?sp=clinic");
        echo $ex;
      }