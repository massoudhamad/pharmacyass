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
                <h2> <i class="la la-dashboard font-large-2 success"></i> Despencing</h2>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Hospital Info cards -->


        <!-- Appointment Bar Line Chart -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="" id='searchpp'>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="autocomplete">
                                            <label><br></label><input type="text" name="searchQuery" id="search" class="form-control" placeholder="Search Product" autocomplete="off" />
                                            <div id="autocomplete"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pull-left">
                                        <label><br></label>
                                        <input type="submit" name="doSearch" value="Search Patient" class="btn btn-info form-control" style="color:white;">

                                    </div>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Bar Line Chart Ends -->

    </div>
    <div class="card" style="margin-top:40px;">
        <div class="">
            <div class="col-lg-12">
                <?php
                $db=new DBhelper();
                if(isset($_POST['doSearch'])=="Search Patient")
                {
                    $searchText=$_POST['searchQuery'];
                    $search=$db->searchPatient($searchText);
                    if(!empty($search)){
                        ?>
                        <h3 style="margin-top:20px;margin-bottom:20px;">Search Result</h3>
                        <table id="example" class="table table-striped table-bordered table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th>Patient No.</th>
                                <th>Full Name</th>
                                <th>Sex</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Health Scheme</th>
                                <th>Add Visit</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                    $count = 0;
                    foreach($search as $patient)
                    {
                        $patientNo=$patient['patientNo'];
                        $fname=$patient['firstName'];
                        $mname=$patient['middleName'];
                        $lname=$patient['lastName'];
                        $dob=$patient['dob'];
                        $sex=$patient['sex'];
                        $address=$patient['address'];
                        $telNumber=$patient['telNumber'];
                        $healthSchemeID=$patient['paymenttypeCode'];
                        $name="$fname $mname $lname";
                        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$healthSchemeID);

                        $age= $db->ageCalculator($dob);
                        //$visitsStatus=$db->getVisitStatus($patientNo);
                        $visitsStatus=$db->getRows("patientvisit",array('where'=>array('patientNo'=>$patientNo,'visitStatus'=>0)));
                        if(!empty($visitsStatus))
                        {
                            $visitsButton = '
                                <div class="btn-group">
                                    <i class="fa fa-tasks" aria-hidden="true"></i>
                                </div>';
                        }
                        else
                        {
                            $visitsButton = '<div class="btn-group">
           <a href="index3.php?&sp=govisit&patientNo=' . $patientNo . '"><i class="la la-medkit" title="Go to Triage"></i></a>
           </div>';
                        }

       

                        $action="$visitsButton";


                        echo "<tr>
                    <td>$patientNo</td>
                    <td>$name</td>
                    <td>$sex</td>
                    <td>$age</td>
                    <td>$address</td>
                    <td>$telNumber</td>
                    <td>$healthScheme</td>
                    <td>$action</td>
                   
                    </tr>";
                    
                    }}else{ ?>
                     <h3 style="margin-top:20px;margin-bottom:20px;">Search Result</h3>
                    <?php
                      echo '<tr><td colspan="5">No Patient(s) found......</td></tr>';?>
                      <?php }?>
                    
                    </tbody>
                    </table>
                    
                    <?php
                }
                ?>
                </div>
            </div>

        <!--end of search result-->
            </div>
        </div>
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