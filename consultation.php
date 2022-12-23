<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
#endconsultation label.error {
    color: red;
    font-weight: bold;
}

.alertify-notifier .ajs-message.ajs-error {
    color: white;
}

.alertify-notifier .ajs-message.ajs-success {
    color: white;
}
</style>
</script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>

<?php 

session_start();
if($_SESSION['msg_clinicalHistory']){?>
<script>
alertify.set('notifier', 'position', 'bottom-right');
alertify.success("Clinical History Added Successfully");
</script>
<?php
}elseif($_SESSION['error']){?>
<script>
alertify.set('notifier', 'position', 'bottom-right');
alertify.error("Something Went Wrong");
</script>
<?php
}
unset($_SESSION['msg_clinicalHistory']);
unset($_SESSION['error']);
?>

<?php
$db = new DBHelper();
$patientNo = $_REQUEST['patientNo'];
$visitNo = $_REQUEST['visitNo'];


$userID = $_SESSION['user_session'];
$today = date("Y-m-d");
//print_r($_SESSION['role_session']);
$userRoles = $auth_user->getRows("user_roles", array('where' => array('userID' => $userID,'isPrimary'=>1)));
    //print_r($userRoles);

    if (!empty($userRoles)) {
        foreach ($userRoles as $role) {
            $roleCode = $role['roleCode'];
            $roleName = $role['roleName'];
            $role_arr[]=$roleCode;
        }
    }




$patients = $db->getDoctorInfon( $patientNo );
if ( !empty( $patients ) ) {
    $x = 0;
    foreach ( $patients as $patient ) {
        $x++;
        //$patientNo = $patient['patientNo'];
        $fname = $patient['firstName'];
        $mname = $patient['middleName'];
        $lname = $patient['lastName'];
        $dob = $patient['dob'];
        $sex = $patient['sex'];
        $address = $patient['address'];
        $phone = $patient['telNumber'];
        $bloodGroup = $patient['bloodGroup'];

        $triageTime = $patient['triageTime'];
        $hrTest = $patient['hrTest'];
        $rrTest = $patient['rrTest'];
        $temperature = $patient['temperature'];
        $oxgenSats = $patient['oxgenSats'];
        $weight = $patient['weight'];
        $bpTest = $patient['bpTest'];
        $oxgenSats = $patient['oxgenSats'];
        $weight = $patient['weight'];
        $date = $patient['modifiedDate'];
        $age = $db->ageCalculator( $dob );
        $name = $fname.' '.$mname.' '.$lname;
        // $company = $patient['insurerType'];
        $healthSchemeID = $patient['paymenttypeCode'];
        $healthScheme = $db->getData( 'paymenttype', 'paymentTypeName', 'paymenttypeCode', $healthSchemeID );
    }
}
$allergy = $db->getRows( 'patient_allergy', array( 'where'=>array( 'patientNo'=>$patientNo ) ) );
if ( !empty( $allergy ) ) {
    $x = 0;
    foreach ( $allergy as $t ) {
        $allergyID = $t['allergyID'];
        $allergy = $db->getData( 'allergy', 'allergyName', 'allergyID', $t['allergyID'] );

    }
}

?>

<style>
.feed {
    padding: 5px 0
}
</style>

<!-- END: Head-->

<!-- BEGIN: Body-->

<!-- BEGIN: Content-->

