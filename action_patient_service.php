<?php
include 'DB.php';
$db=new DBHelper();
session_start();

ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
   

$hospital = $db->getRows('hospital', array('order_by' => 'hospitalID ASC'));
if(!empty($hospital))
{
    
    foreach ($hospital as $hospital)
    {
        
        $hospital_code = $hospital['hospitalCode'];
        
    }
}

    $db = new DBHelper();
    $tblName = 'patienttest';
    $patientNo=$_POST['patientNo'];    
    $healthSchemePaymentIDs=$_POST['available_payment_types'];
    $healthSchemePayment =  explode( ',', $healthSchemePaymentIDs );
    $healthSchemePaymentID = $healthSchemePayment[1];
    $serviceCodee = $healthSchemePayment[0];
    $ageAtVisit=$_POST['ageAtVisit'];
    $serviceCodee=$_POST['serviceCode'];
    $data =  explode( ',', $serviceCodee );
    $categoryCode = $data[0];
    // $paymenttypeCode = $data[1];
    // $patientNo = $data[2];
    $ageAtVisit = $data[3];
    $visitDay=date('d-m');
    $today=date('Y-m-d');
    //$id=$_POST['id'];
    //$onBooking='Consultance';
    $status=false;
    //$hospitalCode=$db->getData("users",'hospitalCode','userID',$userID);

    //check if the payment type is government
    if($healthSchemePaymentID != 'PT001'){
    //{
        //echo $hospitalCode;
        // if($_POST['id'])
        // {
            //visit and triage
            $visitDate=date('Y-m-d');
            $visitDay=date('d');
            $getVisitStatus=$db->getRows("patientvisit",array('where'=>array('patientNo'=>$patientNo,'visitStatus'=>0)));
            if(empty($getVisitStatus)) {
                $visitNo=$hospital_code.$visitDay.rand(100,999);
                if($ageAtVisit <=4){
                    $isUnder = 0; 
                }else{
                    $isUnder = 1;  
                }
                $userData=array(
                    'visitNo'=>$visitNo,
                    'visitDate'=>$visitDate,
                    'patientNo'=>$patientNo,
                    'visitStatus'=>0,
                    'hospitalCode'=>$hospital_code,
                    // 'visitType'=>$Type,
                    //'timein'=>date('i'),
                    'ageAtVisit'=>$ageAtVisit,
                    // 'isUnder'=>$isUnder
                    
                   
                 );
                    
                $insert = $db->insert("patientvisit", $userData);
            }
            else
            {
                foreach($getVisitStatus as $vt)
                {
                    $visitNo=$vt['visitNo'];
                }
            }
             
             
  //echo $categoryCode = $data[0];
             if($categoryCode == 'CAT01'){
               

            if($_POST['triage']=='yes') {
                $triageData = array(
                    'patientNo' => $patientNo,
                    'visitNo' => $visitNo,
                     'triageStatus'=>1, //assign that the patient is passing through triage 
                    'patientTriageStatus' => 0,  //assign that the patient has not been taken vitals signs.after the vital signs the status will change to 1
                   
                    //'hospitalCode' =>['hospitalCode']
                );
                $insert = $db->insert("triage", $triageData);
                
                
            }
            else{
                $triageData = array(
                    'patientNo' => $patientNo,
                    'visitNo' => $visitNo,
                    'triageStatus'=>0,
                    //'hospitalCode' =>['hospitalCode']
                );
                $insert = $db->insert("triage", $triageData);
           
            }

            // if($_POST['doctor'] ==' '){
            //     $UserID = 0;
            // }else{
            //      $userID = $_POST['doctor'];
               // $discount = $_REQUEST['discount'];
            //}
            // foreach($id as $key=>$servicesID)
            // {
                
                
                $healthSchemePaymentID=$_POST['available_payment_types'];
                $datas =  explode( ',', $healthSchemePaymentID );
                $paymenttypeCode = $datas[1];
                $serviceCodeee = $datas[0];
                $price=$db->getServicePrice($paymenttypeCode,$serviceCodeee);
                $servicesData=array(
                    'serviceCode'=> $serviceCodee,
                    'patientNo'=>$patientNo,
                    'visitNo'=>$visitNo,
                    'saleDate'=>$today,
                    'paymenttypeCode'=>$paymenttypeCode,
                    'price'=>$price,
                    // 'userID'=>$UserID
                    
                );
               
                //echo $price;
                // var_dump ($userID);
                    if($db->isFieldExistMult("patient_service", array("serviceCode"=>$servicesID,"patientNo"=>$patientNo,"visitNo"=>$visitNo)) ){

                    header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=error");

                }else{
                $insert = $db->insert("patient_service",$servicesData);
                 //echo $servicesID;
                if($categoryCode == 'Q0FUMDQ=' || $categoryCode =='Q0FUMDM='){
                    
                    foreach($id as $key=>$servicesID){
                     $testNo=$visitDay.rand(100,999);
                    $userData=array(
                    'testNo'=>$testNo,
                    'servicesCode'=>$servicesID,
                    'patientNo'=>$patientNo,
                    'visitNo'=>$visitNo,
                    //'hospitalCode'=>$_SESSION['hospitalCode'],
                    'visitStatus'=>1,
                    'reportingDate'=>$today,
                    'testStatus'=>0
                    
                );
                
                 $insertt = $db->insert("patienttest",$userData);
                  
                    header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succs");
                 
                 
                }
                }else{

                    header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succss");

                }
                 }
                 
               
               
            //}
        }else{
            // foreach($id as $key=>$servicesID)
            // {
                
                
                $healthSchemePaymentID=$_POST['available_payment_types'];
                $datas =  explode( ',', $healthSchemePaymentID );
                $paymenttypeCode = $datas[1];
                $serviceCodeee = $datas[0];
                $price=$db->getServicePrice($paymenttypeCode,$serviceCodeee);
                $servicesData=array(
                    'serviceCode'=> $serviceCodee,
                    'patientNo'=>$patientNo,
                    'visitNo'=>$visitNo,
                    'saleDate'=>$today,
                    'paymenttypeCode'=>$paymenttypeCode,
                    'price'=>$price,
                    // 'userID'=>$UserID
                    
                );
               
                    if($db->isFieldExistMult("patient_service", array("serviceCode"=>$servicesID,"patientNo"=>$patientNo,"visitNo"=>$visitNo)) ){

                    header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=error");

                }else{
                $insert = $db->insert("patient_service",$servicesData);
                if($categoryCode == 'Q0FUMDQ=' || $categoryCode =='Q0FUMDM='){
                    
                    // foreach($id as $key=>$servicesID){
                     $testNo=$visitDay.rand(100,999);
                    $userData=array(
                    'testNo'=>$testNo,
                    'servicesCode'=>$serviceCodee,
                    'patientNo'=>$patientNo,
                    'visitNo'=>$visitNo,
                    //'hospitalCode'=>$_SESSION['hospitalCode'],
                    'visitStatus'=>1,
                    'reportingDate'=>$today,
                    'testStatus'=>0
                    
                );
                
                 $insertt = $db->insert("patienttest",$userData);
                  
                    header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
                 
                 
                //}
                }else{

                    header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succ");

                }
                 }
                 
               
               
            //}
        }
    //}
        
    //}

//if patient uses government payment type
}else{
    date_default_timezone_get();
    $time_in = date('h:i:s');
     //echo $hospitalCode;
    //  if($_POST['id'])
    //  {
         //visit and triage
         $visitDate=date('Y-m-d');
         $visitDay=date('d');
         $getVisitStatus=$db->getRows("patientvisit",array('where'=>array('patientNo'=>$patientNo,'visitStatus'=>0)));
         if(empty($getVisitStatus)) {
             $visitNo=$hospital_code.$visitDay.rand(100,999);
            $_SESSION["VisitNo"] = $visitNo;
             if($ageAtVisit <=4){
                 $isUnder = 0; 
             }else{
                 $isUnder = 1;  
             }
             $userData=array(
                 'visitNo'=>$visitNo,
                 'visitDate'=>$visitDate,
                 'patientNo'=>$patientNo,
                 'visitStatus'=>0,
                 'hospitalCode'=>$hospital_code,
                 // 'visitType'=>$Type,
                 'ageAtVisit'=>$ageAtVisit,
                 //'isUnder'=>$isUnder
                 
                
              );
                  
             $insert = $db->insert("patientvisit", $userData);
         }
         else
         {
             foreach($getVisitStatus as $vt)
             {
                 $visitNo=$vt['visitNo'];
             }
         }
          
          
//echo $categoryCode = $data[0];
          if($categoryCode == 'CAT01'){
            

         if($_POST['triage']=='yes') {
             $triageData = array(
                 'patientNo' => $patientNo,
                 'visitNo' => $visitNo,
                 'triageCurrentStatus' =>0,
                  'triageStatus'=>1, //assign that the patient is passing through triage 
                 'patientTriageStatus' => 0,  //assign that the patient has not been taken vitals signs.after the vital signs the status will change to 1
                
                 //'hospitalCode' =>['hospitalCode']
             );
             $insert = $db->insert("triage", $triageData);
             
             
         }
         else{
             $triageData = array(
                 'patientNo' => $patientNo,
                 'visitNo' => $visitNo,
                 'triageStatus'=>0,
                 //'hospitalCode' =>['hospitalCode']
             );
             $insert = $db->insert("triage", $triageData);
        
         }

         // if($_POST['doctor'] ==' '){
         //     $UserID = 0;
         // }else{
         //      $userID = $_POST['doctor'];
            // $discount = $_REQUEST['discount'];
         //}
        //  foreach($id as $key=>$servicesID)
        //  {
             
             
             $healthSchemePaymentID=$_POST['available_payment_types'];
             $datas =  explode( ',', $healthSchemePaymentID );
             $paymenttypeCode = $datas[1];
             $serviceCodeee = $datas[0];
             $price=$db->getServicePrice($paymenttypeCode,$serviceCodeee);
             $servicesData=array(
                 'serviceCode'=> $serviceCodeee,
                 'patientNo'=>$patientNo,
                 'visitNo'=>$visitNo,
                 'saleDate'=>$today,
                 'paymenttypeCode'=>$paymenttypeCode,
                 'price'=>$price,
                 // 'userID'=>$UserID
                 
             );
            
             //echo $price;
             // var_dump ($userID);
                 if($db->isFieldExistMult("patient_service", array("serviceCode"=>$serviceCodeee,"patientNo"=>$patientNo,"visitNo"=>$visitNo)) ){

                 header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=errors");

             }else{
             $insert = $db->insert("patient_service",$servicesData);
              //echo $servicesID;
             if($categoryCode == 'Q0FUMDQ=' || $categoryCode =='Q0FUMDM='){
                 
                //  foreach($id as $key=>$servicesID){
                  $testNo=$visitDay.rand(100,999);
                 $userData=array(
                 'testNo'=>$testNo,
                 'servicesCode'=>$serviceCodeee,
                 'patientNo'=>$patientNo,
                 'visitNo'=>$visitNo,
                 //'hospitalCode'=>$_SESSION['hospitalCode'],
                 'visitStatus'=>1,
                 'reportingDate'=>$today,
                 'testStatus'=>0
                 
             );
             
              $insertt = $db->insert("patienttest",$userData);
               
                header("Location:index3.php?patientNo=$patientNo&visitNo=$visitNo&msg=succ");
              
              
             //}
             }else{

                header("Location:index3.php?patientNo=$patientNo&visitNo=$visitNo&msg=succ");

             }
              }
              
            
            
         //}
     }else{
        //  foreach($id as $key=>$servicesID)
        //  {
             
             
             $healthSchemePaymentID=$_POST['available_payment_types'];
             $datas =  explode( ',', $healthSchemePaymentID );
             $paymenttypeCode = $datas[1];
              $serviceCodeee = $datas[0];
             $price=$db->getServicePrice($paymenttypeCode,$serviceCodeee);
             $servicesData=array(
                 'serviceCode'=> $serviceCodeee,
                 'patientNo'=>$patientNo,
                 'visitNo'=>$visitNo,
                 'saleDate'=>$today,
                 'paymenttypeCode'=>$paymenttypeCode,
                 'price'=>$price,
                 // 'userID'=>$UserID
                 
             );
            
                 if($db->isFieldExistMult("patient_service", array("serviceCode"=>$serviceCodee,"patientNo"=>$patientNo,"visitNo"=>$visitNo)) ){

                header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=errorss");

             }else{
             $insert = $db->insert("patient_service",$servicesData);
             if($categoryCode == 'Q0FUMDQ=' || $categoryCode =='Q0FUMDM='){
                 
                //  foreach($id as $key=>$servicesID){
                  $testNo=$visitDay.rand(100,999);
                 $userData=array(
                 'testNo'=>$testNo,
                 'servicesCode'=>$serviceCodee,
                 'patientNo'=>$patientNo,
                 'visitNo'=>$visitNo,
                 //'hospitalCode'=>$_SESSION['hospitalCode'],
                 'visitStatus'=>1,
                 'reportingDate'=>$today,
                 'testStatus'=>0
                 
             );
             
              $insertt = $db->insert("patienttest",$userData);
               
                header("Location:index3.php?patientNo=$patientNo&visitNo=$visitNo&msg=succ");
              
              
             //}
             }else{

                header("Location:index3.php?patientNo=$patientNo&visitNo=$visitNo&msg=succ");

             }
              }   
            
         }
     //}
 //}
  
    
}

    
} catch (PDOException $ex) {
    header("Location:index3.php?patientNo=$patientNo&visitNo=$visitNo&msg=error");
   //echo $ex;
}