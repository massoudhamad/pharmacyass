<div class="container">
<div class="row"> 
<h2 class="text-info">Patient Registration</h2>
<div class="col-md-12">
<div class="row">
<div class="col-lg-6">
<div class="pull-left">
                <h3>List of Patients</h3>
            </div> </div>
<div class="col-lg-6"><div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Register Patient</button>
            </div>   </div>
 </div>
 </div>
</div>
<div class="row">
        <div class="col-md-12">
            <hr>

<?php 
if(!empty($_REQUEST['msg']))
{
  if($_REQUEST['msg']=="succ")
  {
    echo "<div class='alert alert-success fade in'><a href='index3.php?sp=patient' class='close' data-dismiss='alert'>&times;</a>
    <strong>Patient data has been inserted successfully</strong>.
</div>";
  }
  else if($_REQUEST['msg']=="unsucc")
  {
    echo "<div class='alert alert-danger fade in'><a href='index3.php?sp=patient' class='close' data-dismiss='alert'>&times;</a>
    <strong>Error in your data!!!</strong>.
</div>";
  }
  else if($_REQUEST['msg']=="edit")
  {
      echo "<div class='alert alert-success fade in'><a href='index3.php?sp=patient' class='close' data-dismiss='alert'>&times;</a>
    <strong>Successfully Edited</strong>.
</div>";
  }
  else if($_REQUEST['msg']=="error")
  {
      echo "<div class='alert alert-danger fade in'><a href='index3.php?sp=patient' class='close' data-dismiss='alert'>&times;</a>
    <strong>Sory-Contact System Administrator</strong>.
</div>";
  }
}
?> 


        </div>
    </div>
<div class="row">
 <div class="col-md-12">   
<?php
          
            $db = new DBHelper();
            $patients = $db->getRows('patient',array('order_by'=>'patientNo DESC'));
?>
<table  id="submitlist" class="display nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th width="5px">No.</th>
    <th>Patient No.</th>
    <th>Full Name</th>
    <th>Sex</th>
     <th>Age</th>
    <th>Address</th>
    <th>Phone Number</th>
    <th>Health Scheme</th>
    <th>Action</th>
     </tr>
  </thead>
  
 </table>
 </div></div>  
</div>
<script type="text/javascript" src="ajax/index.js"></script>


<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#schemeID").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue==2){
                $(".2").not("." + optionValue).hide();
                $("." + optionValue).show();
                $(".4").hide();
            }
            else if(optionValue==4)
            {
                $(".4").not("." + optionValue).hide();
                $("." + optionValue).show();
                $(".2").hide();
            }
            else{
                $(".2").hide();
                $(".4").hide();
            }
        });
    }).change();
});
</script>

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

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Add New Patient</h4>
</div>
<style>
.no-padding-right
{
    padding-right: 0;
}
.no-padding-left
{
    padding-left: 0;
}
</style>
<div class="row">
    <form action="action_patient.php" method="post" name="register" id="register">
<div class="col-md-12">
<div class="modal-body">
                <div class="well">
                <fieldset>
                  <legend>Personal Information</legend>
                    <div class="row">
                        <div class="col-lg-6">
                        <?php
                        $hospitalCode=$_SESSION['hospitalCode'];
                        $visitDate=date('md');
                        $visitNo=$hospitalCode.rand(100,999);

                        $patientNumber=$hospitalCode.$visitDate.rand(100,9999);
                        ?>
                            <label for="FirstName">Patient Number</label>
                            <input type="text" name="patientNumber" value="<?php echo $patientNumber;?>" readonly="readonly" class="form-control" required="" />
                        </div>

                        <div class="col-lg-6">
                            <label for="MiddleName">First Name</label>
                            <input type="text" name="fname" class="form-control" required/>
                        </div>
                    </div>
                  <div class="row">
                        <div class="col-lg-6">
                            <label for="LastName">Middle Name</label>
                            <input type="text" name="mname"  class="form-control" />
                        </div>

                        <div class="col-lg-6">
                            <label for="LastName">Last Name</label>
                            <input type="text" name="lname"  class="form-control" required="" />
                        </div>
                  </div>
                      <div class="row">
                          <div class="col-lg-6">
                            <label for="Geder">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Here</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                       <div class="col-lg-6">
                            <label for="Date of Birth">Date of Birth</label>
                             <div class="row">
                             <div class="col-lg-4 no-padding-right">
                              <select name="date" class="form-control" required="">
                                        <option value="">--Date--</option>
                                        <?php
                                        for($x=1;$x<=31;$x++)
                                        {
                                            echo "<option value='$x'>$x</option>";
                                        }
                                        ?>
                                    </select>
                             </div><div class="col-lg-4 no-padding-right no-padding-left">

                             <select name="month" class="form-control" required="">
                                        <option value="">--Month--</option>
                                        <?php
                                        $month=array();
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
            							$month[12] ="December";

            							for($i = 1; $i<=12; $i++)
            							{
                                               echo "<option value='$i'>$month[$i]</option>";
                                         }
                                    ?>
                                    </select>
                             </div><div class="col-lg-4 no-padding-left">
                             <select name="year" class="form-control" required="">
                                        <option value="">--Year--</option>
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
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="Geder">ID Type</label>
                           <select name="idType" class="form-control" required>
                                <option value="">Select Here</option>
                                <option value="ZNZ ID">Zanzibar ID</option>
                                <option value="NIDA ID">National ID</option>
                                <option value="Passport">Passport Number</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="Date of Birth">ID Number</label>
                            <input type="text" id="idnumber" name="idnumber" class="form-control" required=""  />

                        </div>
                    </div>

                  <div class="row">
                        <div class="col-lg-6">
                            <label for="Physical Address">Address</label>

                            <input type="text" name="address" class="form-control" required="" />
                        </div>

                        <div class="col-lg-6">
                            <label for="Physical Address">Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control" required="" />
                        </div>

                    </div>

                   <div class="row">
                       <div class="col-lg-4">
                           <label for="Physical Address">Region Name</label>

                           <select name="regionCode" id="regionID"  class="form-control" required>
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
                   <div class="col-lg-4">
                            <label for="Physical Address">District Name</label>

                            <select name="districtID" id="districtID"  class="form-control" required>
                                option value="">Select Here</option>
                               <?php
