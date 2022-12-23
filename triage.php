<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#patientdata").DataTable({
        "processing": true,
        "paging": true,
        dom: 'Blfrtip',
        bLengthChange: true,
        "lengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 15,
        bInfo: false,
        "bAutoWidth": false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [
            [1, 'asc']
        ]
    });
});
</script>
<?php 
  $db=new DBHelper();
  
?>

<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-medkit font-large-2 success"></i> Triage Center</h2>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="pull-left">
                            <h3>List of Patients on Triage </h3>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="patientdata" class="table">
                            <thead>
                                <tr>
                                    <th>Patient No</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Address</th>
                                    <th>Visit No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                                  
                                                    // $patientNo=$_REQUEST['patientNo'];
                                                    // $vt=$_REQUEST['visitNo'];
                                                    // $triageStatus=$_REQUEST['triageStatus'];
                                                    // echo $triageStatus;     
                                                    $patients = $db->getPatientTriage();
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
                                                                $serviceCode=$patient['serviceCode'];
                                                                $visitNo = $db ->getData('patientvisit','visitNo','visitNo',$patient['patientNo']);
                                                                $visitNo = $patient['visitNo'];
                                                               
                                                                $name="$fname $mname $lname";
                                                           

                                                            ?>
                                <tr>
                                    <?php $age=$db->ageCalculator($dob);?>
                                    <td><?php echo $patientNo ;?></td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $age;?></td>
                                    <td><?php echo $sex;?></td>
                                    <td><?php echo $address;?></td>
                                    <td><?php echo $visitNo;?>
                                    <td>
                                        <a
                                            href="index3.php?sp=triageinfo&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>&serviceCode=<?php echo $serviceCode?>"><i
                                                class=" la la-medkit" title="Collect vital signs"></i></a>
                                    </td>
                                </tr>
                                <?php }}
                                                    
                                                ?>

                            </tbody>

                        </table>





                    </div>
                </div>
            </div>
        </div>
    </div>

</div>