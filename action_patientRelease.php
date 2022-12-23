<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
try {
    include 'DB.php';
    $db = new DBHelper();
    $tblName = 'patientrelease';
    $patientNo=$_POST['patientNo'];
    $visitNo=$_POST['visitNo'];
    $OPDreleaseStatusID=$_POST['remarks'];
    $hospitalCode=$_POST['hospitalCode'];
    $clinicCode=$_POST['clinicalCode'];
    $wardCode=$_POST['wardCode'];
    $today=date('Y-m-d');
    date_default_timezone_set("Africa/Dar_es_Salaam");
    $time_out = date('H:i:s');
    if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){

    //echo $serviceID;
    if(isset($_POST['action_type']) == 'add'){

        if (isset($_POST['isCkecked'])) {
            //echo 'yes';
                    $userData=array(
                    'patientNo'=>$patientNo,
                    'visitNo'=>$visitNo,
                    'OPDreleaseStatusID'=>$OPDreleaseStatusID,
                    'hospitalCode'=>$hospitalCode,
                    'clinicCode'=>$clinicCode,
                    'wardCode'=>$wardCode,
                    'Admitted'=>'NO'
                );
                $insert=$db->insert($tblName,$userData);
                $patientvisit = $db->getRows('patientvisit',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo)));
                foreach($patientvisit as $patientvisit){

                    $time_in = $patientvisit['createdDate'];

                }
                $tz = new DateTimeZone("Africa/Dar_es_Salaam");
                $date_1 = new DateTime($time_out,$tz);
                $date_2 = new DateTime($time_in,$tz);
                $newtimeused = $date_2->diff($date_1)->format("%h:%i:%s");
                $closeData = array(
                    'doctorServiceStatus'=>3,
                );
                $condition= array('visitNo'=>$visitNo,'patientNo'=>$patientNo);
                $update=$db->update('patient_service',$closeData,$condition);

                $AppData = array(
                    'appStatus'=>1
                );
                $condition= array('aptDate'=>$today,'patientNo'=>$patientNo);
                $update=$db->update('appoitment',$AppData,$condition);

               
                header("Location:index3.php?sp=default&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
                }else{
            //echo 'no';
                    $userData=array(
                    'patientNo'=>$patientNo,
                    'visitNo'=>$visitNo,
                    'OPDreleaseStatusID'=>$OPDreleaseStatusID,
                    'hospitalCode'=>$hospitalCode,
                    'clinicCode'=>$clinicCode,
                    'wardCode'=>$wardCode,
                    'Admitted'=>'NO'
                );
                $insert=$db->insert($tblName,$userData);
                $patientvisit = $db->getRows('patientvisit',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo)));
                foreach($patientvisit as $patientvisit){

                    $time_in = $patientvisit['createdDate'];

                }
                $tz = new DateTimeZone("Africa/Dar_es_Salaam");
                $date_1 = new DateTime($time_out,$tz);
                $date_2 = new DateTime($time_in,$tz);
                $newtimeused = $date_2->diff($date_1)->format("%h:%i:%s");
                $closeData = array(
                    'visitStatus'=>1,
                    'timeused'=>$newtimeused
                );
                $condition= array('visitNo'=>$visitNo,'patientNo'=>$patientNo);
                $update=$db->update('patientvisit',$closeData,$condition);

                $AppData = array(
                    'appStatus'=>1
                );
                $condition= array('aptDate'=>$today,'patientNo'=>$patientNo);
                $update=$db->update('appoitment',$AppData,$condition);

               
                header("Location:index3.php?sp=default&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
                }
            }
        



    
      
            //     $userData=array(
                   

            //         'patientNo'=>$patientNo,
            //         'visitNo'=>$visitNo,
            //         'OPDreleaseStatusID'=>$OPDreleaseStatusID,
            //         'hospitalCode'=>$hospitalCode,
            //         'clinicCode'=>$clinicCode,
            //         'wardCode'=>$wardCode,
            //         'Admitted'=>'NO'
            //     );
            //     $insert=$db->insert($tblName,$userData);
            //     $patientvisit = $db->getRows('patientvisit',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo)));
            //     foreach($patientvisit as $patientvisit){

            //         $time_in = $patientvisit['createdDate'];

            //     }
            //     $tz = new DateTimeZone("Africa/Dar_es_Salaam");
            //     $date_1 = new DateTime($time_out,$tz);
            //     $date_2 = new DateTime($time_in,$tz);
            //     $newtimeused = $date_2->diff($date_1)->format("%h:%i:%s");
            //     $closeData = array(
            //         'visitStatus'=>1,
            //         'timeused'=>$newtimeused
            //     );
            //     $condition= array('visitNo'=>$visitNo,'patientNo'=>$patientNo);
            //     $update=$db->update('patientvisit',$closeData,$condition);

            //     $AppData = array(
            //         'appStatus'=>1
            //     );
            //     $condition= array('aptDate'=>$today,'patientNo'=>$patientNo);
            //     $update=$db->update('appoitment',$AppData,$condition);

               
            //     header("Location:index3.php?sp=default&patientNo=$patientNo&visitNo=$visitNo&msg=succ");
            //     }
            // }

  

            }
            


        
    
            }catch (PDOException $ex) {
   Header("index3.php?patientNo=$patientNo&visitNo=$visitNo&msg=error");
    //echo $ex;
}