<?php
$db = new DBHelper();
$patientNo=$db->my_simple_crypt($_GET['id'],'d');
//$patients = $db->getPatientAppointmentInfo($patientNo);
$patients = $db->getAppoitmentEdit($patientNo);
//$staff = $db->getRows('appoitment',array('where'=>array('appointmentID'=>$appointmentID)));
if(!empty($patients))
{
    $x=0;
    foreach ($patients as $st)
    {
        $x++;
        $employeeId=$st['employeeId'];
        $fname=$st['firstName'];
        $mname=$st['middleName'];
        $lname=$st['lastName'];
        $staffFname=$st['firstname'];
        $staffMname=$st['middlename'];
        $stafflname=$st['lastname'];
        $staffname=$st['firstname']." ".$st['middlename']." ".$st['lastname'];
        $clininCode=$st['clininCode'];
        $aptDate=$st['aptDate'];
        $phone=$st['tell'];
        $time=$st['time'];
        $serviceID=$st['serviceCode'];
        $employeeID=$st['employeeId'];
        $clinicName =  $db->getData("clinic","clinicName","clinicCode",$clininCode);
        $serviceName =  $db->getData("service","serviceName","serviceCode",$serviceID);
                                                         
        
       
       
    }
}
?>     
<?php $db=new DBHelper();?>
<div class="card-content">
  <div class="card-body">
       <div class="card-header">
         <h2>Edit Appointment</h2>
    </div>
        <br><br>
            <div class="container-fluid">
                <!-- Row separator layout section start -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    <div class="container-fluid">
                                        <form class="form form-horizontal row-separator" enctype="multipart/form-data" action="action_addstaff.php" method="POST" >
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-edit"></i> Edit Appointment</h4>
                                             <div class="row">
                                                     <div class="col-md-4">
                                                        <label for="firstName">First Name:<span class="danger">*</span></label>
                                                        <input type="text" class="form-control required" readonly  value="<?php echo $fname?>" id="firstname" name="firstName" />
                                                        <div class="error" id="errorfirstname"></div>
                                                    </div>
                                                <div class="col-md-4">
                                                        <label class="label-control">Middle Name</label>
                                                        <input type="text" class="form-control"  readonly value="<?php echo $mname?>" id="middlename" name="middleName">
                                                        <div class="error" id="errormiddlename"></div>
                                                        
                                                </div>
                                                    <div class="col-md-4">
                                                        <label for="lastname">Last Name: <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control required" readonly value="<?php echo $lname?>" name="lastName"id="lastname">
                                                        <div class="error" id="errorlastname"></div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="label-control">Appointment Date;<span class="danger">*</span></label>
                                                        <input type="date" class="form-control" id="date"  value="<?php echo $aptDate?>" name="dateofbirth">
                                                        <div class="error" id="dob"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="label-control">Doctor:<span class="danger">*</span></label>
                                                        <select name="employeeId" id="employeeId" class="form-control chosen-select" required="">
                                                
                                                    <?php
                                                    $db = new DBHelper();
                                                    $staff = $db->getstaffCadre();
                                                    if(!empty($staff)){
                                                        echo"<option value="?><?php echo $employeeID;?>><?php echo $staffname?><?php echo "</option>";
                                                        $count = 0; foreach($staff as $st){ $count++;
                                                            $cadrename = $st['cardename'];
                                                            $doctorName=$st['firstname']." ".$st['middlename']." ".$st['lastname'];
                                                            $employeeID=$st['employeeId'];
                                                            
                                                            ?>
                                                            <option value="<?php echo $employeeID;?>"><?php echo $doctorName;?></option>
                                                    <?php }}
                                                        ?>
                                                </select>
                                                    </div>
                                                   
                                                <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Time:<span class="danger">*</span></label>
                                                    <div id="datey" >
                                                    <input  class="form-control" value="<?php echo $time?>" name="time" required>
                                                </div>
                                                    </div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="label-control">Clinic:<span class="danger">*</span></label>

                                                        <select name="clininCode" class="form-control chosen-select" disabled required="">
                                        <?php
                                         $db = new DBHelper();
                                        $clinic = $db->getRows('clinic', array('order_by' => 'clinicCode ASC'));
                                        if(!empty($clinic)){
                                            echo"<option readonly value="?><?php echo $clinicCode;?>><?php echo $clinicName?><?php echo "</option>";
                                            $count = 0; foreach($clinic as $CL){ $count++;
                                                $clinicName=$CL['clinicName'];
                                                $clinicCode=$CL['clinicCode'];
                                                ?>
                                                <option readonly value="<?php echo $clinicCode;?>"><?php echo $clinicName;?></option>
                                        <?php }}
                                        ?>
                                    </select>
                                                         
                                                    </div>
                                                <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Service:<span class="danger">*</span></label>
                                                        <input type="text" readonly class="form-control"  value="<?php echo $serviceName?>" id="cont" name="tell">
                                                        <div class="error" id="errorcont"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Contact:<span class="danger">*</span></label>
                                                        <input type="text" class="form-control" readonly value="<?php echo $phone?>" id="cont" name="tell">
                                                        <div class="error" id="errorcont"></div>
                                                    </div>
                                                </div> 
                                                    </div>
                                       

                                                    <div class="form-actions">
                                                        <div class="col-lg-6">
                                                        <input type="hidden" name="action_type" value="addstaff"/>
                                                        <input type="submit" name="doSubmit" onclick="return Validation()" value="Update" class="btn btn-primary">
                                                        </div>
                                                    </div>
                                             </form>
                                        </div>
                                    </div>
                                <div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div> 
        </div>
     </div>                
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
       
        <script type="text/javascript">
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('#date').attr('min', minDate);
});           
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#employeeId").change(function () {
            var employeeId = $(this).val();
            var date=$("#date").val();
            var dataString = 'employeeId='+ employeeId+'&date='+date;
            //alert(dataString);
            $.ajax
            ({
                type: 'POST',
                url: "ajax_split.php",
                data:dataString,
                cache: false,
                success: function (data) {
                //    //window.location='ajax_split.php';
                //    alert(data);
                //   //console.log(data);
                    $("#datey").html(data);
                }
            });
        });
    });
</script>