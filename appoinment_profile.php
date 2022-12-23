<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/hospital-patient-profile.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

<?php
$db = new DBHelper();
$patientNo=$db->my_simple_crypt($_GET['id'],'d');
$patients = $db->getPatientAppointmentInfo($patientNo);
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
        $Dname=$patient['firstname'];
        $Dname=$patient['middlename'];
        // $Dname=$patient['lastname'];
        $DocName = $patient['firstname']." ".$patient['middlename'];
        $dob=$patient['dob'];
        $aptDate=$patient['aptDate'];
        // $sex=$patient['sex'];
        $address=$patient['address'];
        $phone=$patient['tell'];
        $time=$patient['time'];
        $healthSchemeID=$patient['paymenttypeCode'];
        // $clininCode = $patient['clininName'];
        $employeeId=$patient['employeeId'];
        $bloodGroup=$patient['bloodGroup'];
       // $company=$patient['insurerType'];
       $clinicName=$db->getData('clinic','clinicName','clinicCode',$patient['clinicCode']);
        $healthScheme=$db->getData('paymenttype','paymentTypeName','paymentTypeCode',$patient['paymenttypeCode']);
    }
}
?>


<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Content-->
  
        <div class="content-wrapper">
        <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-user font-large-2 info"></i>Patient Profile</h2>
                    </div>
                </div>
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">  
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="patient-profile">
                    <div class="row match-height">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 d-flex justify-content-around">
                                            <div class="patient-img-name text-center">
                                                <img src="index.png" alt="" class="card-img-top mb-1 patient-img img-fluid rounded-circle">
                                                <h4><?php echo $fname." ".$mname." ".$lname ?></h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 d-flex justify-content-around">
                                            <div class="patient-info">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <div class="patient-info-heading">Patient No:</div><?php echo $patientNo ?>
                                                    </li>
                                                    <li>
                                                        <div class="patient-info-heading">Birth:</div><?php echo $dob ?>
                                                    </li>
                                                    <li>
                                                        <div class="patient-info-heading">Contact:</div><?php echo $phone ?>
                                                    </li>
                                                    <li>
                                                        <div class="patient-info-heading">Address:</div> <?php echo $address ?>
                                                    </li>
                                                    <li><span class="patient-info-heading">Blood Type :</span><?php echo $bloodGroup ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-gradient-y-info">
                                <div class="card-body">
                               
                                    <h5 class=" text-white">Appointment Information</h5>
                               
                                    <ul class="list-unstyled text-white patient-info-card">
                                        <li><span class="patient-info-heading">App Date :</span><?php echo $aptDate?></li>
                                        <li><span class="patient-info-heading">Time :</span><?php echo $time; ?> </li>
                                        <li><span class="patient-info-heading">Doctor :</span><?php echo $DocName; ?></li>
                                        <li><span class="patient-info-heading">Clinic :</span><?php echo $clinicName; ?></li>
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
                                        <li>Scheme :<span class="float-right"><?php echo $healthScheme ?></span></li>
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
                                                    <td class=" border-top-0 align-middle">
                                                        <img src="app-assets/images/portrait/medium/avatar-m-1.png" alt="" class="rounded-circle doctor-img">
                                                    </td>
                                                    <td class="align-middle border-top-0">Dr. Phil Gray</td>
                                                    <td class="align-middle border-top-0">Dentist</td>
                                                    <td class="align-middle border-top-0">
                                                        <i class="la la-phone"></i> 0777 789300
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <i class="la la-calendar-check-o"></i> 15/10/18
                                                    </td>
                                                    
                                                    <td class="align-middle border-top-0">
                                                        <i class="la la-circle text-danger"></i> Hospital Visit
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <div class="action">
                                                            <a href="#"><i class="ft-eye" title="View Details"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">
                                                        <img src="app-assets/images/portrait/medium/avatar-m-2.png" alt="" class="rounded-circle doctor-img">
                                                    </td>
                                                    <td class="align-middle">Dr. Irene Baker</td>
                                                    <td class="align-middle">Dermatologist</td>
                                                    <td class="align-middle">
                                                        <i class="la la-phone"></i> 0795 673456
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <i class="la la-calendar-check-o"></i> 15/10/18
                                                    </td>
                                                    <td class="align-middle">
                                                        <i class="la la-circle text-primary"></i> Medical Consultion
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="action">
                                                        <a href="#"><i class="ft-eye" title="View Details"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="align-middle border-bottom-0">
                                                        <img src="app-assets/images/portrait/medium/avatar-m-10.png" alt="" class="rounded-circle doctor-img">
                                                    </td>
                                                    <td class="align-middle border-bottom-0">Dr. Diane Paige</td>
                                                    <td class="align-middle border-bottom-0">ID Physician</td>
                                                    <td class="align-middle border-bottom-0">
                                                        <i class="la la-phone"></i> 06783 456723
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <i class="la la-calendar-check-o"></i> 15/10/18
                                                    </td>
                                                    <td class="align-middle border-bottom-0">
                                                        <i class="la la-circle text-danger"></i> Hospital Visit
                                                    </td>
                                                    <td class="align-middle border-bottom-0">
                                                        <div class="action">
                                                        <a href="#"><i class="ft-eye" title="View Details"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card pull-up">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-2 text-left">
                                                        <h5 class="mb-0">Blood Pressure</h5>
                                                        <small class="text-light">mmHg</small>
                                                    </div>
                                                    <div class="col-5 ">
                                                        <div>
                                                            <canvas id="patient-blood-pressure" class="height-250"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card pull-up">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-2 text-left">
                                                        <h5 class="mb-0">Weight</h5>
                                                        <small class="text-light">Kg</small>
                                                    </div>
                                                    <div class="col-5 ">
                                                        <div>
                                                            <canvas id="patient-heart-rate" class="height-250"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                       
                         
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
   