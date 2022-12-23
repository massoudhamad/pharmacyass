<?php
$db = new DBHelper();
$patientNo=$db->my_simple_crypt($_GET['id'],'d');
//$patients = $db->getPatientEdit();
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
        $phone=$patient['telNumber'];
        $IDNo=$patient['IDNo'];
        $IDType=$patient['IDType'];
        // $districtID=$patient['shehiacode'];
       // $shehiaID=$patient['shehiacode'];
        $shehiaName=$db->getData('shehia','shehiaName','shehiacode',$patient['shehiaCode']);
       // $region=$db->getData('region','regionName','regionCode',$patient['regionCode']);
        $kin=$patient['nextOfKin'];
        $relation=$patient['relation'];
        $phoneKin = $patient['phoneKin'];
        $bloodGroup =$patient['bloodGroup'];
        $paymenttypeCodee=$patient['paymenttypeCode'];
        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCodee);
        
       
    }
}
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
         $("#regionID").change(function () {
             var regionID = $(this).val();
             var dataString = 'regionID=' + regionID;
             $.ajax
             ({
                 type: "POST",
                 url: "ajax_district.php",
                 data: dataString,
                 cache: false,
                 success: function (html) {
                     $("#districtID").html(html);
                 }
             });

         });
     });
        </script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#districtID").change(function()
            {
                var districtID=$(this).val();
                var dataString = 'districtID='+ districtID;
                $.ajax
                ({
                    type: "POST",
                    url: "ajax_shehia.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $("#shehiaID").html(html);
                    }
                });

            });

        });
    </script>

            
        <div class="content-wrapper">
        <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-user font-large-2 success"></i>Update Patient Profile</h2>
                    </div>
                </div>
           
            <div class="container-fluid">
                <!-- Row separator layout section start -->
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                               
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form form-horizontal row-separator" action="action_edit.php" method="POST">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-user"></i> Personal Info</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Patient Number</label>
                                                        <input type="text" class="form-control" name="patientNo" value ="<?php echo  $patientNo?>" readonly="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">First Name</label>
                                                        <input type="text" class="form-control" name="fname" value ="<?php echo  $fname?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control">Middle Name</label>
                                                        <input type="text" class="form-control" name="mname" value ="<?php echo  $mname?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Last Name</label>
                                                        <input type="text" class="form-control" name="lname" value ="<?php echo  $lname?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <label class="label-control">Address</label>
                                                        <input type="text" class="form-control" name="address" value ="<?php echo  $address?>">
                                                    </div>
                                                
                                                     <div class="col-md-4">
                                                                <label for="city">
                                                                    Gender:
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <select name="gender" class="form-control"/>
                                                                    <option value="<?php echo $sex?>"><?php echo $sex ?></option>
                                                                    <option value="M">Male</option>
                                                                    <option value="F">Female</option>
                                                                </select>
                                                            </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control">ID Type</label>
                                                        <select name="idType" class="form-control"/>
                                                            <option value="<?php echo $IDType ?>"><?php echo $IDType ?></option>
                                                             
                                                             <option value="Zanzibar ID">Zanzibar ID</option>
                                                            <option value="National ID">National ID</option>
                                                            <option value="Passport Number">Passport Number</option>
                                                                </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">ID Number</label>
                                                        <input type="text" class="form-control" name="idnumber" value ="<?php echo  $IDNo?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control">Contact Number</label>
                                                        <input type="text" class="form-control" name="phoneNumber" value ="<?php echo  $phone?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Date Of Birth</label>
                                                          <div class="row">
                                                            <div class="col-lg-4 no-padding-right">
                                                            <select name="date" class="form-control">
                                                            <?php 
                                                                $dob2=explode("-",$dob);
                                                                $year=$dob2[0];
                                                                $month=$dob2[1];
                                                                $date=$dob2[2];
                                                            ?>
                                                                        <option value="<?php echo $date;?>"><?php echo $date;?></option>
                                                                        <?php
                                                                        for($x=1;$x<=31;$x++)
                                                                        {
                                                                            echo "<option value='$x'>$x</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                            </div><div class="col-lg-4 no-padding-right no-padding-left">

                                                            <select name="month" class="form-control" >
                                                                        <option value="<?php echo $month;?>"><?php echo $month;?></option>
                                                                        <?php
                                                                        /* $month=array();
                                                                        $month[1] ="January";
                                                                        $month[2] ="February";
                                                                        $month[3] ="March";
                                                                        $month[4] ="April";
                                                                        $month[5] ="May";
                                                                        $month[6] ="June";
                                                                        $month[7] ="July";
                                                                        $month[8] ="August";
                                                                        $month[9] ="September";
                                                                        $month[10] ="October";
                                                                        $month[11] ="November";
                                                                        $month[12] ="December"; */

                                                                        /* for($i = 1; $i<=12; $i++)
                                                                        {
                                                                            echo "<option value='$i'>$month[$i]</option>";
                                                                        } */

                                                                        for($i = 1; $i<=12; $i++)
                                                                            {
                                                                                echo "<option value='$i'>$i</option>";
                                                                            }
                                                                    ?>
                                                                    </select>
                                                            </div><div class="col-lg-4 no-padding-left">
                                                            <select name="year" class="form-control">
                                                                        <option value="<?php echo $year;?>"><?php echo $year;?></option>
                                                                        <?php
                                                                        $year=date('Y');
                                                                        $year1=date('Y')-60;
                                                                        for($x=$year;$x>=$year1;$x--)
                                                                        {
                                                                            echo "<option value='$x'>$x</option>";
                                                                        }
                                                                        ?>
                                                                    </select>

                                                            </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control">Region Name</label>
                                                    <select name="regionCode" id="regionID"  class="form-control"/>
                                                        
                                                                    <?php
                                                                    $region = $db->getRows('region',array('order_by'=>'zoneCode ASC'));
                                                                    if(!empty($region)){
                                                                        echo "<option value=''>Select Here</option>";
                                                                        $count = 0; foreach($region as $dept){ $count++;
                                                                            $regionCode=$dept['regionCode'];
                                                                            $dregionName=$dept['regionName'];
                                                                            ?>
                                                                            <option value="<?php echo $regionCode;?>"><?php echo $dregionName;?></option>
                                                                        <?php }}?>
                                                                </select>
                                                    </div>
                                               
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">District Name</label>
                                                         <select name="districtName" id="districtID"  class="form-control" />
                                                          <!-- <option value="<?php echo $districtCode;?>"><?php echo $districtName;?></option> -->
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control">Shehia Name</label>
                                                        <select name="shehiaCode" id="shehiaID"  class="form-control" />
                                                          <option value="<?PHP echo $shehiaID?>"><?php echo $shehiaName ?></option>         
                                                        </select>
                                                    </div>
                                                </div>
                                                <h4 class="form-section"><i class="la la-clipboard"></i>Emergence Contact</h4>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">First Name</label>
                                                        <input type="text" class="form-control" name="nextOfKin" value ="<?php echo  $kin?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="label-control">Relation</label>
                                                                <select name="relation" class="form-control"/>
                                                                    <option><?php echo $relation?></option>
                                                                    <option value="">Select Here</option>
                                                                    <option value="Husband">Husband</option>
                                                                    <option value="Wife">Wife</option>
                                                                    <option value="Brother">Brother</option>
                                                                    <option value="Sister">Sister</option>
                                                                    <option value="Aunt">Aunt</option>
                                                                    <option value="Ancle">Uncle</option>
                                                                    <option value="Mother">Mother</option>
                                                                    <option value="Father">Father</option>
                                                                </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <label class="label-control" for="projectinput1">Contact Number</label>
                                                        <input type="text" class="form-control" name="phoneKin" value ="<?php echo $phoneKin?>">
                                                    </div>
                                                   
                                                </div>
                                                 <h4 class="form-section"><i class="la la-clipboard"></i>Clinical Profile</h4>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <label class="label-control" for="projectinput1">Blood Group</label>
                                                        
                                                            <select name="bloodGroup" class="form-control"/>
                                                                    <option><?php echo $bloodGroup?></option>
                                                                    <option value="">Select Here</option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="O-">O-</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="AB-">AB-</option>
                                                                </select>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                    <label class="label-control">RH</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="fname">
                                                    </div> -->
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-md-6">
                                                    <label class="label-control" for="projectinput1">Allergy</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="fname">
                                                    </div>
                                                    <div class="col-md-6">
                                                    <label class="label-control" for="projectinput1">Known Clinical</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="fname">
                                                    </div>
                                                </div> -->
                                                <h4 class="form-section"><i class="la la-user"></i>Insurance Details</h4>
                                                <!-- Step 4 => Insaurance Details -->
                                                <h6>
                                                    <i class="step-icon font-medium-3 ft-file-text"> </i>
                                                    Insurance Details
                                                </h6>
                                                <fieldset>
                                                   
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="company">
                                                                    Payment Scheme:
                                                                    <span class="danger">*</span>
                                                                </label>
                                                               <select name="paymenttypeCode" id="schemeID" class=" form-control" />
                                                                <option value="<?php echo $paymenttypeCodee ;?>"><?php echo $healthScheme ;?></option>
                                                            <?php
                                                                $al_type = $db->getavailable_payment_typesS();
                                                                    if(!empty($al_type)){
                                                                            echo "<option value=''>Select Here</option>";
                                                                            $count = 0; foreach($al_type as $alt){ $count++;
                                                                            $paymentTypeName=  $db->getData("paymenttype","paymentTypeName","paymentTypeCode",$alt['paymenttypeCode']);
                                                                            $paymentTypeCode =$alt['paymenttypeCode'];
                                                                            ?>
                                                                        <option value="<?php echo $paymentTypeCode ;?>"><?php echo $paymentTypeName ;?></option>
                                                                                <?php 
                                                                            }
                                                                        }
                                                                        ?>
                                                        </select>
                                                            </div>
                                                        
                                                   

                                                
                                                
                                                       


                                                
                                                        
                                                    </div>
                                                </div>
                                               
                                            <div class="form-actions">
                                            <div class="col-lg-6">
                                            <input type="hidden" name="action_type" value="Update"/>
                                            <input type="submit" name="doSubmit" value="Update" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                
                        </div>
                    </div>

                   
                        </div>
                    </div>

                    
            </div>
        </div>
    </div>
    <!-- END: Content-->
   