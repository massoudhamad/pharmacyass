<?php 
$pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.'))); // get file name from url and strip extension
?>
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

<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-phone font-large-2 success"></i>List of All Appointments</h2>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="col-md-3 pull-right">
                            <select name="App" id="App" class="form-control">
                                <option value="today">Today's Appointments</option>
                                <option value=''>All Appointments</option>
                            </select>
                        </div>

                    </div>
                    <div class="table-responsive" id="table2">
                        <table id="patientdata" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th> Patient No</th> -->
                                    <th>FullName</th>
                                    <!-- <th>Clinic Name</th> -->
                                    <th>Doctor</th>
                                    <th>Service</th>
                                    <th>Time</th>
                                    <th>Phone Number</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                $db = new DBHelper();
                                                $today = date('Y-m-d');
                                                 $appointment = $db->getTodayAppointments($today);
                                               
                                                    {
                                                        $x=0;
                                                        foreach ($appointment as $apt)
                                                        {
                                                            $x++;
                                                            $patientNo=$apt['patientNo'];
                                                            $appointmentID=$apt['appointmentID'];
                                                            $firstName=$apt['firstName'];
                                                            $middleName=$apt['middleName'];
                                                            $lastName=$apt['lastName'];
                                                            $service=$apt['serviceCode'];
                                                            // $clinicCode=$apt['clinicName'];
                                                            $doctor=$apt['firstname']." ".$apt['middlename']." ".$apt['lastname'];
                                                            $date=$apt['aptDate'];
                                                            $time=$apt['time'];
                                                            // $visitNo=$apt['visitNo'];
                                                             $serviceName=$db->getData("service","serviceName"," serviceCode",$service);
                                                            $phone=$apt['tell'];
                                                         
                                                            
                                                            
                                                        ?>
                                <tr>
                                    <td><?php echo $x;?></td>
                                    <!-- <td><?php echo $patientNo;?></td> -->
                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName;?></td>
                                    <!-- <td><?php echo $clinicCode;?></td> -->
                                    <td><?php echo $doctor; ?></td>
                                    <td><?php echo $serviceName;?></td>
                                    <td><?php echo $time;?></td>
                                    <td><?php echo $phone;?></td>

                                    <td>
                                        <a title="View and Update Patient Information"
                                            href="index3.php?sp=booked_visit&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>&&serviceCode=<?php echo $db->my_simple_crypt($service,'e')?>&&Appdate=<?php echo $db->my_simple_crypt($date,'e')?>&"><i
                                                class="la la-medkit" title="Proceed To View Appointment"></i></a>
                                        
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
<script src="js/jquery-1.4.2.min.js"></script>


 

<script type="text/javascript">
$(document).ready(function() {
    $("#App").change(function() {
        var date = $(this).val();
        var dataString = 'date=' + date;
        //alert(dataString);
        $.ajax({
            type: 'POST',
            url: "ajax_today_appointment.php",
            data: dataString,
            cache: false,
            success: function(data) {
                // window.location="ajax_day.php";
                //alert(data);
                $("#table2").html(data);
            }
        });
    });
});
</script>