/*                               $district = $db->getRows('district',array('order_by'=>'regionCode ASC'));
                               if(!empty($district)){
                                   echo "<option value=''>Select Here</option>";
                                   $count = 0; foreach($district as $dept){ $count++;
                                $districtID=$dept['districtID'];
                                $districtName=$dept['districtName'];
                               */?><!--
                               <option value="<?php /*echo $districtID;*/?>"><?php /*echo $districtName;*/?></option>
                               --><?php /*}}*/?>
							</select>
						</div>
                        <div class="col-lg-4">
                            <label for="Physical Address">Shehia Name</label>

                            <select name="shehiaID" id="shehiaID"  class="form-control" required>
                               <option value="">Select Here</option>
							</select>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                            <label for="Physical Address">Next of Kin(In case of emergency)</label>
                            <input type="text" name="nextOfKin" class="form-control" required="" />
                        </div>
                        <div class="col-lg-6">
                            <label for="Physical Address">Health Scheme</label>

                            <select name="schemeID" id="schemeID"  class="form-control" required>
                                <?php
                                $healthScheme = $db->getRows('healthscheme',array('order_by'=>'healthScheme DESC'));
                                if(!empty($healthScheme)){
                                    echo "<option value=''>Select Here</option>";
                                    $count = 0; foreach($healthScheme as $hscheme){ $count++;
                                        $healthSchemeID=$hscheme['healthSchemeID'];
                                        $healthScheme=$hscheme['healthScheme'];
                                        ?>
                                        <option value="<?php echo $healthSchemeID;?>"><?php echo $healthScheme;?></option>
                                    <?php }}?>

                            <!--<option value="government">Government Scheme</option>
                                <option value="cash">Others(Cash)</option>
                                <option value="credits">Credits</option>
                            <option value="others">Insurance</option>-->
							</select>
                        </div>

                        </div>

						<div class="2">
						<div class="row">
                            <div class="col-lg-6">
                            <label for="FirstName">Insurance Company</label>
                           <select name="insurerID" id=""  class="form-control">
                               <?php
                              $insurerCompany = $db->getRows('insurer_company',array('where'=>array('insurerTypeID'=>1),'order_by'=>'insurerName ASC'));
                               if(!empty($insurerCompany)){
                                   echo "<option value=''>Select Here</option>";
                                   $count = 0; foreach($insurerCompany as $icompany){ $count++;
                                   $insurerID=$icompany['insurerID'];
                                   $insurerName=$icompany['insurerName'];
                               ?>
                               <option value="<?php echo $insurerID;?>"><?php echo $insurerName;?></option>
                               <?php }}?>
							</select>
                            </div>

                            <div class="col-lg-6">
                            <label for="MiddleName">Membership Number</label>
                            <input type="text" name="membershipNumber"  class="form-control" />
                        </div></div>
                        <div class="row">
                        <div class="col-lg-6">
                            <label for="MiddleName">Card Holder Name</label>
                            <input type="text" name="cardHolderName"  class="form-control"/>
                        </div>
                        <div class="col-lg-6">
                            <label for="MiddleName">Card Holder Number</label>
                            <input type="text" name="cardHolderNumber"  class="form-control"/>
                        </div>
                           </div>
                </div>


                    <div class="4">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="FirstName">Credits Company/Personal</label>
                                <select name="insurerID" id=""  class="form-control">
                                    <?php
                                    $insurerCompany = $db->getRows('insurer_company',array('where'=>array('insurerTypeID'=>2),'order_by'=>'insurerName ASC'));
                                    if(!empty($insurerCompany)){
                                        echo "<option value=''>Select Here</option>";
                                        $count = 0; foreach($insurerCompany as $icompany){ $count++;
                                            $insurerID=$icompany['insurerID'];
                                            $insurerName=$icompany['insurerName'];
                                            ?>
                                            <option value="<?php echo $insurerID;?>"><?php echo $insurerName;?></option>
                                        <?php }}?>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label for="MiddleName">Membership Number</label>
                                <input type="text" name="membershipNumber"  class="form-control" />
                            </div></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="MiddleName">Card Holder Name</label>
                                <input type="text" name="cardHolderName"  class="form-control"/>
                            </div>
                            <div class="col-lg-6">
                                <label for="MiddleName">Card Holder Number</label>
                                <input type="text" name="cardHolderNumber"  class="form-control"/>
                            </div>
                        </div>
                    </div>



                </div>
</div></div>
<div class="modal-footer">
<input type="hidden" name="action_type" value="add"/>
<input type="submit" name="doSubmit" value="Save Records" class="btn btn-primary">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

</div>
</form>

</div>
</div>


