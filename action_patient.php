<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$tblName='patient';
$hospitalCode = $_SESSION['hospitalCode'];
if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add'){
        $patientNumber=$_POST['patientNumber'];
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
        //$shehiaID=$_POST['shehiaID'];
        $kname = $_POST['kfname']." ".$_POST['kmname']." ".$_POST['klname'];
        //$insurerID = $_POST['insurerID'];
        $bloodGroup = $_POST['bloodGroup'];
        // $membershipNumber=$_POST['membershipNumber'];
        // $cardHolderName=ucfirst($_POST['cardHolderName']);
        // $cardHolderNumber=$_POST['cardHolderNumber'];

        $allergy=$_POST['allegy'];
        $reactionLevel=$_POST['reactionLevel'];
        $reaction=$_POST['reaction'];
        //$member=$_POST['member'];
        // $cardName=ucfirst($_POST['cardName']);
        // $cardNumber=$_POST['cardNumber'];
        $healthSchemeID=$_POST['paymenttypeCode'];

        $age=$_POST['age'];

        if(empty($_POST['year']))
            $dob=$db->reverse_birthday($age);
        else
            $dob=$dob;

     //add users first
     $userData = array(
        'patientNo'=>$patientNumber,
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
        //'shehiaCode'=>$shehiaID,
        'relation' =>$relation,
        'nextOfKin'=>ucfirst($kname),
        'bloodGroup'=>$bloodGroup,
        'paymenttypeCode'=>$healthSchemeID,
        'hospitalCode'=>$hospitalCode

    );
    $insert = $db->insert($tblName,$userData);
        $userData = array(
            

            'patientNo'=>$patientNumber,
            'allergyID'=>$allergy,
            'allergy_reactionID'=>$reaction,
            'allergy_reactionLevel'=>$reactionLevel,
        );
        $insert = $db->insert("patient_allergy",$userData);

        $boolStatus=true;
        $_SESSION['msg'] = "User Registered Successfully";
        header("Location:index3.php?sp=govisit&patientNo=$patientNumber&msg=succ"); 
    }
        
    }

        
}
 
catch (PDOException $ex) {
   $_SESSION['error'] = "Something Wrong Registration Failed";
   header("Location:index3.php?sp=patient&msg=error");
   echo $ex;
}