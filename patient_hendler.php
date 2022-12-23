<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
$tblName='patient';
if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'add'){
        $patientNumber=$_POST['patientNumber'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender=$_POST['gender'];
        $dob=$_POST['year']."-".$_POST['month']."-".$_POST['date'];;
        $idType=$_POST['idType'];
        $idnumber=$_POST['idnumber'];
        $address=$_POST['address'];
        $phoneNumber=$_POST['phoneNumber'];
        $shehiaID=$_POST['shehiaID'];
        $healthSchemeID=$_POST['schemeID'];
        
        if($healthSchemeID=="others")
            $healthSchemeID=2;
        else
            $healthSchemeID=$healthSchemeID;

        $insurerID=0;
        
            
           /* if(isset($_POST['insurerID']))
            {
                $insurerID=$_POST['insurerID'];
            }
            else
            {
                $insurerID=0;
            }*/
        
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
            'shehiaCode'=>$shehiaID,
            'nextOfKin'=>ucfirst($_POST['nextOfKin']),
            'healthSchemeID'=>$healthSchemeID,
            'insurerID'=>$insurerID,
            'membershipNumber'=>$_POST['membershipNumber'],
            'cardHolderName'=>ucfirst($_POST['cardHolderName']),
            'cardHolderNumber'=>$_POST['cardHolderNumber']
        );
        $insert = $db->insert($tblName,$userData);

        $hospitalCode=$_SESSION['hospitalCode'];
        $visitDate=date('Y-m-d');
        $visitDay=date('d');

        $getVisitStatus=$db->getRows("patientvisit",array('where'=>array('patientNo'=>$patientNo,'visitStatus'=>0)));
        if(empty($getVisitStatus)) {
            $visitNo=$hospitalCode.$visitDay.rand(100,999);
            $userData=array(
                'visitNo'=>$visitNo,
                'visitDate'=>$visitDate,
                'patientNo'=>$patientNumber,
                'visitStatus'=>0,
                'hospitalCode'=>$hospitalCode
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


        $boolStatus=true;

        header("Location:index3.php");
        //header("Location:index3.php?sp=patient&msg=succ");
        
    }
    else if($_REQUEST['action_type'] == 'triage')
    {
        $hospitalCode=$_SESSION['hospitalCode'];
        $patientNo=$_REQUEST['patientNo'];
        $visitDate=date('Y-m-d');
        $visitDay=date('d');
        $visitNo=$hospitalCode.$visitDay.rand(100,999);
        $userData=array(
            'visitNo'=>$visitNo,
            'visitDate'=>$visitDate,
            'patientNo'=>$patientNo,
            'visitStatus'=>1,
            'hospitalCode'=>$hospitalCode
        );
        $insert = $db->insert("patientvisit",$userData);
        
        $triageData=array(
            'patientNo'=>$patientNo,
            'visitNo'=>$visitNo,
            'patientTriageStatus'=>0,
            'hospitalCode'=>$_SESSION['hospitalCode']
        );
        $insert = $db->insert("triage",$triageData);
        
        $boolStatus=true;
        header("Location:index3.php");
    }
    else if($_REQUEST['action_type'] == 'edit')
    {
        $patientNo=$_POST['patientNo'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender=$_POST['gender'];
        $dob=$_POST['year']."-".$_POST['month']."-".$_POST['date'];;
        $idType=$_POST['idType'];
        $idnumber=$_POST['idnumber'];
        $address=$_POST['address'];
        $phoneNumber=$_POST['phoneNumber'];
        $shehiaID=$_POST['shehiaID'];
        $healthSchemeID=$_POST['schemeID'];
        
        if($healthSchemeID=="others")
            $healthSchemeID=2;
        else
            $healthSchemeID=$healthSchemeID;
                
                
                //add users first
                $editData = array(
                    'firstName'=>ucfirst($fname),
                    'middleName'=>ucfirst($mname),
                    'lastName'=>ucfirst($lname),
                    'dob'=>$dob,
                    'sex'=>$gender,
                    'IDNo'=>$idnumber,
                    'IDType'=>$idType,
                    'address'=>ucfirst($address),
                    'telNumber'=>$phoneNumber,
                    'shehiaCode'=>$shehiaID,
                    'nextOfKin'=>ucfirst($_POST['nextOfKin']),
                    'healthSchemeID'=>$healthSchemeID,
                    'insurerID'=>$_POST['insurerID'],
                    'membershipNumber'=>$_POST['membershipNumber'],
                    'cardHolderName'=>ucfirst($_POST['cardHolderName']),
                    'cardHolderNumber'=>$_POST['cardHolderNumber']
                );
                $condition=array("patientNo"=>$patientNo);
                $update = $db->update($tblName,$editData,$condition);
                $boolStatus=true;
                header("Location:index3.php?sp=patient&msg=edit");
    }
    
    /*if($boolStatus)
    {
        
    }
    else
    {
        header("Location:index3.php?sp=patient&msg=unsucc");
    }*/
    
}
} catch (PDOException $ex) {
    header("Location:index3.php?sp=patient&msg=error");
}