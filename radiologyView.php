<?php
$db = new DBHelper();
$patientNo = $_REQUEST['patientNo'];
// $visitNo = $_REQUEST['visitNo'];
$today = date( 'Y-m-d' );
$hospitalCode = $_SESSION['hospitalCode'];
?>
<script src='Scripts/jquery-1.10.2.min.js' type='text/javascript'></script>
<link rel='stylesheet' href='bootstrap/css/bootstrap.min.css'>
<?php
if ( $_SESSION['role_session'] == '6' |$_SESSION['role_session'] == '1' ) {
    ?>
<br>
<div class='content-wrapper'>
    <div class='content-header row mb-1'>
        <div class='col-12'>
            <div class='card-header'>
                <h2> <i class='fa fa-thermometer'></i>List of Radiology Patients</h2>
            </div>
        </div>
    </div>
</div>

<div class='col-md-12'>
    <div class='card'>
        <div class='card-body'>
            <div class="row">


                <?php

    $visitNo = $_REQUEST['visitNo'];
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
            $fullName = $fname.' '.$mname.' '.$lname;

        }
    }
    ?>
                <table class='table table-striped table-bordered patients-list' id='example'>
                    <thead>
                        <tr>
                            <th>Patient No</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Address</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $patientNo;?></td>
                            <td><?php echo $fullName = $fname.' '.$mname.' '.$lname;?></td>
                            <td><?php echo $db->ageCalculator( $dob );?></td>
                            <td><?php echo $sex;?></td>
                            <td><?php echo $address;?></td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><b>Patient History</b></p>
            <?php
            $checkclinical = $db->checkClinicalhistory($patientNo,$visitNo);
            foreach($checkclinical as $checkclinical){
                $clinicalHistory = $checkclinical['clinicalHistory'];
            }
            ?>
            <textarea class="form-control" readonly><?php echo $clinicalHistory?></textarea>
        </div>
    </div>
    <br><br>

    <div class='row'>
        <div class='col-md-12'>
            <form name='' method='post' action='action_radiologyTest.php' enctype='multipart/form-data'>
                <div class='form-group'>

                    <table id='orderProcedure' class='table'>
                        <thead>
                            <tr>
                                <th>Test No</th>
                                <th>Test Name</th>
                                <th>Order Date</th>
                                <th>Upload Report</th>
                                <th>Prepare Report</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
    $patientvisit = $db->getPatientRadiologyInfo2( $patientNo, $visitNo );
    if ( !empty( $patientvisit ) ) {

        $x = 0;
        foreach ( $patientvisit as $patient ) {
            $x++;
            $testNo = $patient['testNo'];
            $serviceCode = $patient['servicesCode'];
            $reportingDate = $patient['reportingDate'];
            // $Result = $patient['Result'];
            // $Doc = $patient['Doc'];

            ?>
                            <tr>
                                <td><?php echo $testNo?></td>
                                <td><?php echo $db->getData( 'service', 'serviceName', 'serviceCode', $serviceCode );
            ?></td>
                                <td><?php echo $reportingDate?></td>
                                <td> <input type='file' name='fileToUpload' id='fileToUpload'>
                                    <!-- <td><a type = 'button'   class = 'btn mr-1 mb-1 btn-info btn-sm' href = "index3.php?sp=labTestView&patientNo=<?php echo $db->my_simple_crypt($patientNo,'e')?>"><i class = 'la la-upload' title = 'Upload Report'></i></a> </td> -->
                                    <!-- <?php echo $testNo;?> -->
                                <td><a class='btn btn-info' data-toggle='modal'
                                        data-target="#zoomInRight<?php echo $testNo;?>"><i class='la la-book'
                                            title='Prepare Report'></i></a> </td>

                            </tr>
                            <div class='modal animated zoomInRight text-left' id="zoomInRight<?php echo $testNo;?>"
                                tabindex='-1' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h4 class='modal-title' id='myModalLabel72'> Patient Report</h4>
                                            <button type='button' class='close' data-dismiss='modal'
                                                aria-label='Close'><span aria-hidden='true'>&times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>

                                            <!-- <div class = 'row'>
            <div class = 'col-lg-12'>
            <div class = 'form-group'>
            <label for = 'courseCode'>Category Name:</label>

            </div>
            </div>
            </div> -->
                                            <div class='row'>
                                                <div class='col-12'>
                                                    <div class='form-group'>
                                                        <label for='courseCode'>Test Name:</label>
                                                        <input type='text' readonly
                                                            value="<?php echo $db->getData('service','serviceName','serviceCode',$serviceCode); ?>"
                                                            name='name' placeholder='Eg. Procedure'
                                                            class='form-control' />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-12'>
                                                    <div class='box'>
                                                        <div class='box-header'>
                                                            <h3 class='box-title'>Description</h3>
                                                        </div>
                                                        <div class='box-body pad'>
                                                            <textarea class='textarea' name='labDetails'
                                                                style='width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn grey btn-outline-secondary'
                                                            data-dismiss='modal'>Close</button>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
        }
    }
    ?>
                        </tbody>
                    </table>

                    <div class='row'>

                        <div class='col-lg-12'></div>
                        <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                        <input type='hidden' name='testNo' value="<?php echo $testNo;?>">
                        <input type='hidden' name='visitNo' value="<?php echo $visitNo;?>">
                        <input type='hidden' name='serviceID' value="<?php echo $serviceCode;?>">

                        <div class='col-lg-2'>
                            <input type='hidden' name='action_type' value='add' />
                            <input type='submit' name='doUpdate' value='Save Records' class='btn btn-info form-control'
                                style='color:white'>
                        </div>
            </form>

        </div>
    </div>
</div>

<br>

</div>

</div>
<?php
}
?>