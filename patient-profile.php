<?php
$db = new DBHelper();
$patientNo=$db->my_simple_crypt($_GET['id'],'d');
$patients = $db->getPInfo($patientNo);
//$patients = $db->getRows('patient',array('where'=>array('patientNo'=>$patientNo),'order_by'=>'patientNo DESC'));
if(!empty($patients))
{
    $x=0;
    foreach ($patients as $patient)
    {
        $x++;
        $patientNo=$patient['patientNo'];
        $fname=$patient['firstName'];
        $mname=$patient['middleName'];
        $lname=$patient['lastName'];
        $dob=$patient['dob'];
        $sex=$patient['sex'];
        $address=$patient['address'];
        $phone=$patient['telNumber'];
        $bloodGroup=$patient['bloodGroup'];
        $healthSchemeID=$patient['paymenttypeCode'];
        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$healthSchemeID);
        
$visitNoo=$patient['visitNo'];
    }
}
 $hospitals= $auth_user->getRows('hospital',array('order_by'=>'hospitalID ASC'));
if(!empty($hospitals)){
    foreach($hospitals as $hospitals){
            $hospitalCode=$hospitals['hospitalCode'];
             $hospitalName=$db->getData('hospital','hospitalName','hospitalCode',$hospitals['hospitalCode']);
           
    }   
}

$patientslastInfo = $db->getLastInfo($patientNo);
if(!empty($patientslastInfo))
{
    $x=0;
    foreach ($patientslastInfo as $patients)
    {
        $x++;
        $visitDate=$patients['visitDate'];
        // $hospitalCode=$patients['hospitalCode'];
        // $hospital=$db->getData('hospital','hospitalName','hospitalCode',$patients['hospitalCode']);
    }
}
    $allergyID= "- ";
        $allergy_reactionLevel="- ";
        $allergy="- ";
    $patients = $db->getRows('patient_allergy',array('where'=>array('patientNo'=>$patientNo),'order_by'=>'allergyID'));
    if(!empty($patients))
{
    $x=0;
    foreach ($patients as $pat)
    {
        $x++;
        $allergyID=$pat['allergyID'];
        $allergy_reactionLevel=$pat['allergy_reactionLevel'];
        $allergy=$db->getData('allergy','allergyName','allergyID',$pat['allergyID']);
    }
}

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/hospital-patient-profile.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">

    <!-- BEGIN: Content-->

    <div class="content-wrapper">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-user font-large-2 info"></i>Patient Profile</h2>
            </div>
        </div>
        <br>
        <br>
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                </div>
            </div>

            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="index3.php?sp=edit_patient&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>"
                        class="btn btn-info  dropdown-toggle dropdown-menu-right box-shadow-2 px-2"><i
                            class="ft-user icon-left"></i>Update Profile</a>


                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="patient-profile">
                <div class="row match-height">
                    <div class="col-lg-5 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 d-flex justify-content-around">
                                        <div class="patient-img-name text-center">
                                            <img src="img/avatar.png" alt=""
                                                class="card-img-top mb-1 patient-img img-fluid rounded-circle">
                                            <h4><?php echo $fname." ".$mname." ".$lname ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 d-flex justify-content-around">
                                        <div class="patient-info">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <div class="patient-info-heading">Birth:</div><?php echo $dob ?>
                                                </li>
                                                <li>
                                                    <div class="patient-info-heading">Contact:</div><?php echo $phone ?>
                                                </li>
                                                <li>
                                                    <div class="patient-info-heading">Address:</div>
                                                    <?php echo $address ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-">
                        <div class="card bg-gradient-y-info">
                            <div class="card-body">
                                <ul class="list-unstyled text-white patient-info-card">
                                    <li><span class="patient-info-heading">Blood Type:</span><?php echo $bloodGroup ?>
                                    </li>
                                    <li><span class="patient-info-heading">Allergies:</span><?php echo $allergy ?>,
                                        Reaction(<?php echo $allergy_reactionLevel ?>)</li>
                                    <li><span class="patient-info-heading">Last Visit :</span><?php echo $visitDate ?>
                                    </li>
                                    <li><span class="patient-info-heading">Hospital
                                            :</span><?php echo $db->decrypt($hospitalName) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-gradient-y-warning">
                            <div class="card-header">
                                <h5 class="card-title text-white">Insuarance Scheme</h5>
                            </div>
                            <div class="card-content mx-2">
                                <ul class="list-unstyled text-white">
                                    <li>Scheme :<span style="margin-left:20px;"><?php echo $healthScheme ?></span></li>
                                    <!-- <li>Company :<span class="float-right">Dermatologist</span></li> -->

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Medical History</h2>
                                <div class="table-responsive">
                                    <table class="table patient-wrapper">
                                        <tbody>
                                            <tr>

                                                <div class="table-responsive">
                                                    <table id="Historydata" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>VisitNo</th>
                                                                <!-- <th>Hospital</th> -->
                                                                <!-- <th>Clinic</th> -->
                                                                <th>Attending Doc</th>
                                                                <th>View Diagnosis</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                               
                                                $medHistory = $db->getMedicalHistory($patientNo);
                                                if(!empty($medHistory))
                                                    {
                                                        $x=0;
                                                        foreach ($medHistory as $hist)
                                                        {
                                                            $x++;
                                                            $date=$hist['visitDate'];
                                                            $visitNo=$hist['visitNo'];
                                                            // $hospitalCode=$hist['hospitalCode'];
                                                            //$icdcode=$hist['icdcode'];
                                                            $userID=$hist['userID'];
                                                            // $clinicCode=$hist['clinicCode'];
                                                            // $hospital=$db->getData('hospital','hospitalName','hospitalCode',$db->decrypt($hist['hospitalCode']));
                                                            // $clincName=$db->getData('clinic','clinicName','clinicCode',$hist['clinicCode']);
                                                            //$diagnosis=$db->getData('icdcode','icdName','icdcode',$hist['icdcode']);
                                                            $doctor=$db->getData('users','userName','userID',$hist['userID']);
                                                         
                                                            
                                                            
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $x;?></td>
                                                                <td><?php echo $visitNo;?></td>
                                                                <!-- <td><?php echo $hospital;?></td> -->
                                                                <!-- <td><?php echo $clincName;?></td> -->
                                                                <td><?php echo $doctor;?></td>

                                                                <td>
                                                                    <a type="button"
                                                                        title="View and Update Patient Information"
                                                                        class="btn mr-1 mb-1 btn-warning btn-sm"
                                                                        href="index3.php?sp=patient_consultation&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>&visitNo=<?php echo $visitNo?>"><i
                                                                            class="ft-eye"
                                                                            title="View Patient Information"></i></a>

                                                                </td>

                                                            </tr>
                                                            <?php }
                                                    }
                                                ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    </div>

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="app-assets/vendors/js/charts/chartist.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#Historydata").DataTable({
            dom: 'Blfrtip',
            paging: true,
            buttons: [{
                    extend: 'excel',
                    title: 'List of all Appointment',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    }
                }, ,
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Appointment',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    },

                }

            ],
            order: []
        });
    });
    </script>
</body>
<!-- END: Body-->

</html>