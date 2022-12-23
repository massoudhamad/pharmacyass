<?php
//session_start();
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
include_once "DB.php";
$db = new DBHelper();
$hospitals= $db->getRows('hospital',array('order_by'=>'hospitalID ASC'));
if(!empty($hospitals)){
foreach($hospitals as $hospitals){
        $email = $hospitals['email'];
        $hospital_name = $db->decrypt($hospitals['hospitalName']);
        $hospital_code = $hospitals['hospitalCode'];
        $profile=$hospitals['hospital_logo'];
        $firstname=$hospitals['firstname'];
        $middlename=$hospitals['middlename'];
        $lastname=$hospitals['lastname'];
        $phone=$hospitals['telephoneNumber'];
    }   
}


if($_REQUEST['action']=="getPDF")
{
   
    require('fpdf/fpdf.php');
   

    class PDF extends FPDF{
    
//Page header

        function Banner($patientNo,$hospital_name){

 
            $this->setFont('Arial', 'B', 17);
            $this->Cell(0,10,$hospital_name,0,0,'C');
            $this->Ln(13);

            $this->setFont('Arial', '', 10);
            $this->Cell(0,0,"PATIENT PRESCRIPTION",0,100,'C');
            $this->Ln(7);
           
        }

        function SetCol($col)
        {
            
        }

//Page footer
        // function Footer(){
        //     include_once "DB.php";
        //     $db = new DBHelper();
        //     $hospitals= $db->getRows('hospital',array('order_by'=>'hospitalID ASC'));
        //     if(!empty($hospitals)){
        //     foreach($hospitals as $hospitals){
        //             $email = $hospitals['email'];
        //             $hospital_name = $db->decrypt($hospitals['hospitalName']);
        //             $hospital_code = $hospitals['hospitalCode'];
        //             $profile=$hospitals['hospital_logo'];
        //             $firstname=$hospitals['firstname'];
        //             $middlename=$hospitals['middlename'];
        //             $lastname=$hospitals['lastname'];
        //             $phone=$hospitals['telephoneNumber'];
        //     }   
        // }
        //     $today2=date('Y-m-d H:i:s');
        //     $this->SetY(-15);
        //     $this->SetFont('Arial','I',8);
        //     $this->Cell(0,0,$hospital_name." ".'Tel:'." ".$phone." ".'Email:'." ".$email,0,1,'C');
        // }

        function BasicTable($header)
        {
            // Header
            $w = array(30,110,15,15,15);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],6,$header[$i],1,0,'L');

            $this->Ln();
            // Color and font restoration
        }
    }
    // Set text color to blue.

    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage("P","A5");

