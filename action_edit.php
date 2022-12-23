<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
//try {
include 'DB.php';
$db = new DBHelper();
$tblName='patient';
// if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'Update'){
        $patientNo=$_POST['patientNo'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender=$_POST['gender'];
        $dob=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
        $idType=$_POST['idType'];
        $idnumber=$_POST['idnumber'];
        $address=$_POST['address'];
        $relation = $_POST['relation'];
        $phoneNumber=$_POST['phoneNumber'];
        $phoneKin = $_POST['phoneKin'];
        $shehiaID=$_POST['shehiaCode'];
        $kname = $_POST['nextOfKin'];
        $paymenttypeCode=$_POST['paymenttypeCode'];
        //$insurerID = $_POST['insurerID'];
        $bloodGroup = $_POST['bloodGroup'];

        // $healthSchemeID=$_POST['schemeID'];
        
       
        
     //add users first
        $userData = array(
            'patientNo'=>$patientNo,
            'firstName'=>ucfirst($fname),
            'middleName'=>ucfirst($mname),
            'lastName'=>ucfirst($lname),
            'dob'=>$dob,
            'sex'=>$gender,
            'IDNo'=>$idnumber,
            'IDType'=>$idType,
            'address'=>ucfirst($address),
            'telNumber'=>$phoneNumber,
            'phoneKin'=>$phoneKin,
            'shehiaCode'=>$shehiaID,
            'relation' =>$relation,
            'nextOfKin'=>ucfirst($kname),
            'bloodGroup'=>$bloodGroup,
            'paymenttypeCode'=>$paymenttypeCode,
            //'insurerID'=>$insurerID,

        );
                $condition=array("patientNo"=>$patientNo);
                $update =$db->update($tblName,$userData,$condition);
                $boolStatus=true;
                header("Location:index3.php?sp=viewAllPatient&patientNo=$patientNo&msg=succ");
        
        
    }
    //}
// } 
// catch (PDOException $ex) {
//    // header("Location:index3.php?sp=patient&msg=error");
// }
?>