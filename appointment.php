<style>
#app label.error {
    color: red;
    font-weight: bold;
}

.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<?php
                $db = new DBHelper();
                $patientNo=$_REQUEST['patientNo'];
               // $visitNo=$_REQUEST['visitNo'];
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
                       $healthSchemeID=$patient['paymenttypeCode'];
                        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$healthSchemeID);
                        $visitStatus=$db->getData("patientvisit","visitStatus"," visitNo",$patientNo);

                ?>

<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="fa fa-phone font-large-2 success"></i>Appointment</h2>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <section id="book-appointment">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Book An Appointment</h2>
                                </div>
                                <div class="card-body">
                                    <form action="action_appointment.php" method="Post" id='app'>
                                        <div class="row">
                                            <input type="hidden" name="patientNo" class="form-control" readonly
                                                value="<?php echo $patientNo?>" required id="firstName">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="firstname">First Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="firstName" class="form-control" readonly
                                                        value="<?php echo $fname?>" required id="firstName">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="lastname">Middle Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="middleName" class="form-control" readonly
                                                        value="<?php echo $mname?>" id="middleName">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="lastname">Last Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="lastName" readonly
                                                        value="<?php echo $lname?>" id="lastName">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone">Contact Number:</label>
                                                    <input type="text" class="form-control" id="phone" readonly
                                                        value="<?php echo $telNumber?>" name="tell">
                                                </div>
                                            </div>




                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="ChooseDoctor">Category:<span
                                                            class="text-danger">*</span></label>
                                                    <select name="employeeId" id="categoryCode"
                                                        class="form-control chosen-select" required>
                                                        <?php
                                         $db = new DBHelper();
                                         $doctorName = $db->getRows('servicesubcategory',array('where'=>array('categoryCode'=>'Q0FUMDE=')));
                                        if(!empty($doctorName)){
                                            echo"<option value=''>Select Category</option>";
                                            $count = 0; foreach($doctorName as $dn){ $count++;
                                                $subCategory=$dn['subCategory'];
                                                $categoryCode=$dn['subcategoryCode'];
                                                ?>
                                                        <option value="<?php echo $categoryCode;?>">
                                                            <?php echo $subCategory;?></option>
                                                        <?php }}
                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="service">Service <span></label>
                                                    <select name="serviceCode" id="servicess" class="form-control" />
                                                    <option value="">Select</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="date">Appointment Date <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="datee" name="aptDate"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="ChooseDoctor">Choose Doctor:<span
                                                            class="text-danger">*</span></label>
                                                    <select name="employeeId" id="employeId"
                                                        class="form-control chosen-select" required>
                                                        <?php
                                         $db = new DBHelper();
                                         $doctorName = $db->getScheduleDocName();
                                        if(!empty($doctorName)){
                                            echo"<option value=''>Select Doctor</option>";
                                            $count = 0; foreach($doctorName as $dn){ $count++;
                                                $doctoFullName=$dn['firstname']." ".$dn['middlename']." ".$dn['lastname'];
                                                $employeeID=$dn['employeeId'];
                                                ?>
                                                        <option value="<?php echo $employeeID;?>">
                                                            <?php echo $doctoFullName;?></option>
                                                        <?php }}
                                                ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date">Time <span class="text-danger">*</span></label>
                                                    <div id="datey">
                                                        <input type="time" class="form-control" name="time" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pull-right" style="margin-bottom:20px;">



                                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                                tabindex="9">Cancel</button>
                                            <input type="hidden" name="action_type" value="bookAppointment" />
                                            <input type="submit" name="doSubmit" value="Save" class="btn btn-primary"
                                                tabindex="8">
                                        </div>

                                </div>
                                </form>
                            </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
                   
                   }
                }?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(function() {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var minDate = year + '-' + month + '-' + day;

    $('#datee').attr('min', minDate);
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#employeId").change(function() {
        var employeeId = $(this).val();
        var date = $("#datee").val();
        var dataString = 'employeeId=' + employeeId + '&date=' + date;
        //alert(dataString);
        $.ajax({
            type: 'POST',
            url: "ajax_split.php",
            data: dataString,
            cache: false,
            success: function(data) {
                $("#datey").html(data);
            }
        });
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#categoryCode").change(function() {
        var categoryCode = $(this).val();
        var dataString = 'subCategoryCode=' + categoryCode;
        //alert(dataString);
        $.ajax({
            type: 'POST',
            url: "ajax_get_service.php",
            data: dataString,
            cache: false,
            success: function(data) {
                $("#servicess").html(data);
            }
        });
    });
});
</script>

<!-- Download the latest jquery.validate minfied version -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

<script>
$().ready(function() {
    // Selecting the form and defining validation method
    $("#app").validate({

        // Passing the object with custom rules
        rules: {
            // login - is the name of an input in the form
            aptDate: {
                required: true,
                // Setting email pattern for email input

            },
            employeeId: {
                required: true,
                // Setting minimum and maximum lengths of a password

            },
            serviceID: {
                required: true,
                // Setting minimum and maximum lengths of a password

            },
            clininCode: {
                required: true,
                // Setting minimum and maximum lengths of a password

            },
            time: {
                required: true,
                // Setting minimum and maximum lengths of a password

            }
        },
        // Setting error messages for the fields
        messages: {
            aptDate: {
                required: "This Field is Required",

            },
            employeeId: {
                required: "This Field is Required",

            },
            serviceID: {
                required: "This Field is Required",

            },
            clininCode: {
                required: "This Field is Required",

            },
            time: {
                required: "This Field is Required",

            },

        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>