$patientNo=$_REQUEST['patientNo'];
$visitNo=$_REQUEST['visitNo'];
$patientvisit=$db->getRows('patientvisit',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo),'order_by'=>'patientNo DESC'));
if(!empty($patientvisit)) {
    $x = 0;
    foreach ($patientvisit as $pvisits) {
        $x++;
        $patientNo = $pvisits['patientNo'];
        $visitDate = $pvisits['visitDate'];

        $patients = $db->getRows('patient', array('where' => array('patientNo' => $patientNo), 'order_by' => 'patientNo DESC'));
        if (!empty($patients)) {
            foreach ($patients as $patient) {
                $fname = $patient['firstName'];
                $mname = $patient['middleName'];
                $lname = $patient['lastName'];
                $dob = $patient['dob'];
                $sex = $patient['sex'];
                $address = $patient['address'];
                $telNumber = $patient['telNumber'];
                $healthSchemeID = $patient['paymenttypeCode'];
                $healthScheme = $db->getData("healthscheme", "healthScheme", "healthSchemeID", $healthSchemeID);
                $name = "$fname $mname $lname";

                $age=$db->ageCalculator($dob);
            }
        }
        if($sex == 'F'){
            $sex = 'Female';
        }else{
            $sex = 'Male';
        }
        $healthScheme = $db->getData("paymenttype", "paymentTypeName", "paymentTypeCode", $healthSchemeID);

    }

}

    $pdf->Banner($patientNo,$hospital_name);

    
    $today=date('d-m-Y H:i');
    $pdf->setFont('Arial', 'B', 11);
    

    $pdf->setFont('Arial', '', 10);
    $pdf->Cell(0,6,$name.", ".$sex.", ".$age." ",0,0,'C');
    $pdf->Ln(7);
    $pdf->SetTextColor(255,255,255);
    $medications = $db->getRows('patient_medication', array('where' => array('patientNo' => $patientNo,'visitNo' => $visitNo)));
        if (!empty($medications)) {
            foreach ($medications as $medicine) {
                $drug = $medicine['drugID'];
                $userID = $medicine['userID'];
                $dispensing_status = $medicine['dispensing_status'];
            }
        }
    $getUser = $db->getRows('users', array('where' => array('userID' => $userID)));
    if (!empty($getUser)) {
            foreach ($getUser as $user) {
                $firstname = $user['firstName'];
                $midlename = $user['middleName'];
                $doctor = $midlename[0];
                $lastname = $user['lastName'];
                $doctor_name = $firstname." ".$doctor." ".$lastname;
                $userID = $medicine['createdBy'];
                $dispensing_status = $medicine['dispensing_status'];
            }
        }


    $pdf->Cell(0,6,"Consultant: "."Dr."." ".$doctor_name.". "."Consultation Date:"." ".date('d-m-Y'),0,0,'C',TRUE);
    $pdf->Ln(13);
    

    $pdf->setFont('Arial', 'B', 11);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(10,6,"Diagnosis:",0,0,'L',);

     $patientdiagnosis = $db->getRows('patientdiagnosis', array('where' => array('patientNo' => $patientNo,'visitNo' => $visitNo)));
        if (!empty($patientdiagnosis)) {
            foreach ($patientdiagnosis as $diagnosis) {
                $icdcode = $diagnosis['icdcode'];
                $diseasename = $db->getData("icdcode", "icdName", "icdCode", $icdcode);
                $pdf->setFont('Arial', '', 11);
                $pdf->Cell(20);
                $pdf->Cell(40,6,$diseasename ,0,0,);
                $pdf->Ln();
                $pdf->Cell(10);

            }
        }else{
            $pdf->setFont('Arial', '', 11);
            $pdf->Cell(50);
            $pdf->Cell(50,6,"No Dignosis Recorded" ,0,0,);

        }
    
    // $pdf->Line(10, 60, 135, 60); // 20mm from each edge
    $pdf->Ln(10);

     $pdf->setFont('Arial', 'B', 11);
    $pdf->Cell(10,6,"Medications:",0,0,'L',);
    $pdf->Ln(10);
    $pdf->setFont('Arial', '', 10);
     $medications = $db->getRows('patient_medication', array('where' => array('patientNo' => $patientNo,'visitNo' => $visitNo)));
        if (!empty($medications)) {
            foreach ($medications as $medicine) {
                $drug = $medicine['drugID'];
                $dose = $medicine['dose'];
                $dispensing_status = $medicine['dispensing_status'];
                $drugname = $db->getData("drugs", "drugName", "drugID", $drug);
                $pdf->Cell(10);
                $pdf->Cell(0,5,$drugname,0,0,'L');
                $pdf->Ln(4);
                $pdf->Cell(10);
                $pdf->Cell(0,5,$dose,0,0,'L',);
                $pdf->SetX(10);
                $image1 = "checks.png";
                $image2 = "wrong_mark.png";
                if($dispensing_status ==1){
                $pdf->Cell( 0, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 3.78), 10, 10, 'L', false );
                }else{
                $pdf->Cell( 0, 0, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 3.78), 10, 10, 'R', false );
                }
                $pdf->Ln(7);               
                   
            }
        }

        $filename = $fname."_".$lname.".pdf";
        $pdf->Output($filename,'I');
}
?>