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
<style>
#docApp label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}
.alertify-notifier .ajs-message.ajs-error{
    color: white;
}
.alertify-notifier .ajs-message.ajs-success{
    color: white;
}
</style>
  <script src="js/jquery-3.3.1.min.js"></script>
    <script src="alertifyjs/alertify.js"></script>
    <script src="alertifyjs/alertify.min.js"></script>
<?php 

session_start();
if($_SESSION['msg']){?>
    <script>
    alertify.set('notifier','position', 'bottom-right');
    alertify.success("Apointment Booked  Successfully");
    </script>
<?php
}
unset($_SESSION['msgg']);
?>



<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-phone font-large-2 success"></i>Today's Appointments</h2>
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
                                    <th> Patient No</th>
                                    <th>Name</th>
                                    <!-- <th>Clinic</th> -->
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Phone Number</th>
                                    <th>Doctor</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                             $db = new DBHelper();
                                               
                                               
                                                $today = date("Y-m-d");
                                                $appointment = $db-> getTodayAppointments($today);
                                                 //$visitNo=$db->my_simple_crypt($_GET['visitNo'],'d');
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
                                                            // $clinicCode=$apt['clinicName'];
                                                            $doctor=$apt['firstname']." ".$apt['middlename']." ".$apt['lastname'];
                                                            $date=$apt['aptDate'];
                                                            $serviceCode=$apt['serviceCode'];
                                                            $time=$apt['time'];
                                                            // $Address=$apt['address'];
                                                            $phone=$apt['tell'];
                                                         
                                                            
                                                            
                                                        ?>
                                <tr>
                                    <td><?php echo $x;?></td>
                                    <td><?php echo $patientNo;?></td>
                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName;?></td>
                                    <!-- <td><?php echo $clinicCode;?></td> -->
                                    <td><?php echo $date;?></td>
                                    <td><?php echo $time;?></td>
                                    <td><?php echo $phone;?></td>
                                    <td><?php echo $doctor; ?></td>

                                    <td>
                                        <div class="form-actions">
                                            <div class="col-md-6">
                                                <input type="hidden" name="action_type" value="addstaff" />
                                                <a title="View and Update Patient Information"
                                                    href="index3.php?sp=booked_visit&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>&&serviceCode=<?php echo $db->my_simple_crypt($serviceCode,'e')?>&&Appdate=<?php echo $db->my_simple_crypt($date,'e')?>"><i
                                                        class="la la-medkit" title="Proceed To Visit"></i></a>

                                            </div>
                                        </div>

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

<script type="text/javascript">
$(document).ready(function() {
    $(".add").click(function() {
        var patientNo = $(this).attr("id");
        var dataString = 'patientNo=' + patientNo;
        //alert(dataString);
        $.ajax({

            type: 'POST',
            url: "ajax_addvisit.php",
            data: dataString,
            cache: false,
            success: function(data) {
                alert(data);
                //window.location="aja.php";
                //console.log(data);

                $("").html(data);
            }
        });
    });
});
</script>