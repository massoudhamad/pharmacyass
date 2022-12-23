<?php

$db = new DBHelper();
$today = date("Y-m-d");
$month = date("m");
$week = date("W");
$userID = $_SESSION['user_session'];


?>


<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-phone font-large-2 success"></i>Appointments</h2>
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
                                    <h5 class="text-muted text-bold-500">Appointment Attended</h5>
                                    <h3 class="text-bold-600"><?php echo $db->TodayAttended($today)?></h3>
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
                                    <h5 class="text-muted text-bold-500">Appointment on que</h5>
                                    <h3 class="text-bold-600"><?php echo  $db->getAttended($today);?></h3>
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
                                    <h5 class="text-muted text-bold-500">Appointment this week</h5>
                                    <h3 class="text-bold-600"><?php echo $db->getWeeklyAppointment($week)?></h3>
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
                                    <h5 class="text-muted text-bold-500">Appointment this Month</h5>
                                    <h3 class="text-bold-600"><?php echo  $db->getMontlyAppointment($month,$userID);?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <!-- <div class="pull-right" style="margin-right:40px">
                                         <a href="index3.php?sp=add_patient" class="btn btn-info round btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Register Patient</a>
                                     </div> -->

                    </div>
                    <div class="table-responsive">
                        <table id="patientdata" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Name</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <!-- <th>Service</th> -->
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                $db = new DBHelper();
                                                //$userID =  $_SESSION['role_session'];
                                                $doctors = $db->getCurrentDoctor($userID);
                                                foreach ($doctors as $doctor){
                                                 $empID = $doctor['employeeId'];
                                                }
                                                $appointments = $db->getCurrentAppointments($empID,$today);
                                                //$db->getRegularConsultation($today);
                                                    {
                                                        $x=0;
                                                        foreach($appointments as $appointment)
                                                        {
                                                            $x++;
                                                            $firstName=$appointment['firstName'];
                                                            $middleName=$appointment['middleName'];
                                                            $lastName=$appointment['lastName'];
                                                            $clininCode=$appointment['clininCode'];
                                                            $serviceCode=$appointment['serviceCode'];
                                                            $aptDate=$appointment['aptDate'];
                                                            $time=$appointment['time'];
                                                            $doctor=$appointment['employeeId'];
                                                            $patientNo=$appointment['patientNo'];
                                                            $visitNo=$appointment['visitNo'];
                                                            $appStatus=$appointment['appStatus'];
                                                            $phone=$appointment['tell'];
                                                            
                                                        ?>
                                <tr>
                                    <td><?php echo $x;?></td>
                                    <!-- <td><?php echo $patientNo;?></td> -->
                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName;?></td>
                                    <td><?php echo $serviceCode=$db->getData("service","serviceName"," serviceCode",$serviceCode);?>
                                    </td>
                                    <td><?php echo $aptDate; ?></td>
                                    <!-- <td><?php echo $serviceCode=$db->getData("service","serviceName"," serviceCode",$serviceCode);?> -->
                                    </td>
                                    <td><?php echo $time;?></td>
                                    <!-- <td><?php echo $phone;?></td> -->

                                    <td>
                                        <a
                                            href="index3.php?sp=consultation&patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>&appDate=<?php echo $aptDate;?>&doctor=<?php echo $doctor;?>"><i
                                                class="la la-medkit"></i></a>
                                        <!-- <a type="button" class="btn  btn-info btn-sm" title="Update Patient Appointment" href="index3.php?sp=edit_appointment&id=<?php echo $db->my_simple_crypt($appointmentID,'e')?>"><i class="ft-edit" ></i></a> -->
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


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#patientdata").DataTable({
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