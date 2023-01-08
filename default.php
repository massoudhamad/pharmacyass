<link rel="stylesheet" href="sweet/dist/sweetalert.css">
<script src="sweet/dist/sweetalert.min.js"></script>
<?php

$db = new DBHelper();
$today = date("Y-m-d");
$month = date("m");
$userID = $_SESSION['user_session'];
$roleCode = $_SESSION['role'];

?>
<style>
    .main {
        width: 600px;
        margin: 0 auto;
    }

    .alertify-notifier .ajs-message.ajs-error {
        color: white;
    }

    .alertify-notifier .ajs-message.ajs-success {
        color: white;
    }
</style>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>

<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-dashboard font-large-2 success"></i> Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Hospital Info cards -->

        <?php
        if ($roleCode == 1) { ?>
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
                                        <h5 class="text-muted text-bold-500">All Staff</h5>
                                        <!-- <h3 class="text-bold-600"><?php echo $db->getTotalDoctors() ?></h3> -->
                                        <h3 class="text-bold-600">2</h3>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <a href="index3.php?sp=expiredProducts">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="la la-user-md font-large-2 success"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h5 class="text-muted text-bold-500">Expired Products</h5>
                                            <h3 class="text-bold-600"><?php echo $db->countExpiredItems($today) ?></h3>
                                            <!-- <h3 class="text-bold-600">450</h3> -->

                                        </div>
                                    </div>
                                </div>
                            </a>
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
                                        <h5 class="text-muted text-bold-500">No of Product Sold This Week</h5>
                                        <!-- <h3 class="text-bold-600"><?php echo $db->getTotalOtherStaffs() ?></h3> -->
                                        <h3 class="text-bold-600">450</h3>

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
                                        <h5 class="text-muted text-bold-500">Total Revenue This Month</h5>
                                        <!-- <h3 class="text-bold-600"><?php echo $db->getTotalPatient(); ?></h3> -->
                                        <h3 class="text-bold-600">34,000</h3>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hospital Info cards Ends -->

            <!-- Appointment Bar Line Chart -->
            <!-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header">List of Current Visits</h4>
                            <section id="add-patient">
                                <div class="pull-right" style="margin-right:40px">
                                    <a href="index3.php?sp=search_visited" class="btn btn-info  btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Register New Visit</a>
                                </div>
                            </section>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form name='default' action="action_close_visit.php" method="Post">
                                    <table class="table-responsive" id="patientdata" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Select</th>
                                                <th>Patient No</th>
                                                <th style="width:95%;">Patient Name</th>
                                                <th>Sex</th>
                                                <th>Age</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Payment Scheme</th>
                                                <th>Visit No.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $patients = $db->getCurrentVisits($today);
                                            if (!empty($patients)) {

                                                $x = 0;
                                                foreach ($patients as $patient) {
                                                    $x++;
                                                    $patientNo = $patient['patientNo'];
                                                    $firstName = $patient['firstName'];
                                                    $middleName = $patient['middleName'];
                                                    $lastName = $patient['lastName'];
                                                    $sex = $patient['sex'];
                                                    $age = $patient['dob'];
                                                    $Address = $patient['address'];
                                                    $phone = $patient['telNumber'];
                                                    $visitNo = $db->getData('patientvisit', 'visitNo', 'visitNo', $patient['visitNo']);
                                                    $healthSchemeID = $patient['paymenttypeCode'];
                                                    $healthScheme = $db->getData("paymenttype", "paymentTypeName", "paymenttypeCode", $healthSchemeID);

                                            ?>
                                                    <tr>
                                                        <td><?php echo $x ?></td>
                                                        <td><input type='checkbox' id='checky' class='checkbox_class' name='patientNo[]' value='<?php echo $patientNo; ?>'><input type='hidden' id='checky' class='checkbox_class' name='visitNo[]' value='<?php echo $visitNo; ?>'></td>
                                                        <td><?php echo $patientNo ?></td>
                                                        <td><?php echo $fullName = $firstName . " " . $middleName . " " . $lastName ?></td>
                                                        <td style="width:50px;"><?php echo $sex ?></td>
                                                        <td><?php echo $db->ageCalculator($age); ?></td>
                                                        <td><?php echo $Address ?></td>
                                                        <td><?php echo $phone ?></td>
                                                        <td><?php echo $healthScheme ?></td>
                                                        <td>
                                                            <?php echo $visitNo ?>
                                                        </td>
                                                        <td>
                                                            <a href="action_close_visit_individual.php?action_type=close&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"><i class="la la-sign-out" onclick="return confirm('Are you sure You want to Close Patient Visit?');" title="Discharge Patient"></i></a>
                                                            <a href="printcertificate.php?action=getPDF&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>" target="_blank"><i class="la la-print" title="Print"></i></a>
                                                        </td>


                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>

                                    </table>

                                    <div class="form-actions">
                                        <div class="col-md-6">
                                            <input type="hidden" name="action_type" value="checkout" />
                                            <input type="submit" name="doSubmit" onclick='return validateChecks()' id='submit' value="Discharge Patient" class="btn btn-primary">
                                        </div>
                                    </div>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div> -->
    </div>

<?php

        } elseif ($roleCode == 2) { ?>
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
                                <h5 class="text-muted text-bold-500">No of Product Sold Today</h5>
                                <!-- <h3 class="text-bold-600"><?php echo $db->getTotalDoctors() ?></h3> -->
                                <h3 class="text-bold-600">230</h3>

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
                                <h5 class="text-muted text-bold-500">Other Staff</h5>
                                <h3 class="text-bold-600"><?php echo $db->getTotalOtherStaffs() ?></h3>
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
                                <h5 class="text-muted text-bold-500">No. of Clinics</h5>
                                <h3 class="text-bold-600"><?php echo $db->getTotalVisit($today) ?></h3>
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
                                <h5 class="text-muted text-bold-500">Total Revenue</h5>
                                <h3 class="text-bold-600"><?php echo $db->getTotalPatient(); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hospital Info cards Ends -->

    <!-- Appointment Bar Line Chart -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header">List of Product below 10</h4>
                    <section id="add-patient">
                        <div class="pull-right" style="margin-right:40px">
                            <a href="index3.php?sp=search_visited" class="btn btn-info  btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Register New Visit</a>
                        </div>
                    </section>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form name='default' action="action_close_visit.php" method="Post">
                            <table class="table-responsive" id="patientdata" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th style="width:95%;">Patient Name</th>
                                        <th>Quantity in Store</th>
                                        <th>Expire Date</th>
                                        <th>Address</th>
                                        <th>Visit No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $patients = $db->getCurrentVisits($today);
                                    if (!empty($patients)) {

                                        $x = 0;
                                        foreach ($patients as $patient) {
                                            $x++;
                                            $patientNo = $patient['patientNo'];
                                            $firstName = $patient['firstName'];
                                            $middleName = $patient['middleName'];
                                            $lastName = $patient['lastName'];
                                            $sex = $patient['sex'];
                                            $age = $patient['dob'];
                                            $Address = $patient['address'];
                                            $phone = $patient['telNumber'];
                                            $visitNo = $db->getData('patientvisit', 'visitNo', 'visitNo', $patient['visitNo']);
                                            $healthSchemeID = $patient['paymenttypeCode'];
                                            $healthScheme = $db->getData("paymenttype", "paymentTypeName", "paymenttypeCode", $healthSchemeID);

                                    ?>
                                            <tr>
                                                <td><?php echo $x ?></td>
                                                <td><?php echo $patientNo ?></td>
                                                <td><?php echo $fullName = $firstName . " " . $middleName . " " . $lastName ?></td>
                                                <td style="width:50px;"><?php echo $sex ?></td>
                                                <td><?php echo $db->ageCalculator($age); ?></td>
                                                <td><?php echo $Address ?></td>

                                                <td>
                                                    <?php echo $visitNo ?>
                                                </td>
                                                <td>
                                                    <!-- <a
                                                    href="index3.php?sp=addvisit&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"><i
                                                        class="la la-medkit" title="Request Service"></i></a>  -->
                                                    <a href="action_close_visit_individual.php?action_type=close&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"><i class="la la-sign-out" onclick="return confirm('Are you sure You want to Close Patient Visit?');" title="Discharge Patient"></i></a>
                                                    <a href="printcertificate.php?action=getPDF&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>" target="_blank"><i class="la la-print" title="Print"></i></a>
                                                </td>


                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>

                            </table>

                            <div class="form-actions">
                                <div class="col-md-6">
                                    <input type="hidden" name="action_type" value="checkout" />
                                    <input type="submit" name="doSubmit" onclick='return validateChecks()' id='submit' value="Discharge Patient" class="btn btn-primary">
                                </div>
                            </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
        }
?>

<!-- Appointment Bar Line Chart Ends -->


</div>
</div>





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


<script type="text/javascript">
    $(document).ready(function() {
        $("#patientdata2").DataTable({
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#patient").DataTable({
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

<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function validateChecks() {
        var chks = document.getElementsByName('patientNo[]');
        var checkCount = 0;
        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                checkCount++;
            }
        }
        if (checkCount < 1) {
            alert('Please check atleast one patient.');
            return false;
        }
        return true;
    }
</script>
<script>
    $(function() {
        $('#loadservices').on('click', function() {
            $('.spinner-border').show();
            $('#loadservices').hide();
        });
    });
</script>