<div class='content-wrapper'>
    <div class='content-header'>
        <div class='card-header'>
            <h2> <i class='la la-stethoscope font-large-2 warning'></i>Consultation</h2>
        </div>
    </div>
    <div class='content-header row mb-1'>
        <div class='content-header-left col-md-6 col-12 mb-2'>
            <div class='row breadcrumbs-top'>
            </div>
        </div>

    </div>
    <div class='content-body'>
        <div class='card'>
        </div>
        <section id='patient-profile'>
            <div class='row match-height'>
                <div class='col-md-4 col-sm-12'>
                    <div class='card'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12'>
                                    <div class='patient-img-name text-left'>
                                        <!-- <img src='app-assets/images/portrait/medium/images.png' alt=''
                                            class='card-img-top mb-1 patient-img img-fluid rounded-circle'> -->
                                        <i class="ft-user-plus"></i> <b><?php echo $name?></b>
                                        &nbsp;<span>
                                            <?php echo $db->ageCalculator( $dob )." "."years"?></span>
                                        <hr>
                                        <div class='row'>
                                            <div class='col-12'>
                                                <!-- <li><span class='patient-info-heading'>Age :</span>
                                                    <?php echo $db->ageCalculator( $dob );?></li> -->
                                                <li><span class='patient-info-heading'>Tel :</span>
                                                    <?php echo $phone ?></li>
                                                <hr>
                                                <li><span class='patient-info-heading'>Address :</span>
                                                    <?php echo $address ?></li>
                                                <hr>
                                                <li><span class='patient-info-heading'>Blood Group :</span>
                                                    <?php echo $bloodGroup ?></li>
                                                <hr>
                                                <li><span class='patient-info-heading'>Allergy
                                                        :</span><?php echo $allergy ?></li>
                                                <br>
                                                <a href="void()" data-toggle="modal" data-target="#add_allergy"><i
                                                        class="ft-plus">Add
                                                        Allergy</i></a>
                                                <hr>
                                                <li><span class='patient-info-heading'><b>Known Clinical
                                                            Condition:</b>
                                                        <?php
                                                     $drugs = $db->getRows( 'patient_known_condition', array( 'where'=>array( 'patientNo'=>$patientNo ), 'order_by'=>'conditionID ASC' ) );
                                                    if ( !empty( $drugs ) ) {
                                                        $x = 0;
                                                        foreach ( $drugs as $p ) {?>

                                                    </span><?php echo $db->getData( 'icdcode', 'icdName', 'icdcode', $p['icdcode'] );?>
                                                </li>
                                                <?php
                                                if (next($drugs )) {
                                                                    echo ','; // Add comma for all elements instead of last
                                               
                                                        }
                                                    }
                                                    }
                                                            ?>

                                                <br>
                                                <a href="void()" data-toggle="modal" data-target="#known_condition"><i
                                                        class="ft-plus">Add Known Condition</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-8 col-md-6'>
                    <div class='card '>

                        <div class='card-content mx-3'>

                            <?php
                        $triage = $db->getRows( 'triage', array( 'where'=>array( 'visitNo'=>$visitNo ) ) );
                        // print_r($triage);
                        if ( !empty( $triage ) ) {
                            $x = 0;
                            foreach ( $triage as $t ) {
                                $tDate = $t['triageDate'];
                                $tTime = $t['triageTime'];
                                $userID = $t['userID'];
                                $score = $t['score'];

                                if ( $tDate == '' )
                                $tDate = date( 'd-m-Y' );
                                else
                                $tDate = $tDate;
                                if ( $tTime == '' )
                                $tTime = date( 'h:m:s' );
                                else
                                $tTime = $tTime;
                                if ( $userID == '' )
                                $userID = $_SESSION['user_session'];
                                else
                                $userID = $userID;
                                ?>
                            <?php 
                            if($roleCode== 2){?>
                            <h4 style='margin-top:30px;margin-bottom:20px;'>Vital Signs</h4>
                            <div class='row'>
                                <div class='col-4'>
                                    <h4><span>Date :</span> <?php echo date( 'd-m-Y' );?></h4>
                                </div>
                                <div class='col-6'>
                                    <h4><span>Time Taken :</span> <?php echo $t['createdDate'];?></h4>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class='col-4'>
                                    <li><span class='patient-info-heading'>HR:</span> <?php echo $t['hrTest'];?></li>
                                    <hr>
                                    <li><span class='patient-info-heading'>RR:</span> <?php echo $t['rrTest'];?></li>
                                    <hr>
                                    <li><span
                                            class='patient-info-heading'>Temperature:</span><?php echo $t['temperature'];?>
                                    </li>
                                    <hr>
                                </div>
                                <div class='col-4'>
                                    <li><span class='patient-info-heading'>Weight :</span><?php echo $t['weight'];?>
                                    </li>
                                    <hr>
                                    <li><span class='patient-info-heading'>02 Stats
                                            :</span><?php echo $t['oxgenSats'];?></li>
                                    <hr>
                                    <?php
                                    if ( $t['trauma'] == 1 )
                                        $ytr = 'active';
                                    else if ( $t['trauma'] == 0 )
                                        $ntr = 'active';
                                    ?>
                                    <li><span class='patient-info-heading'>Trauma :</span><?php if ( $t['trauma'] == '1' ) echo 'Yes';
                                    else echo 'No'?></li>
                                    <hr>
                                </div>
                                <div class='col-4'>
                                    <?php
                                    if ( $t['response'] == 'A' )
                                    $aresp = 'active';
                                    else if ( $t['response'] == 'V' )
                                    $vresp = 'active';
                                    else if ( $t['response'] == 'P' )
                                    $presp = 'active';
                                    else if ( $t['response'] == 'U' )
                                    $uresp = 'active';
                                    else if ( $t['response'] == 'C' )
                                    $cresp = 'active';
                                    ?>
                                    <li><span class='patient-info-heading'>Response :</span> <?php if ( $t['response'] == 'A' ) echo 'Alert(A)';
                                    else if ( $t['response'] == 'V' ) echo 'Voice(V)';
                                    else if ( $t['response'] == 'P' ) echo 'Pain(P)';
                                    else if ( $t['response'] == 'U' ) echo 'Unresponsive(U)';
                                    ?></li>
                                    <hr>

                                </div>
                            </div>
                            <br>
                            <?php if ( $age>12 ) {
                            ?>
                            <div class='row'>
                                <div class='col-4'>
                                    <li><span class='patient-info-heading'>BP :</span> <?php echo $t['bpTest'];
                                ?>/<?php echo $t['bpTestDen'];
                                ?></li>
                                    <hr>
                                    <li><span class='patient-info-heading'>Mobility :</span> <?php echo $t['rrTest'];
                                    ?></li>
                                    <hr>
                                </div>
                            </div>
                            <?php }
                            ?>

                            <?php if ( $age<12 ) {
                                ?>
                            <div class='row'>
                                <div class='col-4'>
                                    <li><span class='patient-info-heading'>Odema :</span> <?php if ( $t['oedema'] == '1' ) echo 'Yes';
                                    else echo 'No';
                                    ?></li>
                                    <hr>
                                    <li><span class='patient-info-heading'>Mobility :</span> <?php echo $t['rrTest'];
                                    ?></li>
                                    <hr>
                                </div>
                                <div class='col-4'>
                                    <li><span class='patient-info-heading'>Length :</span><?php echo $t['length'];
                ?></li>
                                    <hr>
                                    <li><span class='patient-info-heading'>Moving :</span> <?php if ( $t['moving'] == '1' ) echo 'Yes';
                else echo 'No';
                ?></li>
                                    <hr>
                                </div>
                            </div>

                            <?php
            }
        
}else{
    echo 'This is VA sECTION ';
}
                            }
                        }
    ?>
                        </div>
                    </div>
                </div>

                <div class='container-fluid'>

                    <div class='card'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <!-- <span style="font-size:40px;font-weight"><b>Clinical History</b></span><br> -->
                                    <fieldset class="form-group border p-3 table-responsive">
                                        <legend class="w-auto px-2"><b>Clinical History and Findings</b></legend>
                                        <!-- <div class='box-body '> -->

                                        <?php
                                    $patientdiagnosis = $db->getRows( 'consultation', array( 'where'=>array( 'patientNo'=>$patientNo, 'visitNo'=>$visitNo ) ) );
                                    if ( !empty( $patientdiagnosis ) ) {
                                        $x = 0;
                                        foreach ( $patientdiagnosis as $pdd ) {
                                            $x++;
                                            $clinicalHistory = $pdd['clinicalHistory'];
                                            $clinicalFindings = $pdd['clinicalFindings'];
                                            $doctornote = $pdd['doctornote'];
                                            $patientStatus = $pdd['patientStatus'];
                                        }
                                    }else{
                                        $clinicalHistory = '';
                                         $clinicalFindings = '';
                                         $doctornote = '';
                                    }

                                    ?>

                                        <div class='row'>
                                            <div class='col-12'>

                                                <form action='action_clinicalHistory.php' method='POST'>
                                                    <textarea style="height:100px;" name='clinicalHistory'
                                                        placeholder="Clinical History..."
                                                        class="form-control"><?php echo  $clinicalHistory?></textarea>
                                                    <br>
                                                    <textarea style="height:100px;" name='clinicalFindings'
                                                        placeholder="Clinical Findings..."
                                                        class="form-control"><?php echo  $clinicalFindings?></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class='col-5'>

                                            </div>
                                            <div class='col-2'>

                                                <button type="submit" style="width:150px;"
                                                    class='btn btn-success form-control'><i class='ft-'></i>Save
                                                </button>
                                                <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                                                <input type='hidden' name='visitNo' value="<?php echo $visitNo;?>">
                                                <input type='hidden' name='action_type' value='add' />
                                                <!-- </div> -->
                                                </form>

                                            </div>


                                        </div>

                                    </fieldset>



                                </div>
                            </div>
                            <br>
                            <?php
    //if ( $patientStatus == 1 )
    // {?>
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <div class="row">
                                        <div class="col-4">
                                            <h3><b>Provisional Diagnosis</h3></b>
                                        </div>

                                        <div class="col-7">
                                            <a
                                                href="index3.php?sp=provisional_diagnosis&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>">
                                                <i class='ft-edit'></i>Add Provisional Diagnosis</a>
                                        </div>

                                    </div>

                                    <div class='box-body table-responsive'>
                                        <table class='table table-hover'>
                                            <tr>
                                                <td>No</td>
                                                <th>Diagnosis </th>
                                                <th>Case Type</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php
                                    $patientdiagnosis = $db->getRows( 'patient_provisional_diagnosis', array( 'where'=>array( 'visitNo'=>$visitNo, 'patientNo'=>$patientNo,), 'order_by'=>'provisional_id DESC' ) );
                                    if ( !empty( $patientdiagnosis ) ) {
                                        $x = 0;
                                        foreach ( $patientdiagnosis as $d ) {
                                            $x++;
                                            $icdcode = $d['icdCode'];
                                            $patientDiseaseCase = $d['patientDiseaseCase'];

                                            ?>
                                            <tr>
                                                <td><?php echo $x?></td>
                                                <td><?php echo $db->getData( 'icdcode', 'icdName', 'icdCode', $icdcode );?>
                                                </td>
                                                <td><?php if ( $patientDiseaseCase == 0 ) echo 'Repeat case';
                                            elseif ( $patientDiseaseCase == 1 ) echo 'New case';?></td>
                                                <td>
                                                    <a type="button"
                                                        onclick="return confirm('Are you sure you want to delete')"
                                                        href="delete_provisional_diagnosis.php?patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>&icdcode=<?php echo $icdcode?>"><i
                                                            class="la la-trash danger"></i></a>
                                                </td>

                                                <?php }
                                            } else {
                                                ?>
                                            <tr>
                                                <td colspan='6'>No Provisional Diagnosis Recorded ...</td>
                                                <?php }?>
                                            </tr>
                                        </table>

                                        <!-- <div class='col-2' style='margin-left:1000px;'>
                                        <a href="
                                                index3.php?sp=diagnosis&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"
                                                class='btn btn-info form-control'><i class='ft-'></i>Add Diagnosis</a>
                                        </div> -->
                                    </div>
                                </div>

                                <div class='col-lg-6'>
                                    <div class="row">
                                        <div class="col-4">
                                            <h3><b>Emergency Medicine</h3></b>
                                        </div>

                                        <div class="col-7">

                                            <a
                                                href="index3.php?sp=emergency_medication&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>">
                                                <i class='ft-edit'></i>Order Emergency Medication</a>
                                        </div>

                                    </div>

                                    <div class='box-body table-responsive'>
                                        <table class='table table-hover'>
                                            <tr>
                                                <td>No</td>
                                                <th>Medication </th>
                                                <th>Dose</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php
                                            $medication = $db->getRows('patient_medication',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo,'isEmergency'=>1),'order_by'=>'patient_medicationID  ASC'));
                                            if(!empty($medication)){ 
                                            $count = 0; 
                                            foreach($medication as $service){ 
                                            $count++;
                                            $drugID = $service['drugID'];
                                            $dose = $service['dose'];

                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $db->getData("drugs","drugName","drugID",$drugID);?>
                                                </td>
                                                <td><?php echo  $dose ?></td>
                                                <td>
                                                    <a type="button"
                                                        onclick="return confirm('Are you sure you want to delete')"
                                                        href="delete_emergency_medication.php?patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>&icdcode=<?php echo $icdcode?>"><i
                                                            class="la la-trash danger"></i></a>
                                                </td>

                                                <?php }
                                            } else {
                                                ?>
                                            <tr>
                                                <td colspan='6'>No Emergency Medication Orded ...</td>
                                                <?php } ?>
                                            </tr>
                                        </table>

                                        <!-- <div class='col-2' style='margin-left:1000px;'>
                                        <a href="index3.php?sp=diagnosis&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"
                                            class='btn btn-info form-control'><i class='ft-'></i>Add Diagnosis</a>
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class='row'>

                                <div class='col-lg-12'>
                                    <div class="row">
                                        <div class="col-6">
                                            <h3><b>Tests and Investigations</h3></b>
                                        </div>

                                        <div class="col-3">
                                            <a
                                                href="index3.php?sp=ordertest&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"><i
                                                    class='ft-edit'></i> Order Test / Investigation</a>
                                        </div>





                                    </div>
                                </div>
                                <div class='box-body table-responsive no-padding'>
                                    <table class='table table-hover'>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Test Name</th>
                                            <th>Result</th>
                                            <th>File Preview</th>
                                            <!-- <th>Lab Details</th> -->
                                            <!-- <th>Remarks</th> -->
                                            <th>Test Status</th>
                                        </tr>
                                        <?php
    $patientvisit = $db->getRows( 'patienttest', array( 'where'=>array( 'visitNo'=>$visitNo, 'visitStatus'=>1, 'patientNo'=>$patientNo ), 'order_by'=>'testStatus DESC' ) );
    if ( !empty( $patientvisit ) ) {
        $x = 0;
        foreach ( $patientvisit as $pvisits ) {
            $x++;
            $testNo = $pvisits['testNo'];
            $servicesID = $pvisits['servicesCode'];
            $result = $pvisits['result'];
            $fileurl = $pvisits['fileurl'];
            $remarks = $pvisits['labDetails'];
            $testStatus = $pvisits['testStatus'];
            $servicesCode = $pvisits['servicesCode'];

            ?>
                                        <tr>
                                            <td><?php echo $testNo;?></td>
                                            <td><?php echo $db->getData( 'service', 'serviceName', 'serviceCode', $servicesCode );?>
                                            </td>
                                            <!-- <td><button type="button" class="btn btn-primary btn-sm" data-toggle='modal'data-target="#zoomInRight<?php echo $testNo;?>" ><i class="ft-plus"></td> -->
                                            <td><?php echo $result;?></td>
                                            <td>
                                                <?php
                $checkclinical = $db->checkLabImage($patientNo,$visitNo,$testNo);
                foreach($checkclinical as $checkclinical){
                     $clinicalHistory = $checkclinical['fileurl'];
                     if($clinicalHistory){?>
                                                <a href='profile_img/<?php echo $fileurl?>' target="_blank">View
                                                    Image
                                            </td>
                                            <?php
                        }else{?>
                                            <p>No Image</p>
                                            <?php
                        }
                        
                }
                ?>



                                            </td>
                                            <!-- <td><?php echo $result;?></td> -->
                                            <!-- <td><?php echo $remarks;?></td> -->
                                            <?php 
                  if($testStatus==1)
                      $status="Done";
                  else 
                      $status="Inprogress";
                  ?>

                                            <td><?php echo $status;?></td>

                                            <?php
                if ( $testStatus == '' ) {?>
                                            <td><a href='#' class='btn btn-primary a-btn-slide-text'>
                                                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                                                    <span><strong></strong></span>
                                                </a></td>
                                            <?php
            } else {?>

                                            <?php }?>

                                            <div class='modal animated zoomInRight text-left'
                                                id="zoomInRight<?php echo $testNo;?>" tabindex='-1' aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h4 class='modal-title' id='myModalLabel72'> Add Lab
                                                                Test
                                                                Extra Details</h4>
                                                            <button type='button' class='close' data-dismiss='modal'
                                                                aria-label='Close'><span aria-hidden='true'>&times;
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>

                                                            <div class='row'>
                                                                <div class='col-12'>
                                                                    <form action="action_update_extraDetails.php"
                                                                        method="POST">
                                                                        <div class='form-group'>
                                                                            <label for='courseCode'>Test
                                                                                Name:</label>
                                                                            <input type='text' readonly
                                                                                value="<?php echo $db->getData("service","serviceName","serviceCode",$servicesID); ?>"
                                                                                name='name' placeholder='Eg. Procedure'
                                                                                class='form-control' />
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class='col-12'>
                                                                    <div class='box'>
                                                                        <div class='box-header'>
                                                                            <h3 class='box-title'>Extra Details</h3>
                                                                        </div>
                                                                        <div class='box-body pad'>
                                                                            <textarea required class='textarea'
                                                                                name='doctorDetails'
                                                                                style='width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class='modal-footer'>
                                                                        <button type='button'
                                                                            class='btn grey btn-outline-secondary'
                                                                            data-dismiss='modal'>Close</button>
                                                                        <input type="hidden" name="testNo"
                                                                            value="<?php echo $testNo?>">
                                                                        <input type="hidden" name="patientNo"
                                                                            value="<?php echo $patientNo?>">
                                                                        <input type="hidden" name="visitNo"
                                                                            value="<?php echo $visitNo?>">
                                                                        <button type='submit' name="submit"
                                                                            class='btn btn-primary'>Save</button>

                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
            }
        } else {?>
                                        <tr>
                                            <td colspan='6'>No Test Recorded ...</td>
                                            <?php }?>
                                        </tr>
                                    </table>
                                    <!-- <div class='col-2' style='margin-left:1000px;'>
                                        <a href="index3.php?sp=ordertest&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"
                                            class='btn btn-info form-control'><i class='ft-'></i>Add Lab Test</a>
                                    </div> -->
                                </div>
                            </div>
                            <br>

                            <div class='row'>
                                <div class='col-lg-12'>
                                    <div class="row">
                                        <div class="col-5">
                                            <h3><b> Final Diagnosis</h3></b>
                                        </div>

                                        <div class="col-5">
                                            <!-- <a
                                                href="index3.php?sp=diagnosis&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"><i
                                                    class='ft-edit'></i>Add Diagnosis</a> -->
                                            <a data-toggle="modal" data-target="#finalDignosis"><i
                                                    class='ft-edit'></i>Add
                                                Diagnosis</a>
                                        </div>





                                    </div>
                                </div>
                                <div class='box-body table-responsive no-padding'>
                                    <table class='table table-hover'>
                                        <tr>
                                            <td>No</td>
                                            <th>Diagnosis </th>
                                            <th>Case Type</th>
                                        </tr>
                                        <?php
                                            $patientdiagnosis = $db->getRows( 'patientdiagnosis', array( 'where'=>array( 'visitNo'=>$visitNo, 'patientNo'=>$patientNo,'isProvisional'=>0 ), 'order_by'=>'patientdiagnosisID DESC' ) );
                                            if ( !empty( $patientdiagnosis ) ) {
                                                $x = 0;
                                                foreach ( $patientdiagnosis as $d ) {
                                                    $x++;
                                                    $icdcode = $d['icdcode'];
                                                    $patientDiseaseCase = $d['patientDiseaseCase'];

                                                    ?>
                                        <tr>
                                            <td><?php echo $x?></td>
                                            <td><?php echo $db->getData( 'icdcode', 'icdName', 'icdCode', $icdcode );
                                                    ?></td>
                                            <td><?php if ( $patientDiseaseCase == 0 ) echo 'Repeat case';
                                                    elseif ( $patientDiseaseCase == 1 ) echo 'New case';
                                                    ?></td>

                                            <?php }
                                                } else {
                                                    ?>
                                        <tr>
                                            <td colspan='6'>No Dignosis Recorded ...</td>
                                            <?php }?>
                                        </tr>
                                    </table>
                                    <!-- <div class='col-2' style='margin-left:1000px;'>
                                        <a href="index3.php?sp=diagnosis&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"
                                            class='btn btn-info form-control'><i class='ft-'></i>Add Diagnosis</a>
                                    </div> -->
                                </div>
                            </div>
                            <br>

                            <div class='row'>
                                <div class='col-lg-12'>
                                    <!-- <span style="font-size:40px;font-weight"><b>Clinical History</b></span><br> -->
                                    <fieldset class="form-group border p-3 table-responsive">
                                        <legend class="w-auto px-2"><b>Management Plan</b></legend>
                                        <!-- <div class='box-body '> -->

                                        <div class='row'>
                                            <div class='col-lg-6'>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h3><b>Procedures</h3></b>
                                                    </div>

                                                    <div class="col-5">
                                                        <a href="index3.php?sp=orderProcedure&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"
                                                            style='width:160px;' style='color:white'><i
                                                                class='ft-edit '></i>Order
                                                            Procedure</a>
                                                    </div>

                                                </div>

                                                <div class='box-body table-responsive no-padding'>
                                                    <table class='table table-hover'>
                                                        <tr>
                                                            <td>No</td>
                                                            <th>Desease </th>
                                                            <th>New case/Repeate case</th>
                                                        </tr>
                                                        <?php
                                                    $patientprocedure = $db->getRows( 'patientprocedure', array( 'where'=>array( 'visitNo'=>$visitNo, 'patientNo'=>$patientNo ), 'order_by'=>'patientprocedureID DESC' ) );
                                                    if ( !empty( $patientprocedure ) ) {
                                                        $x = 0;
                                                        foreach ( $patientprocedure as $d ) {
                                                            $x++;
                                                            $serviceCode = $d['serviceCode'];
                                                            $serviceName = $db->getData( 'service', 'serviceName', 'serviceCode', $serviceCode );
                                                            //$reportingDate = $d['reportingDate'];
                                                            $visitNo = $d['visitNo'];

                                                            ?>
                                                        <tr>
                                                            <td><?php echo $x?></td>
                                                            <td><?php echo $serviceName;?></td>
                                                            <td><?php echo $visitNo?></td>
                                                            <?php }
                                                        } else {
                                                            ?>
                                                        <tr>
                                                            <td colspan='3'>No Procedure Ordered( s ) found......</td>
                                                            <?php }?>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </div>
                                            <div class='col-lg-6'>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h3><b>Medication</h3></b>
                                                    </div>

                                                    <div class="col-5">
                                                        <a
                                                            href="index3.php?sp=medication&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"><i
                                                                class='ft-edit '></i> Add Medication</a>
                                                    </div>





                                                </div>


                                                <div class='box-body table-responsive no-padding'>
                                                    <table class='table table-hover'>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Medicine</th>
                                                            <th>Dose</th>
                                                        </tr>

                                                        <?php
                                                    $drugs = $db->getRows( 'patient_medication', array( 'where'=>array( 'visitNo'=>$visitNo, 'patientNo'=>$patientNo,'isEmergency'=>0), 'order_by'=>'patient_medicationID ASC' ) );
                                                    if ( !empty( $drugs ) ) {
                                                        $x = 0;
                                                        foreach ( $drugs as $p ) {
                                                            $x++;
                                                            $drugID = $p['drugID'];
                                                            $dose = $p['dose']
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $x?></td>
                                                            <td><?php echo $db->getData( 'drugs', 'drugName', 'drugID', $drugID );?>
                                                            </td>
                                                            <td><?php echo $dose;?></td>

                                                            <?php }
                                                        } else {
                                                            ?>
                                                        <tr>
                                                            <td colspan='3'>No Medication Recorded ...</td>
                                                            <?php }?>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-12'>

                                                <form action='action_doctornote.php' method='POST'>
                                                    <textarea style="height:100px;" name='doctornote'
                                                        placeholder="Doctors's Notes ..."
                                                        class="form-control"><?php echo  $doctornote?></textarea>
                                                    <br>


                                                    <div class="row">
                                                        <div class='col-5'>

                                                        </div>
                                                        <div class='col-2'>

                                                            <button style="color:white" type="submit"
                                                                style="width:150px;"
                                                                class='btn btn-success form-control'><i
                                                                    class='ft-'></i>Save
                                                            </button>
                                                            <input type='hidden' name='patientNo'
                                                                value="<?php echo $patientNo;?>">
                                                            <input type='hidden' name='visitNo'
                                                                value="<?php echo $visitNo;?>">
                                                            <input type='hidden' name='action_type' value='add' />
                                                            <!-- </div> -->
                                                </form>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <br>
                            <div class='col-12'><br>
                                <h3><b>End Consultation</b></h3>
                            </div>
                            <div class='row'>
                                <div class='col-md-6 col-sm-12'>
                                    <form action='action_patientRelease.php' method='POST' id="endconsultation">
                                        <select class='form-control' name='remarks' id='remarks' required>
                                            <?php
                                    $OPDreleaseStatus = $db->getRows( 'opdreleasestatus', array( 'order_by'=>'OPDreleaseStatusID  ASC' ) );
                                    if ( !empty( $OPDreleaseStatus ) ) {
                                        echo "<option value=''>Select Release Status</option>";
                                        foreach ( $OPDreleaseStatus as $dept ) {
                                            $OPDreleaseStatusID = $dept['OPDreleaseStatusID'];
                                            $name = $dept['name'];

                                            ?>
                                            <option value="<?php echo $OPDreleaseStatusID;?>"><?php echo $name;
                                            ?></option>
                                            <?php }
                                        }
                                        ?>
                                        </select>
                                </div>
                                <div class='col-md-6 col-sm-6' style="display:none;font-size:25px;" id="passPharmacy">
                                    <input type="checkbox" class="checkbox_class" value="true" name='isCkecked'
                                        style="width:40px;" checked>
                                    <span>Pass through
                                        Pharmacy</span>
                                </div>
                            </div>
                            <br>
                            <div class='row' id='div1'>
                                <div class='col-2'>
                                    <label><b>Hospital Name:</b></label>
                                </div>
                                <div class='col-4'>
                                    <select name='hospitalCode' class='form-control' id='hospital'>
                                        <option value=''>Select Here</option>
                                        <?php
                                        $hospital = $db->getRows( 'hospital', array( 'order_by'=>'hospitalName ASC' ) );
                                        if ( !empty( $hospital ) ) {
                                            foreach ( $hospital as $dept ) {
                                                $hospitalCode = $dept['hospitalCode'];
                                                $hospitalName = $dept['hospitalName'];
                                                ?>
                                        <option value="<?php echo $hospitalCode;?>"><?php echo $db->decrypt($hospitalName);
                                                ?></option>
                                        <?php }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row' id='div2'>
                                <div class='col-2'>
                                    <label><b>Clinical:</b></label>
                                </div>
                                <div class='col-4'>
                                    <select name='clinicalCode' class='form-control' id='ward'>
                                        <option value=''>Clinical</option>
                                        <?php
                                            $clinic = $db->getRows( 'clinic', array( 'order_by'=>'clinicName ASC' ) );
                                            if ( !empty( $clinic ) ) {
                                                echo "<option value=''>Select Here</option>";
                                                foreach ( $clinic as $dept ) {

                                                    $clinicCode = $dept['clinicCode'];
                                                    $clinicName = $dept['clinicName'];
                                                    ?>
                                        <option value="<?php echo $clinicCode;?>"><?php echo $clinicName;
                                                    ?></option>
                                        <?php }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>
                            <div class='row' id='div3'>
                                <div class='col-2'>
                                    <label><b>Ward:</b></label>
                                </div>
                                <div class='col-4'>
                                    <select name='wardCode' class='form-control' id='clinic'>
                                        <?php
                                                $clinic = $db->getRows( 'hospital_ward', array( 'order_by'=>'hospital_ward_id ASC' ) );
                                                if ( !empty( $clinic ) ) {
                                                    echo "<option value=''>Select Here</option>";
                                                    foreach ( $clinic as $dept ) {

                                                        $wardName = $dept['wardName'];
                                                        $wardCode = $dept['wardCode'];
                                                        ?>
                                        <option value="<?php echo $wardCode;?>"><?php echo $wardName;
                                                        ?></option>
                                        <?php }
                                                    }
                                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class='row' id='div4'>
                                <div class='col-2'>
                                    <label><b>death:</b></label>
                                </div>
                                <div class='col-4'>
                                    <select name='deathCauseID' class='form-control' id='death'>
                                        <option value=''>Select Death:</option>
                                        <?php
                                                    $deathID = $db->getRows( 'death', array( 'order_by'=>'deathID ASC' ) );
                                                    if ( !empty( $deathID ) ) {
                                                        echo "<option value=''>Select Here</option>";
                                                        foreach ( $deathID as $dept ) {

                                                            $deathID = $dept['deathID'];
                                                            $deathName = $dept['deathName'];
                                                            ?>
                                        <option value="<?php echo $deathID;?>"><?php echo $deathName;
                                                            ?></option>
                                        <?php }
                                                        }
                                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row' id='div5'>
                                <div class='col-2'>
                                    <label><b>Description:</b></label>
                                </div>
                                <div class='col-4'>
                                    <textarea name='description' height='200px' width='200px'
                                        id='description'></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php //}
                                                        ?>
                    <div class='row'>
                        <div class='col-lg-12'></div>
                        <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                        <input type='hidden' name='visitNo' value="<?php echo $visitNo;?>">

                        <div class='col-lg-8'></div>
                        <div class='col-lg-2'>
                            <input type='hidden' name='action_type' value='add' />
                            <input type='submit' name='doUpdate' value='Save Records' class='btn btn-info form-control'
                                style='color:white'>
                        </div>
                        </form>

                        <div class='col-lg-2'>
                            <a href='index3.php'>
                                <input type='hidden' name='action_type' value='cancel' />
                                <input type='submit' name='docancel' value='Cancel' class='btn btn-danger form-control'
                                    style='color:white'></a>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</section>

<div class='modal fade' id='add_new_medical_history' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='myModalLabel'>Add New Record</h4>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;
                    </span>
                </button>
            </div>

            <div class='modal-body'>
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class='box'>
                            <div class='box-header'>
                                <form action='action_clinicalHistory.php' method='POST' id='clinicalHistory'>
                                    <h3 class='box-title'>Clinical History</h3>
                                    <textarea class='textarea' name='clinicalHistory'
                                        placeholder='Please type your text here'
                                        style='width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-lg-12'>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal' tabindex='9'>Cancel</button>
                        <input type='submit' name='doSubmit' value='Save' class='btn btn-primary' tabindex='8'>
                        <input type='hidden' name='action_type' value='add' />
                        <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                        <input type='hidden' name='visitNo' value="<?php echo $visitNo;?>">

                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
</div>

<!--- ADD ALLERGIES--->
<div class="modal fade" id="add_allergy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Allergies</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="upload_zones.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="exampleInputFile">Allergy Type</label>
                                <select name="allergy" id="allergy_typeID" class="form-control" />
                                <?php
                                    $al_type = $db->getRows('allergy_type',array('order_by'=>'allergy_type ASC'));
                                        if(!empty($al_type)){
                                            echo "<option value=''>Select Here</option>";
                                            $count = 0; 
                                            foreach($al_type as $alt){
                                                $count++;
                                            $allergy_type=$alt['allergy_type'];
                                            $allergy_typeID =$alt['allergy_typeID'];
                                            ?>
                                <option value="<?php echo $allergy_typeID ;?>">
                                    <?php echo $allergy_type;?></option>
                                <?php 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="exampleInputFile">Allergy</label>
                                <select name="allegy" id="allergy_name" class="form-control" />

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputFile">Reaction</label>
                                <select name="allergy" id="allergy_reactionID" class="form-control" />
                                <?php
                                    $al_type = $db->getRows('allergy_reaction',array('order_by'=>'allergy_reactionID ASC'));
                                        if(!empty($al_type)){
                                            echo "<option value=''>Select Here</option>";
                                            $count = 0; 
                                            foreach($al_type as $alt){
                                                $count++;
                                            $allergy_reactionID=$alt['allergy_reactionID'];
                                            $allergy_reaction =$alt['allergy_reaction'];
                                            ?>
                                <option value="<?php echo $allergy_reactionID ;?>">
                                    <?php echo $allergy_reaction;?></option>
                                <?php 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputFile">Reaction Level</label>
                                <select name="allergy" id="allergy_reactionID" class="form-control" />
                                <?php
                                    $al_type = $db->getRows('allergy_reaction',array('order_by'=>'allergy_reactionID ASC'));
                                        if(!empty($al_type)){
                                            echo "<option value=''>Select Here</option>";
                                            $count = 0; 
                                            foreach($al_type as $alt){
                                                $count++;
                                            $allergy_reactionID=$alt['allergy_reactionID'];
                                            $allergy_reaction =$alt['allergy_reaction'];
                                            ?>
                                <option value="<?php echo $allergy_reactionID ;?>">
                                    <?php echo $allergy_reaction;?></option>
                                <?php 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputFile">Action</label>
                                <br>
                                <span><i class="ft-trash" style="color:red;margin-top:100px;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="block"></div>

                    <div class="row">
                        <div class="form">
                            <div class="col-lg-12">
                                <input type="button" value='Add Allergy' onclick="return add()" class="btn btn-info add"
                                    id="add">
                                <input type="hidden" name="patientNo" value="<?php echo $patientNo;?>">
                                <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>">
                                <input type="hidden" name="action_type" value="add" />
                                <br>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="action_type" value="addcategory" />
                        <input type="submit" name="submit" value="Save" class="btn btn-primary" tabindex="8">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<!--- ADD ALLERGIES--->


<!--- ADD KHOWN CONDITION--->
<div class="modal fade" id="known_condition" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Known Condition</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="action_known_condition.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Khown Condition</label>
                                <select class='form-control multiple' multiple="" name='conditionID[]'>
                                    <!-- <option value=''>Select diagnosis</option> -->
                                    <?php
                                $diseases = $db->getRows('icdcode', array('order_by' => 'icdID ASC'));
                                    if(!empty($diseases)){
                                foreach($diseases as $disease){
                                    //$icdID=$dept['icdID'];
                                    $icdCode=$disease['icdCode'];
                                    $icdName=$disease['icdName'];
                                    ?>
                                    <option value='<?php echo $icdCode;?>'><?php echo $icdName;?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="action_type" value="add" />
                        <input type="hidden" name="patientNo" value="<?php echo $patientNo?>" />
                        <input type="hidden" name="visitNo" value="<?php echo $visitNo?>" />
                        <input type="submit" name="submit" value="Save" class="btn btn-primary" tabindex="8">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!--- ADD KHOWN CONDITION--->


<!--- ADD PROVISIONAL DIAGNOSIS--->
<div class="modal fade" id="provisional_diagnosis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Provisional Dignosis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="upload_zones.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-4'>
                            <label>Dignosis</label>
                            <select class='form-control chosen-select' id='new' name='icdID[]'>
                                <option value=''>Select diagnosis</option>
                                <?php
                                $diseases = $db->getRows('icdcode', array('order_by' => 'icdID ASC'));
                                    if(!empty($diseases)){
                                foreach($diseases as $disease){
                                    //$icdID=$dept['icdID'];
                                    $icdCode=$disease['icdCode'];
                                    $icdName=$disease['icdName'];
                                    ?>
                                <option value='<?php echo $icdCode;?>'><?php echo $icdName;?></option>
                                <?php }}?>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <div class='form-group'>
                                <label>Dose</label>
                                <select class='form-control' name='case[]' required>
                                    <option value=''>Select Case Type(New /Repeate)</option>
                                    <option value='1'>New case</option>
                                    <option value='0'>Reattended case</option>
                                </select>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='form-group'>
                                <label>Dose</label>
                                <br>
                                <input type='submit' value='Drop' class='remove btn btn-danger' style='height:40px;'>
                            </div>
                        </div>
                        <div class="block2"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="button" value='Add Diagnosis' onclick="return add()" class="btn btn-info"
                                id='add'>
                            <input type="hidden" name="patientNo" value="<?php echo $patientNo;?>">
                            <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>">
                            <input type="hidden" name="action_type" value="add" />
                            <input type="submit" name="doSubmit" value="Save" class="btn btn-info"
                                style="color:white" />
                        </div>
                    </div>

                    <br>
                    <!-- <input type='submit' value='Drop' class='remove btn btn-danger' style='height:40px;'> -->
                </div>
                <div class="row">
                    <br />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                    <input type="hidden" name="action_type" value="addcategory" />
                    <input type="submit" name="submit" value="Save" class="btn btn-primary" tabindex="8">
                </div>
        </div>
        </form>

    </div>
</div>
</div>
<!--- ADD PROVISIONAL DIAGNOSIS--->






<!--- ADD FINAL DIAGNOSIS--->
<div class="modal fade" id="finalDignosis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Final Diagnosis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="action_patientdignosis.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Please Tick if Provisional Dignosis is Same as Final
                                    Dignosis</label>
                                <br>
                                <table>
                                    <?php
                                    $patientdiagnosis = $db->getRows( 'patient_provisional_diagnosis', array( 'where'=>array( 'visitNo'=>$visitNo, 'patientNo'=>$patientNo ), 'order_by'=>'provisional_id DESC' ) );
                                    if ( !empty( $patientdiagnosis ) ) {
                                        $x = 0;
                                        foreach ( $patientdiagnosis as $d ) {
                                    //$icdID=$dept['icdID'];
                                    $icdCode=$d['icdCode'];
                                    $icdNames=$d['icdName'];
                                    ?>
                                    <tr>
                                        <td>
                                            <input type='checkbox' class='checkbox_class' name='icdCode[]'
                                                value='<?php echo $icdCode; ?>'>
                                        </td>
                                        <td>
                                            <span style="margin-left:10px;">
                                                <?php echo $db->getData('icdcode' ,'icdName','icdCode',$icdCode)?>
                                            </span>

                                        </td>
                                    </tr>
                                    <?php }}?>
                                </table>
                                <br>
                                <div class="block"></div>
                                <br>
                                <div class="col-lg-12">
                                    <input type="button" value='Add Diagnosis' onclick="return add" class="btn btn-info"
                                        id='addmed'>
                                    <input type="hidden" name="patientNo" value="<?php echo $patientNo;?>">
                                    <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>">
                                    <input type="hidden" name="action_type" value="add" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="action_type" value="add" />
                        <input type="hidden" name="patientNo" value="<?php echo $patientNo?>" />
                        <input type="hidden" name="visitNo" value="<?php echo $visitNo?>" />
                        <input type="submit" name="submit" value="Save" class="btn btn-primary" tabindex="8">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!--- ADD FINAL DIAGNOSIS--->




<!-- END: Content-->

<script src='app-assets/jQuery/jQuery-2.1.4.min.js'></script>
<script src='app-assets/js/jquery-1.12.4.js'></script>

<script src='app-assets/js/scripts/pages/hospital-patient-profile.js'></script>
</body>

</html>
<script type='text/javascript'>
function validate(frm) {
    var ele = frm.elements['feed2url[]'];
    if (!ele.length) {
        alert(ele.value);
    }
    for (var i = 0; i < ele.length; i++) {
        alert(ele[i].value);
    }
    return true;
}

function add_feed2() {
    var div1 = document.createElement('div');

    div1.innerHTML = document.getElementById('link').innerHTML;
    document.getElementById('newlink2').appendChild(div1);
}
</script>

<script>
$('#remarks').change(function() {
    if ($(this).val() == 2) {

        $('#div3').show();
        $('#passPharmacy').hide();
        $('#clinic').attr('required');
        $('#clinic').attr('data-error');
        $('#div5').show();
        $('#description').attr('required');
        $('#description').attr('data-error');

        $('#div1').hide();
        $('#hospital').removeAttr('required', '');
        $('#hospital').removeAttr('data-error', 'This field is required.');
        $('#div2').hide();
        $('#ward').removeAttr('required');
        $('#ward').removeAttr('data-error');
        $('#div4').hide();
        $('#death').removeAttr('required');
        $('#death').removeAttr('data-error');

    } else if ($(this).val() == 5) {

        $('#div4').show();
        $('#passPharmacy').hide();
        $('#hospital').attr('required');
        $('#hospital').attr('data-error');
        $('#div5').show();
        $('#description').attr('required');
        $('#description').attr('data-error');

        $('#div5').show();
        $('#ward').removeAttr('required');
        $('#ward').removeAttr('data-error');
        $('#div3').hide();
        $('#clinic').removeAttr('required');
        $('#clinic').removeAttr('data-error');
        $('#div4').hide();
        $('#death').removeAttr('required');
        $('#death').removeAttr('data-error');
    } else if ($(this).val() == 4) {

        $('#div1').show();
        $('#passPharmacy').hide();
        $('#death').attr('required');
        $('#death').attr('data-error');
        $('#div5').show();
        $('#description').attr('required');
        $('#description').attr('data-error');

        $('#div4').hide();
        $('#hospital').removeAttr('required');
        $('#hospital').removeAttr('data-error');
        $('#div2').hide();
        $('#ward').removeAttr('required');
        $('#ward').removeAttr('data-error');
        $('#div3').hide();
        $('#clinic').removeAttr('required');
        $('#clinic').removeAttr('data-error');
    } else if ($(this).val() == 3) {

        $('#div2').show();
        $('#passPharmacy').hide();
        $('#ward').attr('required');
        $('#ward').attr('data-error');
        $('#div5').show();
        $('#description').attr('required');
        $('#description').attr('data-error');

        $('#div1').hide();
        $('#hospital').removeAttr('required', '');
        $('#hospital').removeAttr('data-error', 'This field is required.');
        $('#div3').hide();
        $('#clinic').removeAttr('required');
        $('#clinic').removeAttr('data-error');
        $('#div4').hide();
        $('#death').removeAttr('required');
        $('#death').removeAttr('data-error');
    } else if ($(this).val() == 1) {
        $('#passPharmacy').show();
        $('#div1').hide();
        $('#hospital').removeAttr('required', '');
        $('#hospital').removeAttr('data-error', 'This field is required.');
        $('#div2').hide();
        $('#ward').removeAttr('required');
        $('#ward').removeAttr('data-error');
        $('#div3').hide();
        $('#clinic').removeAttr('required');
        $('#clinic').removeAttr('data-error');
        $('#div5').hide();
        $('#description').removeAttr('required');
        $('#description').removeAttr('data-error');
    } else {
        $('#div1').hide();
        $('#passPharmacy').hide();
        $('#hospital').removeAttr('required', '');
        $('#hospital').removeAttr('data-error', 'This field is required.');
        $('#div2').hide();
        $('#ward').removeAttr('required');
        $('#ward').removeAttr('data-error');
        $('#div3').hide();
        $('#clinic').removeAttr('required');
        $('#clinic').removeAttr('data-error');
        $('#div4').hide();
        $('#death').removeAttr('required');
        $('#death').removeAttr('data-error');
        $('#div5').hide();
        $('#description').removeAttr('required');
        $('#description').removeAttr('data-error');

    }
});
$('#remarks').trigger('change');
</script>
<script>
// Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#endconsultation").validate({

        // Passing the object with custom rules
        rules: {
            // login - is the name of an input in the form
            remarks: {
                required: true,
                // Setting email pattern for email input

            },
        },
        // Setting error messages for the fields
        messages: {
            remarks: {
                required: "Please choose Menu To Continue",

            },
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#allergy_typeID").change(function() {
        var allergy_typeID = $(this).val();
        var dataString = 'allergy_typeID=' + allergy_typeID;
        //console.log(allergy_typeID);
        $.ajax({
            type: "POST",
            url: "ajax_allergy.php",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#allergy_name").html(html);
            }
        });

    });
});
</script>



<script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
$('#add').click(function() {
    $('.block:last').before(
        "<div class='block' id='remove'><div class='row'><div class='col-lg-3'><div class='form-group'><label for='exampleInputFile'>Allergy Type</label><select name='allergy' id='allergy_typeIDs' class='form-control'><option value=''>Select Here</option><?php $al_type = $db->getRows('allergy_type',array('order_by'=>'allergy_type ASC'));if(!empty($al_type)){;foreach($al_type as $alt){?><option value='<?php echo $alt['allergy_typeID'] ;?>'><?php echo $alt['allergy_type'];;?></option><?php }}?></select></div></div>" +
        "<div class='col-lg-2'><div class='form-group'><label for='exampleInputFile'>Allergy</label><select name='allegy' id='allergy_names' class='form-control'></select></div></div>" +
        "<div class='col-md-3'><div class='form-group'><label for='exampleInputFile'>Reaction Level</label><select name='allergy' id='allergy_reactionID' class='form-control'><option value=''>Select Here</option><?php $al_type = $db->getRows('allergy_reaction',array('order_by'=>'allergy_reactionID ASC'));if(!empty($al_type)){foreach($al_type as $alt){$allergy_reactionID=$alt['allergy_reactionID'];$allergy_reaction =$alt['allergy_reaction'];?><option value='<?php echo $allergy_reactionID ;?>'><?php echo $allergy_reaction;?></option><?php }}?></select></div></div>" +
        "<div class='col-md-2'><div class='form-group'><label for='exampleInputFile'>Reaction Level</label><select name='allergy' id='allergy_reactionID' class='form-control'><option value=''>Select Here</option><?php $al_type = $db->getRows('allergy_reaction',array('order_by'=>'allergy_reactionID ASC'));if(!empty($al_type)){foreach($al_type as $alt){$allergy_reactionID=$alt['allergy_reactionID'];$allergy_reaction =$alt['allergy_reaction'];?><option value='<?php echo $allergy_reactionID ;?>'><?php echo $allergy_reaction;?></option><?php }}?></select></div></div>" +
        "<div class='col-md-2'><div class='form-group'><label for='exampleInputFile'>Action</label><br><span><i class='remove ft-trash' title='Remove Allergy' style='color:red;margin-top:100px;'></i></span></div></div>" +

        "</div></div>"
    );
    $('.chosen-select').trigger("chosen:updated");
    $('.chosen-select').chosen();
});

$(document).on('click', '.remove', function() {
    $(this).closest('.block').remove();
});
</script>



<script>
$(function() {
    $('.chosen-select').chosen();
    $('#new').chosen();
    $('.chosen-select-deselect').chosen();
});
</script>

<script>
$('#addd').click(function() {
    $('.block:last').before(
        "<div class='block2'><div class='col-md-12'><div class='row'><div class='col-md-4'><select  class='form-control chosen-select' name='icdCode[]'><option value=''>Select Medicine</option><?php $drugs = $db->getRows('drugs',array('order_by'=>'drugID  ASC'));if(!empty($drugs)){foreach($drugs as $dept){$drugID=$dept['drugCode'];$drugName=$dept['drugName'];?><option value='<?php echo $drugID;?>''><?php echo $drugName;?></option><?php }}?></select></div><div class='col-md-4'><div class='form-group'><input type='text' name='dose[]' placeholder='Dose' class='form-control'/></div></div>&nbsp; &nbsp;<input type='submit' value='Drop' class='remove btn btn-danger' style='height:40px;'></div></div></div></div>"
    );
    $('.chosen-select').trigger("chosen:updated");
    $('.chosen-select').chosen();
});

$(document).on('click', '#removee', function() {
    $(this).closest('.block2').remove();
});
</script>
<script>
$(function() {
    $('.chosen-select2').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true
    });

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$(".multiple").select2({
    placeholder: "Select a Known Condition",
    allowClear: true
});
</script>
<script>
$('#addmed').click(function() {
    $('.block:last').before(
        "<div class='block' id='remove'><div class='col-md-12'><div class='row'><div class='col-md-6'><select class='form-control chosen-select' id='new' name='icdCode[]'>echo '<option value=''>Select diagnosis</option>'<?php $icdcode = $db->getRows('icdcode',array('order_by'=>'icdCode  ASC'));if(!empty($icdcode)){;foreach($icdcode as $dept){$icdID=$dept['icdID'];$icdCode=$dept['icdCode'];$icdName=$dept['icdName'];?><option value='<?php echo $icdCode;?>''><?php echo $icdName;?></option><?php }}?></select></div><div class='col-md-4'><div class='form-group'><select class='form-control' name='case[]'><option value=''>Select Case Type(New /Reattended)</option><option value='1'>New case</option><option value='0'>Reattended case</option></select></div></div>&nbsp; &nbsp;<input type='submit' value='Drop' class='remove btn btn-danger' style='height:40px;'></div></div></div></div>"
    );
    $('.chosen-select').trigger("chosen:updated");
    $('.chosen-select').chosen();
});

$(document).on('click', '.remove', function() {
    $(this).closest('.block').remove();
});
</script>

<script>
$(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true
    });
});
</script>