<?php

$db = new DBHelper();
$today = date("Y-m-d");

?>

<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
                        if($_SESSION['role_session']=='8' | $_SESSION['role_session']=='9' | $_SESSION['role_session']=='UjA3') {
                    ?>
<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-plus-square font-large-2 success"></i>Internal Despency</h2>
            </div>
        </div>
    </div>
    <!-- Hospital Info cards Ends -->

    <!-- Appointment Bar Line Chart -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header">Internal Despency</h4>
                    <section id="add-patient">

                    </section>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">

                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table" id="patientdata" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Patient No</th>
                                    <th>Visit No.</th>
                                    <th>Full Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Health Scheme</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                   $patients = $db->GetInternalDespency($today); 
                                                 if(!empty($patients))
                                                    {
                                                        
                                                        $x=0;
                                                        foreach ($patients as $patient)
                                                        {
                                                            $x++;
                                                            $patientNo=$patient['patientNo'];
                                                            $firstName=$patient['firstName'];
                                                            $middleName=$patient['middleName'];
                                                            $lastName=$patient['lastName'];
                                                            //$sex=$patient['sex'];
                                                            $age=$patient['dob'];
                                                            $Address=$patient['address'];
                                                            $phone=$patient['telNumber'];
                                                            $paymenttypeCode=$patient['paymenttypeCode'];
                                                            $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCode);
                                                            $visitNo=$patient['visitNo'];
                                                            // $healthScheme= $db->getData('healthscheme','healthScheme','healthSchemeID',$healthSchemeID); 
                                                            $visitNo = $db->getData('patientvisit','visitNo','visitNo',$patient['visitNo']);
                                                            //$visitStatus = $db ->getData('patientvisit','visitStatus','visitStatus',$patient['visitStatus']);
                                                            
                                                        ?>
                                <tr>
                                    <td><?php echo $x?></td>
                                    <td><?php echo $patientNo?></td>
                                    <td><?php echo $visitNo?></td>
                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName?></td>
                                    <td><?php echo $db->ageCalculator($age); ?></td>
                                    <td><?php echo $Address; ?></td>
                                    <td><?php echo $healthScheme?></td>
                                    <td>
                                        <a type="button" title="View and Update Patient Information"
                                            class="btn mr-1 mb-1 btn-warning btn-sm"
                                            href="index3.php?sp=PatientDespency&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"><i
                                                class="ft-thermometer" title="View Patient Information"></i></a>
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

    <!-- Appointment Bar Line Chart Ends -->
    <?php } else { 
                    include "patient_clinic_doctor.php";
                }
                    ?>





    <!-- end doctor-->


    <script type="text/javascript">
    $(document).ready(function() {
        $("#patientdata").DataTable({
            "dom": 'Blfrtip',
            "paging": true,
            "buttons": [{
                    extend: 'excel',
                    title: 'List of all Register',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    }
                }, ,
                {
                    extend: 'print',
                    title: 'List of all Register',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Register',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    },

                }

            ],
            "order": []
        });
    });
    </script>

</div>
</div>
</div>