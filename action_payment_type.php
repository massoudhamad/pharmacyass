<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
include 'DB.php';
$db=new DBHelper();
$payment=$_POST['paymentTypeCode'];
try {
    if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
     if(isset($_POST['action_type']) == 'add')
    { 
              
            
            foreach( $payment as $key=>$value)
            {
               $paymentTypeCode=$_POST['paymentTypeCode'][$key];               
                $servicesData=array(
                    'paymenttypeCode'=>$paymentTypeCode,
                    'isAvailable'=>1
                    
                );
                $insert = $db->insert("available_payment_types",$servicesData);
                $status=true;
               
            }
        }
       
        {
           header("Location:index3.php?sp=available_payment_types&msg=succ");
        }
    }
} catch (PDOException $ex) {
   Header("Location:index3.php?sp=paymenttypes&msg=error");
   //echo $ex;
}