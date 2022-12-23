<script type="text/javascript" src="js/jquery.min.js"></script>
<style>
#companyy label.error {
    color: red;
    font-weight: bold;
}

#insuarencee label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<?php $db=new DBHelper();?>
<div class="card-content">
  <div class="card-body">
       <div class="card-header">
         <h2>Register Service Info</h2>
    </div>
    <ul class="nav nav-tabs nav-linetriangle no-hover-bg" id="myTab" style="margin-top:40px;">
        <li class="nav-item">
            <a href="#zone" aria-expanded="true" class="nav-link active " data-toggle="tab"><i class="la la-flag"></i>  Category</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#region" aria-expanded="false" class="nav-link"><i class="la la-flag"></i> Subcategory</a>
        </li>
        
    </ul>
    <div class="tab-content">
    <div id="zone" class="tab-pane active" style="margin-top:20px;">
    <h3>List of Company</h3>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#zonetab").DataTable({
                    paging:true,
                    dom: 'Blfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#regiontab").DataTable({
                    paging:true,
                    dom: 'Blfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]
                });
            });
        </script>
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_zone_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Company</a>
                    </div>
                </section>
            </div>
            
        </div>
        <br><br>
        <form action="action_subcate.php" method="post">
     <div class="row">
    
        <div class="col-md-12">   
        <?php  
            $db = new DBHelper();
            $db = new DBHelper();
                    $subcategory_url = ("http://localhost/ehr-server/data/get_category.php") or die("failed");
                    //$contents =$db->curl_get_contents($service_url);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $subcategory_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PORT, 80);
                    $body = curl_exec($ch);
                    $error = curl_error($ch);
                    $subcategory_array = json_decode($body);
            ?>
         <div class="table-responsive">
                <table class="table">
                     <thead>
                         <tr>
                            <th  width="3px;">No</th>
                            <th  width="3px;">select  </th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                <?php 
                    $count = 1;
                    if(!empty($subcategory_array)){ ?>
                        <?php
                        foreach($subcategory_array as $serv){ 
                            $categoryCode = $serv[0];
                            $CategoryName = $serv[1];
                        ?>
                    
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><input type='checkbox' class='checkbox_class' name='categoryCode[]' value='<?php echo $categoryCode; ?>'></td>
                        <td><?php echo $CategoryName ?><input type="hidden" name="CategoryName" value="<?php echo $CategoryName; ?>"></td>
                        <td>
                             <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#zone<?php echo $inst['insurerTypeID'];?>"><i class="ft-edit default"></i>Block</button>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
                </table>
                </div>
                </div>
         </div>
         <div class="row">
                                        <div class="col-lg-8"></div>
                                            <div class="col-lg-2">
                                               
                                                <input type="hidden" name="action_type" value="saveCategory"/>
                                                <input type="submit" name="doUpdate" onclick=' return validateChecks()' value="Save" class="btn btn-info form-control">
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="hidden" name="action_type" value="cancel"/>
                                                <input type="submit" name="docancel"  value="Cancel" class="btn btn-danger form-control">
                                            </div>
                                    </div>

       
</div>
</form>

        <!--Region-->
        <div id="region" class="tab-pane fade" style="margin-top:20px;">

            <h3>List of Insure Company</h3>
            <form action="action_subcate.php" method="post">
            <div class="row">
                <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_region_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register</a>
                    </div>
                </section>
                </div>
            </div><br><br>
            <div class="row">
            <div class="col-md-12">   
        <?php  
            $db = new DBHelper();
            $db = new DBHelper();
                    $subcategory_url = ("http://localhost/ehr-server/data/get_subcategoryOnly.php") or die("failed");
                    //$contents =$db->curl_get_contents($service_url);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $subcategory_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PORT, 80);
                    $body = curl_exec($ch);
                    $error = curl_error($ch);
                    $subcategory_array = json_decode($body);
            ?>
         <div class="table-responsive">
                <table class="table">
                     <thead>
                         <tr>
                            <th  width="3px;">No</th>
                            <th  width="3px;">select  </th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                <?php 
                    $count = 1;
                    if(!empty($subcategory_array)){ ?>
                        <?php
                        foreach($subcategory_array as $serv){ 
                            $subcategoryCode = $serv[0];
                            $subCategoryName = $serv[1];
                        ?>
                    
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><input type='checkbox' class='checkbox_class' name='SubcategoryCode[]' value='<?php echo $subcategoryCode; ?>'></td>
                        <td><?php echo $subCategoryName ?><input type="hidden" name="subCategoryName" value="<?php echo $subCategoryName; ?>"></td>
                        <td>
                             <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#zone<?php echo $inst['insurerTypeID'];?>"><i class="ft-edit default"></i>Block</button>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
                </table>
                </div>
                </div>
         </div>
         <div class="row">
                                        <div class="col-lg-8"></div>
                                            <div class="col-lg-2">
                                               
                                                <input type="hidden" name="action_type" value="saveSubCategory"/>
                                                <input type="submit" name="doUpdate" onclick=' return validateChecks()' value="Save" class="btn btn-info form-control">
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="hidden" name="action_type" value="cancel"/>
                                                <input type="submit" name="docancel"  value="Cancel" class="btn btn-danger form-control">
                                            </div>
                                    </div>

       
</div>
</form>

                    </div>
                </div>
            </div>
        </div>
 <!--end add zone-->

 
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
  // Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#companyy").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            name : {
                required : true,
                // Setting email pattern for email input
               
            },
        },
        // Setting error messages for the fields
        messages: {
            name: {
                required: "This Field is Required",
               
            },
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});


$().ready(function() {
    // Selecting the form and defining validation method
    $("#insuarencee").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            name : {
                required : true,
                // Setting email pattern for email input
               
            },
            address : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            phone : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            insrID : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
            name: {
                required: "This Field is Required",
               
            },
            address:{
                required: "This Field is Required",

            },
            phone:{
                required: "This Field is Required",

            },
            insrID:{
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

