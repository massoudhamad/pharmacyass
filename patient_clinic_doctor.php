<?php
$today = date("Y-m-d");
$month = date("m");
$userID = $_SESSION['user_session'];
?>

<!-- doctor -->
<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-medkit font-large-2 success"></i>Patient Management</h2>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="la la-stethoscope font-large-2 warning"></i>

                                </div>
                                <div class="media-body text-right">
                                    <h5 class="text-muted text-bold-500">Patient on que</h5>
                                    <h3 class="text-bold-600"><?php echo $db->PatientOnQue($today)?></h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="la la-user-md font-large-2 success"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h5 class="text-muted text-bold-500">Patient Attended Today</h5>
                                    <h3 class="text-bold-600"><?php echo $db->patientTodayAttended($today,$userID)?>
                                    </h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="la la-calendar-check-o font-large-2 info"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h5 class="text-muted text-bold-500">Patients Attended this week</h5>
                                    <h3 class="text-bold-600"><?php echo $db->getPatientWeeklyAppointment($userID)?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="la la-users font-large-2 danger"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h5 class="text-muted text-bold-500">Patients Attended this Month</h5>
                                    <h3 class="text-bold-600">
                                        <?php echo $db->getPatientMontlyAppointment($month,$userID);?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- head -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header">
                            <?php
                                    $db=new DBhelper();
                                    $doctorClinic=$db->getRows("doctor_category",array('where'=>array('doctorID'=>$_SESSION['user_session'],'status'=>1)));
                                    if(!empty($doctorClinic))
                                    {
                                        foreach($doctorClinic as $dc)
                                        {
                                            $categoryID=$dc['categoryID'];
                                            echo "List of Patients at ".$db->getData("servicecategory","categoryName","categoryID",$categoryID);
                                        }
                                    }
                                    /*else
                                    {
                                        echo "Please use button to Select your Clinic";
                                    }*/
                                 ?>

                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <table class="table" id="patientdata" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Patient No</th>
                                        <th>Full Name</th>
                                        <th>Sex</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <!-- <th>Visit No.</th> -->
                                        <th>Status</th>
                                        <th>Triage Result</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $x=0;
                                    $hospitalCode=$_SESSION['hospitalCode'];
                                    $userID=$_SESSION['user_session'];

                                                   
                                                $patients = $db->getPatientDoctorChecked($userID); 
                                                 if(!empty($patients))
                                                    {
                                                        
                                                       
                                                        foreach ($patients as $patient)
                                                        {
                                                            $x++;
                                                            $patientNo=$patient['patientNo'];
                                                            $firstName=$patient['firstName'];
                                                            $middleName=$patient['middleName'];
                                                            $lastName=$patient['lastName'];
                                                            $sex=$patient['sex'];
                                                            $age=$patient['dob'];
                                                            $Address=$patient['address'];
                                                            $phone=$patient['telNumber'];
                                                            $score=$patient['score'];
                                                            $doctorServiceStatus=$patient['doctorServiceStatus'];
                                                            //$visitNo = $db->getData('patientvisit','visitNo','visitNo',$patient['visitNo']);
                                                            $visitNo = $patient['visitNo'];
                                                            //$visitStatus = $db ->getData('patientvisit','visitStatus','visitStatus',$patient['visitStatus']);
                                                           // echo $visitNo;
                                                        ?>
                                    <tr>
                                        <td><?php echo $x?></td>
                                        <td><?php echo $patientNo?></td>
                                        <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName?></td>
                                        <td><?php echo $sex?></td>
                                        <td><?php echo $db->ageCalculator($age); ?></td>
                                        <td><?php echo $Address?></td>
                                        <td><?php echo $phone?></td>
                                        <!-- <td><?php echo $doctorServiceStatus?></td> -->
                                        <!-- <td>
                                            <?php echo $visitNo ?>
                                        </td> -->
                                        <td>
                                            <?php  if($doctorServiceStatus == 0){echo '<i class="badge badge-success">PENDING</i>';}else if($doctorServiceStatus == 1){echo '<i class="badge badge-warning">IN PROGRESS</i>';}else{echo '<i class="badge badge-primary">Done</i>';}?>
                                        </td>
                                        <td>
                                            <?php  if($score >= 6){echo '<i class="badge badge-danger">RED</i>';}elseif($score >= 3){echo '<i class="badge badge-warning">ORANGE</i>';}elseif($score = " "){echo 'N/A';}else{echo '<i class="badge badge-success">Routine</>';}?>
                                        </td>
                                        <td>
                                            <a
                                                href="changeDoctorStatus.php?patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>"><i
                                                    class="la la-medkit"></i></a>
                                        </td>

                                    </tr>
                                    <?php }}?>

                                    <?php
                                     $x=0;
                                    $hospitalCode=$_SESSION['hospitalCode'];
                                    $userID=$_SESSION['user_session'];

                                                   
                                                $patients = $db->getPatientDoctorCheckedWithoutTriage($userID); 
                                                 if(!empty($patients))
                                                    {
                                                        
                                                       
                                                        foreach ($patients as $patient)
                                                        {
                                                            $x++;
                                                            $patientNo=$patient['patientNo'];
                                                            $firstName=$patient['firstName'];
                                                            $middleName=$patient['middleName'];
                                                            $lastName=$patient['lastName'];
                                                            $sex=$patient['sex'];
                                                            $age=$patient['dob'];
                                                            $Address=$patient['address'];
                                                            $phone=$patient['telNumber'];
                                                            $score=$patient['score'];
                                                            $doctorServiceStatus=$patient['doctorServiceStatus'];
                                                            //$visitNo = $db->getData('patientvisit','visitNo','visitNo',$patient['visitNo']);
                                                            $visitNo = $patient['visitNo'];
                                                            //$visitStatus = $db ->getData('patientvisit','visitStatus','visitStatus',$patient['visitStatus']);
                                                           // echo $visitNo;
                                                        ?>
                                    <tr>
                                        <td><?php echo $x?></td>
                                        <td><?php echo $patientNo?></td>
                                        <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName?></td>
                                        <td><?php echo $sex?></td>
                                        <td><?php echo $db->ageCalculator($age); ?></td>
                                        <td><?php echo $Address?></td>
                                        <td><?php echo $phone?></td>


                                        <!-- <td>
                                            <?php echo $visitNo ?>
                                        </td> -->
                                        <td>
                                            <?php  if($doctorServiceStatus == 0){echo '<i class="badge badge-success">PENDING</i>';}else if($doctorServiceStatus == 1){echo '<i class="badge badge-warning">IN PROGRESS</i>';}else{echo '<i class="badge badge-primary">Done</i>';}?>
                                        </td>
                                        <td>
                                            <?php  if($score >= 6){echo '<i class="badge badge-danger">RED</i>';}elseif($score >= 3){echo '<i class="badge badge-warning">ORANGE</i>';}elseif($score = " "){echo 'N/A';}else{echo '<i class="badge badge-success">Routine</>';}?>
                                        </td>
                                        <td>
                                            <a
                                                href="index3.php?sp=consultation&patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>"><i
                                                    class="la la-medkit"></i></a>
                                        </td>

                                    </tr>
                                    <?php }}?>

                                    <?php
                                    
                                    $hospitalCode=$_SESSION['hospitalCode'];
                                    $userID=$_SESSION['user_session'];

                                                   
                                                $patients = $db->getPatientDoctor(); 
                                                 if(!empty($patients))
                                                    {
                                                        
                                                       
                                                        foreach ($patients as $patient)
                                                        {
                                                            $x++;
                                                            $patientNo=$patient['patientNo'];
                                                            $firstName=$patient['firstName'];
                                                            $middleName=$patient['middleName'];
                                                            $lastName=$patient['lastName'];
                                                            $sex=$patient['sex'];
                                                            $age=$patient['dob'];
                                                            $Address=$patient['address'];
                                                            $phone=$patient['telNumber'];
                                                            $score=$patient['score'];
                                                            $doctorServiceStatus=$patient['doctorServiceStatus'];
                                                            //$visitNo = $db->getData('patientvisit','visitNo','visitNo',$patient['visitNo']);
                                                            $visitNo = $patient['visitNo'];
                                                            //$visitStatus = $db ->getData('patientvisit','visitStatus','visitStatus',$patient['visitStatus']);
                                                           // echo $visitNo;
                                                        ?>
                                    <tr>
                                        <td><?php echo $x?></td>
                                        <td><?php echo $patientNo?></td>
                                        <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName?></td>
                                        <td><?php echo $sex?></td>
                                        <td><?php echo $db->ageCalculator($age); ?></td>
                                        <td><?php echo $Address?></td>
                                        <td><?php echo $phone?></td>
                                        <!-- <td>
                                            <?php echo $visitNo ?>
                                        </td> -->
                                        <td>
                                            <?php  if($doctorServiceStatus == 0){echo '<i class="badge badge-success">PENDING</i>';}else if($doctorServiceStatus == 1){echo '<i class="badge badge-warning">IN PROGRESS</i>';}else{echo '<i class="badge badge-primary">Done</i>';}?>
                                        </td>
                                        <td>
                                            <?php  if($score >= 6){echo '<i class="badge badge-danger">RED</i>';}elseif($score >= 3){echo '<i class="badge badge-warning">ORANGE</i>';}elseif($score = " "){echo 'N/A';}else{echo '<i class="badge badge-success">Routine</>';}?>
                                        </td>
                                        <td>
                                            <a
                                                href="action_checkin.php?patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>&doctorID=<?php echo $userID?>"><i
                                                    class="la la-medkit"></i></a>
                                        </td>

                                    </tr>

                                    <?php }}?>


                                    <?php
                                    
                                   

                                                   
                                                $patients = $db->getPatientDoctorWithoutTriage(); 
                                                 if(!empty($patients))
                                                    {
                                                        
                                                       
                                                        foreach ($patients as $patient)
                                                        {
                                                            $x++;
                                                            $patientNo=$patient['patientNo'];
                                                            $firstName=$patient['firstName'];
                                                            $middleName=$patient['middleName'];
                                                            $lastName=$patient['lastName'];
                                                            $sex=$patient['sex'];
                                                            $age=$patient['dob'];
                                                            $Address=$patient['address'];
                                                            $phone=$patient['telNumber'];
                                                            $score=$patient['score'];
                                                            $doctorServiceStatus=$patient['doctorServiceStatus'];
                                                            //$visitNo = $db->getData('patientvisit','visitNo','visitNo',$patient['visitNo']);
                                                            $visitNo = $patient['visitNo'];
                                                            //$visitStatus = $db ->getData('patientvisit','visitStatus','visitStatus',$patient['visitStatus']);
                                                           // echo $visitNo;
                                                        ?>
                                    <tr>
                                        <td><?php echo $x?></td>
                                        <td><?php echo $patientNo?></td>
                                        <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName?></td>
                                        <td><?php echo $sex?></td>
                                        <td><?php echo $db->ageCalculator($age); ?></td>
                                        <td><?php echo $Address?></td>
                                        <td><?php echo $phone?></td>
                                        <!-- <td>
                                            <?php echo $visitNo ?>
                                        </td> -->
                                        <td>
                                            <?php  if($doctorServiceStatus == 0){echo '<i class="badge badge-success">PENDING</i>';}else if($doctorServiceStatus == 1){echo '<i class="badge badge-warning">IN PROGRESS</i>';}else{echo '<i class="badge badge-primary">Done</i>';}?>
                                        </td>
                                        <td>
                                            <?php  if($score >= 6){echo '<i class="badge badge-danger">RED</i>';}elseif($score >= 3){echo '<i class="badge badge-warning">ORANGE</i>';}elseif($score = " "){echo 'N/A';}else{echo '<i class="badge badge-success">Routine</>';}?>
                                        </td>
                                        <td>
                                            <a
                                                href="action_checkin.php?patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>&doctorID=<?php echo $userID?>"><i
                                                    class="la la-medkit"></i></a>
                                        </td>

                                    </tr>

                                    <?php }}?>



                                </tbody>

                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>