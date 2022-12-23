<?php
$db = new DBHelper();
$today = date( 'Y-m-d' );
$hospitalCode = $_SESSION['hospitalCode'];
?>
<script src='Scripts/jquery-1.10.2.min.js' type='text/javascript'></script>
<link rel='stylesheet' href='bootstrap/css/bootstrap.min.css'>
<?php
if ( $_SESSION['role_session'] == '6'  ) {
    ?>
<div class='content-wrapper'>
    <div class='content-header row mb-1'>
        <div class='col-12'>
            <div class='card-header'>
                <h2> <i class='la la-user-plus font-large-2 success'></i>Radiology Services</h2>
            </div>
        </div>
    </div>

    <!-- Appointment Bar Line Chart -->
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-header'>
                    <h4 class='card-header'>List of Radiology Patients</h4>
                    <section id='add-patient'>

                    </section>
                    <a class='heading-elements-toggle'><i class='la la-ellipsis-v font-medium-3'></i></a>
                    <div class='heading-elements'>

                    </div>
                </div>
                <div class='card-content collapse show'>
                    <div class='card-body'>
                        <table class='table' id='patientdata' cellspacing='0' width='100%'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Date</th>
                                    <th>Patient No
                                    <th>Patient Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    $db = new DBhelper();
    //    $patientvisit = $db->getRows( 'patienttest', array( 'where'=>array( 'visitNo'=>$visitNo, 'patientNo'=>$patientNo ), 'order_by'=>'testNo DESC' ) );
    //  if ( !empty( $patients ) )
    $patientvisit = $db->getPatientRadiologyInfo();
    if ( !empty( $patientvisit ) ) {

        $x = 0;
        foreach ( $patientvisit as $patient ) {
            $x++;

            $reportingDate = $patient['reportingDate'];
            //$fName = $$patient['$fName'];
            $patientNo = $patient['patientNo'];

            $firstName = $patient['firstName'];
            $middleName = $patient['middleName'];
            $lastName = $patient['lastName'];
            $visitNo = $patient['visitNo'];
            // $testNo = $patient['testNo'];
            $servicesID = $patient['servicesCode'];
            //$categoryID = $patient['categoryID'];
            //$testStatus = $patient['testStatus'];

            ?>
                                <tr>

                                    <td><?php echo $x?></td>
                                    <td><?php echo $reportingDate?></td>
                                    <td><?php echo $patientNo?></td>
                                    <td><?php echo $fullName = $firstName.' '.$middleName.' '.$lastName;
            ?></td>
                                    <td>
                                        <a type='button' class='btn mr-1 mb-1 btn-info btn-sm'
                                            href="index3.php?sp=radiologyView&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"><i
                                                class='ft-thermometer' title='View'></i></a>
                                    </td>

                                </tr>
                                <?php }
        } else {
            ?>
                                <tr>
                                    <td colspan='5'>No Patient( s ) found......</td>
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
</div>
</div>