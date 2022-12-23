<style>
#doctor label.error {
    color: red;
    font-weight: bold;
}

.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#example1").DataTable({
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
<div class="content-wrapper">
    <div class="col-12">
        <div class="card-header">
            <h2> <i class="la la-user-plus font-large-2 info"></i> Register Patient Visit</h2>
        </div>
    </div>

    <br>
    <div>

        <div class="col-md-12">
            <h2>Patient Information</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                $db = new DBHelper();
                $auth_user = new DBHelper();
                // $patientNo=$db->my_simple_crypt($_GET['id'],'d');
                $serviceCode=$_REQUEST['serviceCode'];
                //$hospital_code=$_SESSION['hospitalCode'];
                $patientNo=$_REQUEST['patientNo'];
                $visitNo=$_REQUEST['visitNo'];
                //echo $patientNo;
                $patients = $db->getRows('patient',array('where'=>array('patientNo'=>$patientNo)));
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
                        $telNumber=$patient['telNumber'];
                        $name="$fname $mname $lname";
                        $paymenttypeCode=$patient['paymenttypeCode'];
                        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCode);
                        $visitStatus=$db->getData("patientvisit","visitStatus"," visitNo",$patientNo);

                ?>
                    <?PHP

                 $hospital = $db->getRows('hospital', array('order_by' => 'hospitalID ASC'));
                if(!empty($hospital))
                {
                  
                    foreach ($hospital as $hospital)
                    {
                       
                        $hospital_code = $hospital['hospitalCode'];
                       
                    }
                }
                ?>
                    <table class="table table-striped table-bordered patients-list" id="example">
                        <tr>
                            <th>Patient No</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Address</th>
                            <th>Health Scheme</th>
                        </tr>
                        <tr>
                            <td><?php echo $patientNo;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $db->ageCalculator($dob);?></td>
                            <td><?php echo $sex;?></td>
                            <td><?php echo $address;?></td>
                            <td><?php echo $healthScheme;?></td>

                            <!-- <?php
                                        if($visitStatus==0)
                                        {?>
                                        <td>
                                            <a href="action_close_visit.php?action_type=close&patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>" class="label label-success" onclick="return confirm('Are you sure You want to Close Patient Visit?');">Open</a></td>
                                        <?php }
                                        else
                                        {
                                        ?>
                                        <td><span class="label label-danger">Closed</span></td>
                                        <?php
                                          
                                        }
                                        ?> -->
                        </tr>
                        <?php
                                  $ageAtVisit =  $db->ageCalculator1($dob)
                                    ?>
                    </table>
                </div>
            </div>
        </div>


        <!-- end -->







        <div class="col-md-12">
            <h2>Appointment Information</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                $db = new DBHelper();
                $auth_user = new DBHelper();
                // $patientNo=$db->my_simple_crypt($_GET['id'],'d');
                $serviceCode=$_GET['serviceCode'];
                $date=$_REQUEST['date'];
                //$hospital_code=$_SESSION['hospitalCode'];
                $patientNo=$_REQUEST['patientNo'];
                // $visitNo=$db->my_simple_crypt($_GET['visitNo'],'d');
                //$visitNo=$_REQUEST['visitNo'];
                //echo $patientNo;
                 $today = date("Y-m-d");
                $patients = $db->getStaffAppointment($patientNo,$today);
                if(!empty($patients))
                {
                    $x=0;
                    foreach ($patients as $patient)
                    {
                        $x++;
                        $patientNo=$patient['patientNo'];
                        $fname=$patient['firstname'];
                        $mname=$patient['middlename'];
                        $lname=$patient['lastname'];
                         $serviceCode=$patient['serviceCode'];
                        $time=$patient['time'];
                        $doctorID=$patient['employeeId'];
                        $doctor="$fname $mname $lname";
                        $aptDate=$patient['aptDate'];
                        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCode);
                        $visitStatus=$db->getData("patientvisit","visitStatus"," visitNo",$patientNo);

                ?>
                    <table class="table table-striped table-bordered patients-list" id="example">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th> Service</th>
                            <th>Doctor</th>
                            <th>Change Doctor</th>
                            <!-- <th>Service Booked</th>
                                        <th>Health Scheme</th> -->
                        </tr>
                        <tr>
                            <td><?php echo $aptDate;?></td>
                            <td><?php echo $time;?></td>
                            <td><?php echo $serviceCodee=$db->getData("service","serviceName"," serviceCode",$serviceCode);?>
                            </td>
                            <td><?php echo $doctor;?></td>


                            <?php
                                        if($visitStatus==0)
                                        {?>
                            <td>
                                <a href="index3.php?sp=edit_appointment&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>"
                                    class="label label-success"
                                    onclick="return confirm('Are you sure You want to Change the Doctor?');"
                                    title="change Doctor"><i class='la la-edit'></a>
                            </td>
                            <?php }
                                        else
                                        {
                                        ?>
                            <td><span class="label label-danger">Closed</span></td>
                            <?php
                                          
                                        }
                                        ?>
                        </tr>
                        <?php
                                  $ageAtVisit =  $db->ageCalculator1($dob)
                                    ?>
                    </table>
                </div>
            </div>
        </div>


        <?php
                                        }}
                                        ?>

        </tbody>
        </table>
        <div class="container-fluid">
            <form name="register" id="register" method="post" action="action_patient_booked_service.php">
                <?php 
                                  
                                        if(empty($visitNo)){
                                            ?>
                <div class="row" style="margin-top:10px;">
                </div>
                <div class=" form-inline">
                    <label>Pass through Triage?</label>&nbsp; &nbsp;
                    <select name="triage" id='triage' class="form-control" required>
                        <option value='no'>No (Default)</option>
                        <option value="yes">Yes</option>

                    </select>
                </div>
        </div>
        <?php }?>
    </div>
    <br>

    <!-- <div class="col-lg-6 col-md-12" id='docAppoitment'>
                            <div class="card" id='doctorsAvailable'>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                   
                                            <h5><center>Book Appointment</center></h5>
                                            <hr>
                                                    <div class="col-md-10" id='doctorsAvailable'>
                                                        <label for='Available Doctor'>Available Doctor</label>
                                                        <select name="doctor"  class="form-control">
                                                        <option value='<?php echo $doctorID?> '><?php echo $doctor?></option>
                                                             <?php
                                                                $doctor = $db->getRows('users',array('where'=>array('roleCode'=>'UjA0'),'order_by'=>'username ASC'));
                                                                if(!empty($doctor)){
                                                                    echo "<option value=' '>Select Here</option>";
                                                                    foreach($doctor as $doctors){
                                                                    
                                                                    $userID=$doctors['userID'];
                                                                    $firstName=$doctors['firstName'];
                                                                    $middleName =$doctors['middleName '];
                                                                    $lastName=$doctors['lastName'];
                                                                    $name = $firstName." ".$middleName." ".$lastName;
                                                                    ?>
                                                                    <option value="<?php echo $userID;?>"><?php echo $name;?></option>

                                                                        <?php } }else{
                                                                            
                                                                         echo 'No doctor Avaialable';   
                                                                        }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
    <!-- <div class="row">
                                        

</div>


</form>
<div>
</div>
<?php
                            }
                                }
                               
                            ?>
<?php include "appointment_service.php"?>


</div>

</div>

</div>


<script>
$("#triage").change(function() {
    var data = $(this).val()
    //alert(data);
    if (data == 'yes') {
        $("#doctorsAvailable").hide();
    } else {
        $("#doctorsAvailable").show();
    }


});
</script>

<!-- <script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      
        function validateChecks() {
		var chks = document.getElementsByName('id[]');
		var checkCount = 0;
		for (var i = 0; i < chks.length; i++) {
			if (chks[i].checked) {
				checkCount++;
			}
		}
		if (checkCount < 1) {
            alert('Please check atleast one service.');
			return false;
		}
		return true;
	} -->


    </script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script>
    $().ready(function() {
        $("#register").validate({
            rules: {
                doctor: {
                    required: true,
                },
            },
            messages: {
                doctor: {
                    required: "Please provide patient Name",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>