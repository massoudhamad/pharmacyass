<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#patientdata").DataTable({
            dom: 'Blfrtip',
            paging:true,
            buttons:[
                {
                    extend:'excel',
                    title: 'List of all Appointment',
                    footer:false,
                    exportOptions:{
                        columns: [0, 1, 2, 3,5,6,7]
                    }
                },
                ,
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Appointment',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3,5,6,7]
                    },

                }

            ],
            order: []
        });
    });
</script>
<?php
 $db = new DBHelper();
$doctor = $_REQUEST['employeeId'];
?>

<div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-phone font-large-2 success"></i>Reschedule  Appointments</h2>
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
                                    <table  id="patientdata" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th> Patient No</th>
                                                    <th> Patient FullName</th>
                                                    <th>Clinic Name</th>
                                                    <th>Service</th>
                                                    <th>Time</th>
                                                    <th>Phone Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                               
                                                $appointment = $db->getAppoitmentReschedule($doctor);
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
                                                            $clinicCode=$apt['clinicName'];
                                                            $doctor=$apt['firstname']." ".$apt['middlename']." ".$apt['lastname'];
                                                            $date=$apt['aptDate'];
                                                            $time=$apt['time'];
                                                           // $Address=$apt['address'];
                                                            $phone=$apt['tell'];
                                                         
                                                            
                                                            
                                                        ?>
                                                <tr>
                                                    <td><?php echo $x;?></td>
                                                    <td><?php echo $patientNo;?></td>
                                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName;?></td>
                                                    <td><?php echo $clinicCode;?></td>
                                                    <!-- <td><?php echo $doctor; ?></td> -->
                                                    <td><?php echo $service;?></td>
                                                    <td><?php echo $time;?></td>
                                                    <td><?php echo $phone;?></td>
                                                   
                                                    <td>
                                                        <a type="button" title="View and Update Patient Information" class="btn mr-1 mb-1 btn-warning btn-sm" href="index3.php?sp=AppoinmentProfile&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>"><i class="ft-eye" title="View Patient Information"></i></a>
                                                        <a type="button" class="btn mr-1 mb-1 btn-info btn-sm" title="Update Patient Appointment" href="index3.php?sp=edit_appointment&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>"><i class="ft-edit" ></i></a>
                                                        <a type="button" class="btn mr-1 mb-1 btn-danger btn-sm" title="Delete Patient Appointment" href="delete_Appointment.php?id=<?php echo $db->my_simple_crypt($patientNo,'e')?>"><i class="ft-trash" ></i></a>
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
                </div></div>

            </div>
       
    