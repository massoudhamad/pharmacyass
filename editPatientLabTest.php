<?php
$db = new DBHelper();
// $patientNo=$_GET['patientNo'];
$patientNo=$_REQUEST['patientNo'];
$visitNo=$_REQUEST['visitNo'];
$today = date("Y-m-d");
$hospitalCode = $_SESSION['hospitalCode'];
?>
<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
                        // if( $_SESSION['role_session']==10 || $_SESSION['role_session']=='UjAw'|| $_SESSION['role_session']=='UjA5')
                        if( $_SESSION['role_session']==10 || $_SESSION['role_session']=='7') {
                    ?>

<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="ft-edit" font="large"></i>Edit Patients Test</h2>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="col-md-12">

        <div class="card-body">

            <?php
             $db = new DBHelper();
            
            
            $patients = $db->getRows('patient',array('where'=>array('patientNo'=>$patientNo)));
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
                $fullName=$fname." ".$mname." ".$lname;
               

                
            }
        }
        ?>
            <table class="table table-striped table-bordered patients-list" id="example">
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
                        <td><?php echo $fullName = $fname." ".$mname." ".$lname;?></td>
                        <td><?php echo $db->ageCalculator($dob);?></td>
                        <td><?php echo $sex;?></td>
                        <td><?php echo $address;?></td>
                    </tr>

                </tbody>
            </table>
            <p><b>Patient History</b></p>
            <?php
            $checkclinical = $db->checkClinicalhistory($patientNo,$visitNo);
            foreach($checkclinical as $checkclinical){
                $clinicalHistory = $checkclinical['clinicalHistory'];
            }
            ?>
            <textarea class="form-control" readonly><?php echo $clinicalHistory?></textarea>
        </div>
        <br><br>

        <form name="" method="post" enctype="multipart/form-data" action="action_labTest.php">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">

                        <table id="example" class="table table-striped table-bordered table-condensed table-responsive">
                            <thead>
                                <tr>
                                    <th>Test No</th>
                                    <th>Test Name</th>
                                    <th>Order Date</th>
                                    <th>Doctors Details</th>
                                    <th style="width:100%">Add Result</th>
                                    <th>Upload Result</th>
                                    <th>Add Your Details</th>



                                </tr>

                            </thead>

                            <tbody>
                                <?php
                                                   $db=new DBhelper();
                                                    $checkLabTests = $db->getRows('patienttest',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo)));
                                                    // $patientvisit=$db->getPatientTestInfos($patientNo,$visitNo);

                                                    if(!empty($checkLabTests))
                                                
                                                        {
                                                            
                                                            $x=0;
                                                            foreach ($checkLabTests as $patient)
                                                            {
                                                                $x++;
                                                                $id=$patient['serviceID'];
                                                                $reportingDate=$patient['reportingDate'];
                                                                $testNo=$patient['testNo'];
                                                                $servicesID=$patient['servicesCode'];
                                                                $result=$patient['result'];
                                                             
                                                                
                                                            ?>
                                <tr>
                                    <td><?php echo $testNo?></td>
                                    <td><?php echo $db->getData("service","serviceName","serviceCode",$servicesID);?>
                                    </td>
                                    <td><?php echo $reportingDate?></td>
                                    <td>

                                        <?php 
                                                                
                                                                $checkDoctorDetails = $db->checkDoctorDetails($patientNo,$visitNo,$servicesID);
                                                                // print_r($checkDoctorDetails);
                                                                foreach($checkDoctorDetails as $checkclinical){
                                                                    $clinicalHistory = $checkclinical['doctorDetails'];
                                                                }
                                                                if($clinicalHistory){?>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle='modal'
                                            data-target="#zoomInRight<?php echo $servicesID;?>">View Details </button>
                                        <?php
                                                                }else{?>
                                        <button type="button" class="btn btn-primary btn-sm" disabled>View Details
                                        </button>
                                        <?php
                                                                }
                                                                ?>
                                    </td>
                                    <td style="width:100%"> <input class="form-control" value="<?php echo $result ?>"
                                            name="Description" required>
                                    </td>
                                    <td> <input type="file" name="fileToUpload" id="fileToUpload"></td>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle='modal'
                                            data-target="#zoomInRight<?php echo $testNo;?>"><i class="ft-plus"></i>
                                        </button></td>

                                </tr>

                                <div class='modal animated zoomInRight text-left' id="zoomInRight<?php echo $testNo;?>"
                                    tabindex='-1' aria-hidden='true'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h4 class='modal-title' id='myModalLabel72'> Lab Details</h4>
                                                <button type='button' class='close' data-dismiss='modal'
                                                    aria-label='Close'><span aria-hidden='true'>&times;
                                                    </span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>

                                                <div class='row'>
                                                    <div class='col-12'>
                                                        <div class='form-group'>
                                                            <label for='courseCode'>Test Name:</label>
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
                                                                <h3 class='box-title'>Description</h3>
                                                            </div>
                                                            <div class='box-body pad'>
                                                                <textarea class='textarea' name='description'
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
                                </div>



                                <div class='modal animated zoomInRight text-left'
                                    id="zoomInRight<?php echo $servicesID;?>" tabindex='-1' aria-hidden='true'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h4 class='modal-title' id='myModalLabel72'>Lab Test Doctor Details</h4>
                                                <button type='button' class='close' data-dismiss='modal'
                                                    aria-label='Close'><span aria-hidden='true'>&times;
                                                    </span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>

                                                <div class='row'>
                                                    <div class='col-12'>
                                                        <form action="action_update_extraDetails.php" method="POST">
                                                            <div class='form-group'>
                                                                <label for='courseCode'>Test Name:</label>
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
                                                                <?php
                                                                                        $checkDoctorDetails = $db->checkDoctorDetails($patientNo,$visitNo,$servicesID);
                                                                                        // print_r($checkDoctorDetails);
                                                                                        foreach($checkDoctorDetails as $checkclinical){
                                                                                            $clinicalHistory = $checkclinical['doctorDetails'];
                                                                                        }
                                                                                        ?>
                                                                <textarea required class='textarea' name='doctorDetails'
                                                                    style='width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
                                                                    readonly><?php echo  $clinicalHistory?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn grey btn-outline-secondary'
                                                                data-dismiss='modal'>Close</button>
                                                            <input type="hidden" name="testNo"
                                                                value="<?php echo $testNo?>">
                                                            <input type="hidden" name="patientNo"
                                                                value="<?php echo $patientNo?>">
                                                            <input type="hidden" name="visitNo"
                                                                value="<?php echo $visitNo?>">
                                                            <!-- <button type='submit' name ="submit" class='btn btn-primary'>Save</button> -->

                                                        </div>
                                                    </div>
        </form>
    </div>
</div>
</div>
</div>

<?php 
                                                                } }else{ ?>
<tr>
    <td colspan="5">No Patient(s) found......</td>
</tr>
<?php }}?>

</tbody>

</table>
</div>
<div class="row">

    <div class="col-lg-12"></div>
    <input type="hidden" name="patientNo" value="<?php echo $patientNo;?>">
    <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>">
    <input type="hidden" name="testNo" value="<?php echo $testNo;?>">
    <input type="hidden" name="serviceID" value="<?php echo $servicesID;?>">
    <!-- <input type="" name="Doc" value="<?php echo $_SESSION['userID'];?>">  -->

    <div class="col-lg-2">
        <input type="hidden" name="action_type" value="add" />
        <input type="submit" name="doUpdate" value="Save Records" class="btn btn-info form-control" style="color:white">
    </div>


</div>
</div>
</div>

</form>

<?php
                            
                            ?>
<br>


</div>

</div>
</div>


<?php
                                          
?>