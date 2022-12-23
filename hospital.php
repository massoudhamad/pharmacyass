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
                     $("#districtIDD").html(html);
                 }
             });

         });
     });
 </script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#districtIDD").change(function()
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
                        $("#shehiaIDD").html(html);
                    }
                });

            });

        });
    </script>  

<style>
#cadree label.error {
    color: red;
    font-weight: bold;
}
#Editcadree label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<div class="card-content">
  <div class="card-body">
  <div class="card-header">
         <h2><i class="la la-server font-large-2 success"></i>Manage Hospital</h2>
    </div>
    <div class="tab-content">
        <div class="row"> 
            <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px"><br>
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_record_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Hospital</a>
                     </div>
                </section> 
            </div>
      </div>
      <br><br>
            <div class="row">
                <div class="col-md-12">   
                    <?php  
                                $db = new DBHelper();
                                $cadre = $db->getRows('hospital',array('order_by'=>'hospitalID ASC'));
                    ?>
            <table  id="example" class="table table-responsive" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>No.</th>
                    <th>Hospital Name</th>
                    <th> Hospital Code</th>
                    <th>Email</th>
                    <th>URL</th>
                    <th>Phone</th>
                    <th>Contact Person</th>
                    <th>District</th>
                    <th>Action</th>
                  </tr>
                </thead>
              <tbody>
            <?php 
            
            if(!empty($cadre)){ 
                $count = 1;
                foreach($cadre as $cadre){ 
                   
                          $firstname = $cadre['firstname'];
                          $middlename = $cadre['middlename'];
                          $lastname = $cadre['lastname'];
                          $fullname = $firstname." ".$middlename." ".$lastname;
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $db->decrypt($cadre['hospitalName']); ?></td>
                            <td><?php echo $cadre['hospitalCode'];?></td>
                            <td><?php echo $cadre['email'];?></td>
                            <td><?php echo $cadre['url'];?></td>
                            <td><?php echo $cadre['telephoneNumber'];?></td>
                            <td><?php echo $fullname;?></td>
                            <td><?php echo $hospital=$db->getData("district","districtName","districtCode",$cadre['districtCode']);;?></td>
                            <td>
                            
                             <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#cadre<?php echo $cadre['hospitalID'];?>"><i class="ft-edit default"></i>Update</button>
                        </td>
                        </tr>
           <!-- Modal zone -->
 <div class="modal animated zoomInRight text-left" id="cadre<?php echo $cadre['hospitalID'];?>" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
     <form  method="Post" action="action_hospital.php" id='cadree'>
        <div class="modal-body">
          <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Hospital Code: </label>
                    <input type="text" id="lname" name="uname"  value="<?php echo $cadre['hospitalCode'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Hospital Name: </label>
                    <input type="text" id="lname" name="fname"  value="<?php echo $cadre['hospitalName'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
         </div>
         <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Address: </label>
                    <input type="text" id="lname" name="mname"  value="<?php echo $cadre['address'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Phone Number: </label>
                    <input type="text" id="lname" name="lname"  value="<?php echo $cadre['telephoneNumber'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
         </div>
         <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Email: </label>
                    <input type="text" id="lname" name="phone"  value="<?php echo $cadre['email'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">URL: </label>
                    <input type="text" id="lname" name="email" value="<?php echo $cadre['url'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
         </div>
         <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                    <label for="Cadre">Contact Person: </label>
                    <input type="text" id="lname" name="email" value="<?php echo $cadre['contactPerson'];?>" class="form-control" tabindex="3" />
                  </div>
              </div>
              </div>
         <div class="row">
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">Region: </label>
                    <select name="regionCode" id="regionCode"  class="form-control"/>
                    <?php
                        $region = $db->getRows('region',array('order_by'=>'zoneCode ASC'));
                            if(!empty($region)){
                                echo "<option value=''>Select Here</option>";
                                 foreach($region as $dept){
                                $regionCode=$dept['regionCode'];
                                $dregionName=$dept['regionName'];
                                ?>
                                <option value="<?php echo $regionCode;?>"><?php echo $dregionName;?></option>
                   <?php }}?>
                </select>
                  </div>
             </div>
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">District: </label>
                    <select name="districtName" id="districtID"  class="form-control " />
                    <option value="">Select Here</option>
                    </select> 
                  </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">Ward: </label>
                    <select name="shehiaID" id="shehiaID"  class="form-control" />
                    <option value="">Select Here</option>
                    </select>
                  </div>
              </div>
            
         
        <!-- <div class="row">
          <div class="col-lg-12">
                <div class="box-header">
                    <h3 class="box-title">Cadre Description</h3>
            <div class="box-body pad">
                <textarea class="textarea" name="description" placeholder="Please type your Cadre Description here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>-->
          </div>
        </div>
     
        <br />
       
        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                <input type="hidden" name="action_type" value="edit"/>
                <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                <input type="HIDDEN" name="userID" value="<?php echo $cadre['userID'];?>" class="btn btn-primary" tabindex="8">
        </div>
    </div>
    </form>
 
</div>
</div>
</div>

    </div>
 


    </div> 
  </div>                                         
 <!-- modal -->
            
                        <?php } }else{ ?>
                        <tr><td colspan="4">No Users (s) found......</td>
                        <?php } ?>
              </tbody>
          </table>
      </div>
 </div>  
 
      <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
     <form  method="Post" action="action_hospital.php" id='cadree'>
        <div class="modal-body">
          <div class="row">
              <div class="col-lg-3">
                  <div class="form-group">
                    <label for="Cadre">Hospital Code: </label>
                    <input type="text" id="lname" name="hospitalCode" placeholder="Eg.RMC009" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-5">
                  <div class="form-group">
                    <label for="Cadre">Hospital Name: </label>
                    <input type="text" id="lname" name="hospitalName" placeholder="Eg.RMC009" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">Hospital Level: </label>
                    <select name="hospitalLevelID" id="hospitallevel"  class="form-control"/>
                    <?php
                        $region = $db->getRows('hospitallevel',array('order_by'=>'hospitalLevelID ASC'));
                            if(!empty($region)){
                                echo "<option value=''>Select Here</option>";
                                 foreach($region as $dept){
                                $hospitalLevelID=$dept['hospitalLevelID'];
                                $hospitalLevelName=$dept['hospitalLevelName'];
                                ?>
                                <option value="<?php echo $hospitalLevelID;?>"><?php echo $hospitalLevelName;?></option>
                   <?php }}?>
                </select>
                  </div>
              </div>
         </div>
         <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Address: </label>
                    <input type="text" id="lname" name="address" placeholder="Eg.kizimkazi" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="Cadre">Phone Number: </label>
                    <input type="text" id="lname" name="phone" placeholder="Eg.+255 778 871 890" class="form-control" tabindex="3" />
                  </div>
              </div>
         </div>
         <div class="row">
              <div class="col-lg-5">
                  <div class="form-group">
                    <label for="Cadre">Contact Person: </label>
                    <input type="text" id="lname" name="contactPerson" placeholder="Eg.Cadre Name" class="form-control" tabindex="3" />
                  </div>
              </div>
              <div class="col-lg-7">
              <label for="Cadre">URL: </label>
              <input type="text" id="lname" name="url" placeholder="Eg.www.someone@com" class="form-control" tabindex="3" />
              </div>
         </div>
         <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                    <label for="Cadre">Email: </label>
                    <input type="text" id="lname" name="email" placeholder="Eg.someone@gmail.com" class="form-control" tabindex="3" />
                  </div>
              </div>
              </div>
         <div class="row">
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">Region: </label>
                    <select name="regionCode" id="regionID"  class="form-control"/>
                    <?php
                        $region = $db->getRows('region',array('order_by'=>'zoneCode ASC'));
                            if(!empty($region)){
                                echo "<option value=''>Select Here</option>";
                                 foreach($region as $dept){
                                $regionCode=$dept['regionCode'];
                                $dregionName=$dept['regionName'];
                                ?>
                                <option value="<?php echo $regionCode;?>"><?php echo $dregionName;?></option>
                   <?php }}?>
                </select>
                  </div>
              </div>

             
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">District: </label>
                    <select name="districtName" id="districtIDD"  class="form-control " />
                    <option value="">Select Here</option>
                    </select> 
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                    <label for="Cadre">Ward: </label>
                    <select name="wardID" id="shehiaIDD"  class="form-control " />
                    <option value="">Select Here</option>
                    </select> 
                  </div>
              </div>
          </div>
        </div>
        <br/>
        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                <input type="hidden" name="action_type" value="add"/>
                <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
        </div>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
  // Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#cadree").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            cadrename : {
                required : true,
                // Setting email pattern for email input
               
            },
            description : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
          cadrename: {
                required: "This Field is Required",
               
            },
            description:{
                required: "This Field is Required",

            },
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});


$(document).ready(function() {
    // Selecting the form and defining validation method
    $("#Editcadre").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            cadrename : {
                required : true,
                // Setting email pattern for email input
               
            },
            description : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
            cadrename: {
                required: "This Field is Required",
               
            },
            description:{
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
<script>
  // Waiting until DOM is ready

</script> 



