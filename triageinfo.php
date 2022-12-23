<?php $db = new DBHelper();
$patientNo = $_REQUEST['patientNo'];
$vt = $_REQUEST['visitNo'];
$serviceCodee = $_REQUEST['serviceCode'];
$service =  explode( ',', $serviceCodee );
 $serviceCode = $service[0];
// $serviceCodee = $healthSchemePayment[0];
// $ageAtVisit=$_POST['ageAtVisit'];
 $serviceCod=$_REQUEST['serviceCode'];
?>

<?php
$patients = $db->getRows( 'patient', array( 'where'=>array( 'patientNo'=>$patientNo ) ) );
if ( !empty( $patients ) ) {
    $x = 0;
    foreach ( $patients as $patient ) {
        $x++;
        $patientNo = $patient['patientNo'];
        $fname = $patient['firstName'];
        $mname = $patient['middleName'];
        $lname = $patient['lastName'];
        $dob = $patient['dob'];
        $sex = $patient['sex'];
        $address = $patient['address'];
        $telNumber = $patient['telNumber'];
        $name = $fname.' '.$mname.' '.$lname;
    }

    ?>
<!--        <h3>Application</h3>-->
<div class='container-fluid' style='margin-top:18px;'>
    <div class='card'>
        <div class='card-header'>
            <h2> <i class='la la-user-plus font-large-2 success'></i> Triage Center</h2>
        </div>

        <div class='row'>
            <div class='card-body'>
                <h3 class='box-title'>Patient Information</h3>
                <table class='table table-hover'>
                    <tr>
                        <th>Patient No</th>
                        <th>Visit No</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Address</th>
                    </tr>
                    <tr>
                        <?php $age = $db->ageCalculator( $dob );?>
                        <td><?php echo $patientNo;?></td>
                        <td><?php echo $vt;?>
                        <td><?php echo $name;?></td>
                        <td><?php echo $age;?></td>
                        <td><?php echo $sex;?></td>
                        <td><?php echo $address;?></td>
                    </tr>

                </table>

                <?php
    $triage = $db-> getTriageVisit( $vt, $patientNo );
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

                <!-- Triage Information -->

                <form method='post' action='action_addscore.php' role='form'>
                    <fieldset>
                        <h3>Triage Information</h3>
                        <div class='row' style='margin-top:30px;'>
                            <div class='col-4'>
                                <label for='FirstName'>Date</label>
                                <input type='text' name='dateOfTriage' value="<?php echo $tDate;?>" readonly='readonly'
                                    class='form-control' required='' />
                                <input type='hidden' name='serviceCode' value="<?php echo $serviceCod;?>"
                                    readonly='readonly' class='form-control' required='' />
                            </div>
                            <div class='col-4'>
                                <label for='MiddleName'>Time</label>
                                <input type='text' name='timeOfTriage' value="<?php echo  $tTime;?>" readonly='readonly'
                                    class='form-control' />
                            </div>
                            <div class='col-4'>
                                <label for='LastName'>Nurse</label>
                                <?php
            $userData = $auth_user->getRows( 'users', array( 'where'=>array( 'userID'=>$userID ), 'order_by'=>'userID' ) );
            if ( !empty( $userData ) ) {
                foreach ( $userData as $user ) {
                    $fname = $user['firstName'];
                    $lname = $user['lastName'];
                    $roleID = $user['roleCode'];
                    //$hCode = $user['hospitalCode'];
                }
            }
            ?>
                                <input type='text' name='nurseID' value='<?php echo $fname." ". $lname;?>'
                                    readonly='readonly' class='form-control' required='' />
                            </div>
                        </div>

                        <fieldset>
                            <h4 style='margin-top:30px;margin-bottom:20px;'>Vital Signs and Examination</h4>
                            <div class='row'>
                                <div class='col-3'>
                                    <label for='name'>HR:</label>
                                    <input type='number' name='hr' value="<?php echo $t['hrTest'];?>"
                                        class='form-control' id='name' placeholder='Enter HR' autocomplete='off'
                                        required>
                                </div>
                                <div class='col-3'>
                                    <label for='email'>RR:</label>
                                    <input type='number' name='rr' value="<?php echo $t['rrTest'];?>"
                                        class='form-control' id='email' placeholder='Enter RR' autocomplete='off'
                                        required>
                                </div>
                                <div class='col-3'>
                                    <label for='pwd'>Temperature: </label>
                                    <input type='number' name='temp' value="<?php echo $t['temperature'];?>"
                                        class='form-control' id='pwd' placeholder='Enter Temperature' autocomplete='off'
                                        required>
                                </div>
                                <div class='col-3'>
                                    <label for='pwd'>02 Stats: </label>
                                    <input type='number' name='stats' value="<?php echo $t['oxgenSats'];?>"
                                        class='form-control' id='pwd' placeholder='Enter O2 Stats' autocomplete='off'
                                        required>
                                    <input type='hidden' name='onBooking' value="<?php echo $t['onBooking'];?>"
                                        class='form-control' id='pwd' placeholder='Enter O2 Stats' autocomplete='off'
                                        required>
                                </div>
                            </div>

                            <div class='row'>
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
                                <div class='col-4'>
                                    <label for='name'>Response:</label>
                                    <select class='form-control' name='response'>
                                        <option>Select</option>
                                        <option value='A' id='option1'>Alert( A )</option>
                                        <option value='V' id='option2'>Voice( V )</option>
                                        <option value='P' id='option2'>Pain( P )</option>
                                        <option value='U' id='option2'>Unresponsive( U )</option>
                                        <?php if ( $age >= 12 ) {
                ?>
                                        <option value='C' id='option2'>Confused( C )</option>
                                        <?php }
                ?>
                                    </select>
                                </div>
                                <div class='col-4'>
                                    <label for='pwd'>Weight: </label>
                                    <input type='text' name='weight' value="<?php echo $t['weight'];?>"
                                        class='form-control' required id='pwd' placeholder='Enter Weight'>
                                </div>
                                <?php
                if ( $t['trauma'] == 1 )
                $ytr = 'active';
                else if ( $t['trauma'] == 0 )
                $ntr = 'active';
                ?>
                                <div class='col-4'>
                                    <label for='email'>Trauma:</label>
                                    <select class='form-control' name='trauma'>
                                        <!-- <option value="<?php echo $t['trauma']?>">
                                            <?php if($t['trauma'] ==1){echo 'Yes';}else{echo 'No';}?></option> -->
                                        <option value='1'>Yes</option>
                                        <option value='2'>No</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class='col-3'>
                                    <?php if ( $age >= 12 ) {?>
                                    <div class='row'>
                                        <label for='pwd' style='margin-left:13px;'>BP: </label>
                                        <div class='col-4'>
                                            <input type='number' size='12' name='bp' value="
                                        <?php echo $t['bpTest'];?>" class='form-control' id='pwd'
                                                placeholder='Systolic'>
                                        </div>
                                        <div class='col-1'> /</div>
                                        <div class='3'>
                                            <input type='number' name='bpTestDen' value="<?php echo $t['bpTestDen'];?>"
                                                class='form-control' id='pwd' size='12' placeholder='Diastolic'>
                                        </div>
                                    </div>
                                </div>
                                <?php } else {
                        if ( $t['oedema'] == 1 )
                        $soedema = 'active';
                        if ( $t['oedema'] == 0 )
                        $snoedema = 'active';
                        ?>
                                <div class='col-6'>
                                    <label>Odema: </label>
                                    <Select class='form-control' name='oedema'>
                                        <option value='1' id='option1'>Yes</option>
                                        <option value='0' id='option2'>No</option>
                                    </select>
                                </div>
                                <?php
                    }
                    ?>

                            </div>

                            <?php if ( $age >= 12 ) {

                        if ( $t['mobility'] == 'W' )
                        $wmobi = 'active';
                        else if ( $t['mobility'] == 'WA' )
                        $wamobi = 'active';
                        else if ( $t['mobility'] == 'S' )
                        $smobi = 'active';
                        ?>
                            <div class='row'>
                                <div class='col-6'>
                                    <label for='pwd'>Mobility: </label>
                                    <select class='form-control' name='mobility'>
                                        <option value='<?php echo $t['mobility']?>'>
                                            <?php if($t['mobility'] == 'W'){echo 'Walking';}elseif($t['mobility'] == 'WA'){echo 'Walking Assisted';}else{echo 'Strecher';}?>
                                        </option>
                                        <option value='W'>Walking( W )</option>
                                        <option value='WA'>Walking Assisted( WA )</option>
                                        <option value='S'>Stretcher( S )</option>
                                    </select>
                                </div>
                                <?php } else {
                            if ( $t['moving'] == 1 )
                            $ymov = 'active';
                            else if ( $t['moving'] == 0 )
                            $nmov = 'active';
                            ?>
                                <div class='col-5'>
                                    <label for='pwd'>Moving normaly for ages: </label>
                                    <select class='form-control' name='moving'>
                                        <option value='1'>Yes</option>
                                        <option value='0'>No</option>
                                    </select>
                                    <?php
                        }
                        ?>
                                </div>

                            </div>
                            <?php
                        if ( $age<12 ) {
                            ?>
                            <div class='row'>
                                <div class='col-4'>
                                    <label for='pwd'>Length: </label>
                                    <input type='text' name='length' class='form-control'
                                        value="<?php echo $t['length'];?>" id='pwd' placeholder='Enter Length'>
                                </div>

                                <div class='col-4'>
                                    <label for='pwd'>Malnourished </label>

                                    <?php
                            if ( $t['malnutritioned'] == 'N' )
                            $nmal = 'active';
                            else if ( $t['malnutritioned'] == 'M' )
                            $mmal = 'active';
                            else if ( $t['malnutritioned'] == 'S' )
                            $smal = 'active';
                            ?>
                                    <select class='form-control' name='malnou'>
                                        <option value='Y'>Yes</option>
                                        <option value='M'>Moderate</option>
                                        <option value='S'>Severe</option>
                                    </select>
                                </div>
                                <?php }
                            ?>
                            </div>

                        </fieldset>

                        <?php if ( $t['patientTriageStatus'] == 0 && $t['onBooking'] == 1 ) {
                                ?>
                        <div class='row'>
                            <div style='margin-left:80%;margin-bottom:10px;'>
                                <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                                <input type='hidden' name='visitNo' value="<?php echo $vt;?>">
                                <input type='hidden' name='age' value="<?php echo $age; ?>">
                                <input type='hidden' name='action_type' value='add' />
                                <input type='submit' name='doUpdate' value='save' class='btn btn-info'>
                            </div>
                        </div>
            </div>
        </div>
        <?php
        }else if ( $t['patientTriageStatus'] == 0 && $t['onBooking'] == 1 ) {?>
        <div class='row'>
            <div style='margin-left:80%;margin-bottom:10px;'>
                <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                <input type='hidden' name='visitNo' value="<?php echo $vt;?>">
                <input type='hidden' name='age' value="<?php echo $age; ?>">
                <input type='hidden' name='action_type' value='updateScoreBooking' />
                <input type='submit' name='doUpdate' value='Update Score' class='btn btn-info'>
            </div>
        </div>
    </div>
</div>

<?php }else if ( $t['patientTriageStatus'] == 1 ) {?>
<div class='row'>
    <div style='margin-left:80%;margin-bottom:10px;'>
        <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
        <input type='hidden' name='visitNo' value="<?php echo $vt;?>">
        <input type='hidden' name='age' value="<?php echo $age; ?>">
        <input type='hidden' name='action_type' value='add' />
        <input type='submit' name='doUpdate' value='Update Score' class='btn btn-info'>
    </div>
</div>
</div>
</div>
<?php } elseif ( $t['patientTriageStatus'] == 0 ) {
?>

<div class='row'>
    <div style='margin-left:80%;margin-bottom:10px;'>
        <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
        <input type='hidden' name='visitNo' value="<?php echo $vt;?>">
        <input type='hidden' name='age' value="<?php echo $age; ?>">
        <input type='hidden' name='action_type' value='updateScore' />
        <input type='submit' name='doUpdate' value='Calculate Score' class='btn btn-info'>
    </div>
</div>
</div>
</div>
<?php

    }
    ?>
</form>

<!-- </div>
                                </div> -->
<!-- End of Personal Information-->
<?php if ( $t['patientTriageStatus'] == 1  && $t['onBooking'] == 0 ) {
                                    ?>
<form method='post' action='action_finalizescore.php' role='form'>
    <section id='basic-listgroup'>
        <div class='row match-height'>
            <div class='col-lg-6 col-md-12'>
                <div class='card'>
                    <div class='card-header'>
                        <h3 class='box-title'>Score Information</h3>
                    </div>
                    <div class='card-content collapse show'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-6'>
                                    <label>Score</label>
                                    <?php
                                    if ( $score >= 6 ) {
                                        $sign = "<div class='alert alert-danger'>
                                                <strong>Transfer to ER!</strong>
                                            </div>";
                                        ?>
                                    <div class='alert alert-danger'>
                                        <strong><?php echo $score;
                                        ?>-RED</strong>
                                    </div>
                                    <?php
                                    } else if ( $score >= 3 ) {
                                        $sign = "<div class='alert alert-warning'>
                                                <strong>Routine</strong>
                                            </div>";
                                        ?>
                                    <div class='alert alert-warning'>
                                        <strong><?php echo $score;
                                        ?>-Orange!</strong>
                                    </div>
                                    <?php
                                    } else {
                                        $sign = "<div class='alert alert-success'>
                                                <strong>Routine</strong>
                                            </div>";
                                        ?>
                                    <div class='alert alert-success'>
                                        <strong><?php echo $score;
                                        ?>-Green!</strong>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class='col-6'>
                                    <label>Conclusion</label>
                                    <?php echo $sign;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</form>
<?php
$serviceCod=$_REQUEST['serviceCode'];
?>
<div class='col-lg-6 col-md-12'>
    <div class='card'>
        <div class='card-content collapse show'>
            <div class='card-body'>
                <form class='form' action='action_goto_doctor.php' method='POST'>
                    <h5>
                        <center> Appointment</center>
                    </h5>
                    <hr>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label>Service</label>
                            <input type='text' class='form-control' name='patientNo' readonly
                                value="<?php echo $db->getData('service','serviceName','serviceCode',$serviceCod);;?>">

                            <div class='row'>
                                <input type='hidden' name='patientNo' value="<?php echo $patientNo; ?>">
                                <input type='hidden' name='visitNo' value="<?php echo $vt; ?>">
                            </div>
                            <div class='form-actions'>
                                <button type='submit' class='btn btn-success' name='action_type' value='add'>
                                    <i class='la la-check-square-o'></i> Send to Doctor
                                </button>
                                <button type='button' class='btn btn-danger mr-1'>
                                    <i class='ft-x'></i> Cancel
                                </button>

                            </div>
                </form>
                <!-- </div>
                                        </div>
                                        </div>
                                        </div> -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
<?php } else {

                                        }
                                        ?>
<?php
                                    }
                                }
                            }
                            ?>
</div>
</div>
</div>
<!-- </div> -->