<?php
session_start();

ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
    $userID=$_SESSION['user_session'];
    $hospitalCode=$_SESSION['hospitalCode'];
    include 'DB.php';
    $db = new DBHelper();
    $patientNo=$_POST['patientNo'];
    if($patientNo){

 //if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type']))
    //{
        $patientNo=$_POST['patientNo'];
        //echo $healthSchemePaymentID;
        $healthSchemePaymentID=$_POST['healthSchemePaymentID'];
        $triage=$_POST['triage'];
        $visitDay=date('d-m');
        $today=date('Y-m-d');
        $id=$_POST['id'];
        $Type='Appoinment';
      
                //visit and triage
                $visitDate=date('Y-m-d');
                $visitDay=date('d');
                $getVisitStatus=$db->getRows("patientvisit",array('where'=>array('patientNo'=>$patientNo,'visitStatus'=>0)));
                if(empty($getVisitStatus)) {
                    $visitNo=$hospitalCode.$visitDay.rand(100,999);
                    $userData=array(
                        'visitNo'=>$visitNo,
                        'visitDate'=>$visitDate,
                        'patientNo'=>$patientNo,
                        'visitStatus'=>0,
                        'hospitalCode'=>$hospitalCode,
                        'visitType'=>$Type,
                        
                       
                     );
                        
                    $insert = $db->insert("patientvisit", $userData);
                    $status=true;
                         //echo 'tayar';
                    echo'The Patient Has Been Added In Todays Visit';
                   // header("Location:index3.php?sp=addvisit&patientNo=$patientNo&visitNo=$visitNo&msg=succ"); 
                    
                   
              
            }
        }
    } catch (PDOException $ex) {
        //echo 'tayar';
        $db->redirect("index3.php?sp=patientNo&patientNo=$patientNo&msg=error");
   

    }
    