<style>
#services label.error {
    color: red;
    font-weight: bold;
}

#subcategoryy label.error {
    color: red;
    font-weight: bold;
}

#categoryID label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootbox/bootbox.min.js" type="text/javascript"></script>
   <script type="text/javascript">
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });  
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#example2").DataTable({
            "processing": true,
             "paging":true,
             dom: 'Blfrtip',
              bLengthChange: true,
             "lengthMenu": [ [5,10, 15, 25, 50, 100, -1], [5,10, 15, 25, 50, 100, "All"] ],
             "iDisplayLength": 15,
             bInfo: false,
             "bAutoWidth": false,
             buttons: [
                 'copy', 'csv', 'excel', 'pdf', 'print'
             ],
             "order": [[1, 'asc']]
            });
    });
</script>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
         $("#categoryID").change(function () {
             var categoryCode = $(this).val();
             var dataString = 'categoryCode=' + categoryCode;
             $.ajax
             ({
                 type: "POST",
                 url: "ajax_subCategory.php",
                 data: dataString,
                
                 success: function (html) {
                     $("#subcategory").html(html);
                 }
             });

         });
     });
 </script>


<script type="text/javascript">
     $(document).ready(function() {
         $("#categoryIDD").change(function () {
             var categoryCode = $(this).val();
             var dataString = 'categoryCode=' + categoryCode;
             //alert(dataString);
             $.ajax
             ({
                 type: "POST",
                 url: "ajax_subCategory.php",
                 data: dataString,
                
                 success: function (html) {
                     $("#subcategoryy").html(html);
                 }
             });

         });
     });
 </script>
<script type="text/javascript">
     $(document).ready(function() {
         $("#subcategory").change(function () {
             var subCategoryCode = $(this).val();
             var dataString = 'subCategoryCode=' + subCategoryCode;
             //alert(dataString);
             $.ajax
             ({
                 type: "POST",
                 url: "ajax_get_service.php",
                 data: dataString,
                 cache: false,
                 success: function (html) {
                     //alert(html)
                     $("#servicesss").html(html);
                 }
             });

         });
     });
 </script>

             
<style type="text/css">
	.bs-example{
		margin: 10px;
	}
</style>

<?php 
$db=new DBHelper();
$auth_user = new DBHelper();
?>
<div class="card-content">
  <div class="card-body">
  <div class="card-header">
         <h2>Payment Types</h2>
    </div><br>
            <h3> Available Payment Types</h3>
             <div class="row"> 
                <div class="col-md-12">
                    
                 </div>
            </div><br><br>
            <div class="row">
            
 <div class="col-md-12"> 
  <form name="register" id="register" method="post" action="action_available_payment_types.php">  
<?php  
            $db = new DBHelper();
            $service = $db->getRows('paymenttype',array('order_by'=>'paymentTypeCode asc'));
?>
    <table  id="example2" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                 <th>Select.</th>
                <!-- <th>Payment Code</th> -->
                 <th>Payment Type Name</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
        <?php 
        if(!empty($service)){ $count = 0; foreach($service as $inst){ $count++;
            // $status = $inst['isActive'];
            // $serviceID = $inst['serviceCode'];
        ?>
            <tr>
                <td><?php echo $count;?></td>
                 <td><input type='checkbox' class='checkbox_class' name='id[]'value='<?php echo $inst['paymentTypeCode']; ?>'></td>
                
                <!-- <td><?php  echo $db->decrypt($inst['paymentTypeCode']);?></td> -->
                 <td><?php  echo $inst['paymentTypeName'];?></td>
                
                <td>
                    <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  title="Update Service"  data-toggle="modal" data-target="#facility<?php echo $inst['serviceOfferedID'];?>"><i class="ft-edit default"></i></button>
                    <?php
                    if($status == 1){?>
                         <a href='block_service_offered.php?serviceCode=<?php echo  $serviceID;?>&hospitalCode=<?php echo $hospital_code;?>'><button class="btn mr-1 mb-1 btn-danger btn-sm" style="color:white;"  title="Click to block"   data-toggle="modal" ><i class="ft-shield default"></i></button></a>
                         <?php
                    }else{?>
                        <a href='unblock_service_offered.php?serviceCode=<?php echo  $serviceID;?>&hospitalCode=<?php echo $hospital_code;?>'><button class="btn mr-1 mb-1 btn-success btn-sm" style="color:white;"  title="Click to unblock"   data-toggle="modal"><i class="ft-shield default"></i></button></a>
                        <?php
                    }
                   ?>
                </td>
            </tr>
             <!-- modal Facility -->
             <!-- //update -->
        <div class="modal animated zoomInRight text-left" id="facility<?php echo $inst['serviceOfferedID'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update Service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_serviceOffered.php">
                    <div class="modal-body">
                        <div class="row">
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Service Name">Service Category: </label>
                                    <select name="categoryCode"  id='categoryIDD' class="form-control">
                                    <option value="<?php echo $inst['categoryCode'];?>"><?php echo $db->getData("servicecategory","categoryName","categoryCode",$inst['categoryCode']);?></option>
                                                    <?php
                                                $services = $db->getRows('servicecategory', array('order_by' => 'categoryID ASC'));
                                                if(!empty($services)){
                                                    echo "<option value=''>Select Here</option>";
                                                     foreach($services as $sc){
                                                    $categoryName=$sc['categoryName'];
                                                    $categoryCode=$sc['categoryCode'];
                                                ?>
                                                <option value="<?php echo $inst['insurance'];?>"><?php echo $categoryName;?></option>
                                                <?php }}?>
                                        </select>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Service Name">Service Sub Category: </label>
                                    <select name="subCategoryCode" id="subcategoryy"  class="form-control " />
                                    <option value="<?php echo $inst['subCategoryCode'];?>"><?php echo  $db->getData("servicesubcategory","subCategory","subCategoryCode",$inst['subCategoryCode']);?></option>  
                                    </select>  
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Service">Service Name: </label>
                                    <div id='servicessss' name="serviceID">
                                    <select name="serviceID"  id="services" class="form-control">
                                    <option value="<?php echo $inst['serviceCode'];?>"><?php  echo $db->getData("service","serviceName","serviceCode",$inst['serviceCode']);?></option>
                                    </div>
                                    </select>
                                </div>
                                </div>
                                <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Cash: </label>
                                <input type="text" id="costsharing" name="Cash" value="<?php echo $inst['cash'];?>" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Insurance: </label>
                            <input type="text" id="lname" name="insurance" value="<?php echo $inst['insurance'];?>" class="form-control" tabindex="3" />
                        </div>
                    </div>
                        </div> 
                        <div class="row">
                                <div class="col-lg-6">
                                <div class="form-group">
                            <label for="email">Cost Sharing: </label>
                            <input type="text" id="costsharing" name="costsharing" value="<?php echo $inst['costsharing'];?>" class="form-control" tabindex="3" />
                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                         <label for="email">fasttrack: </label>
                                         <input type="text" id="lname" name="fasttrack" value="<?php echo $inst['fasttrack'];?>" class="form-control" tabindex="3" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                                         <label for="email">Credits: </label>
                                         <input type="text" id="creditss" name="credits" value="<?php echo $inst['credits'];?>" class="form-control" tabindex="3" />
                                    </div>
                    </div>
                </div>  
                        <!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Credits: </label>
                                <input type="text" id="creditss" name="credits" value="<?php echo $inst['credits'];?>" class="form-control" tabindex="3" />
                            </div> -->
                        <!-- </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Fast Track: </label>
                                <input type="text" id="lname" name="fasttrack" value="<?php echo $inst['fasttrack'];?>" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div> -->
                <!-- <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Cost Sharing: </label>
                            <input type="text" id="costsharing" name="costsharing" value="<?php echo $inst['costsharing'];?>" class="form-control" tabindex="3" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Insurance: </label>
                            <input type="text" id="lname" name="insurance" value="<?php echo $inst['insurance'];?>" class="form-control" tabindex="3" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Government: </label>
                            <input type="text" id="costsharing" name="government" value="<?php echo $inst['government'];?>" class="form-control" tabindex="3" />
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="serviceOfferedID" value="<?php echo $inst['serviceOfferedID'];?>"/>
                        <input type="hidden" name="hospitalCode" value="<?php echo $hospital_code;?>"/>
                        <input type="hidden" name="action_type" value="Updateservice"/>
                        <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                    </div>
                </div>
            </form>
     </div>
    </div>
 </div>
</div>                             

        <!-- end modal -->
            <?php }} ?>
</tbody>
 </table>
 </div>
 </div>
       
           
           

            <section id="add-patient">
                        <div class="pull-left" style="margin-right:50px">
                        <input type="hidden" name="action_type" value="add"/>
                            <input type="submit" name="doUpdate" onclick=' return validateChecks()' value="Save" class="btn btn-info form-control">
                        </div>
                    </section>  
        </div>
        </div>
        </form>
        </div>
        </div>
     </div>
         </div>
    </div>
</div>

           <!-- End -->
</div></div>          
</div></div></div>
<script>
$("#irelated").change(function() {
  var  data = $(this).val()
  //alert(data);
  if(data == 0){
    $("#clinicCode").hide();
  }else{
    $("#clinicCode").show();
  }

   
  });
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
  // Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#subcategoryy").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            name : {
                required : true,
                // Setting email pattern for email input
               
            },
            categoryID : {
                required : true,
                // Setting email pattern for email input
               
            },
            description : {
                required : true,
                // Setting email pattern for email input
               
            },
        },
        // Setting error messages for the fields
        messages: {
            name: {
                required: "This Field is Required",
               
            },
            categoryID: {
                required: "This Field is Required",
               
            },
            description: {
                required: "This Field is Required",
               
            }
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});




$().ready(function() {
    // Selecting the form and defining validation method
    $("#categoryID").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
           
            category : {
                required : true,
                // Setting email pattern for email input
               
            },
            name : {
                required : true,
                // Setting email pattern for email input
               
            },
            description : {
                required : true,
                // Setting email pattern for email input
               
            }
        },
        // Setting error messages for the fields
        messages: {
            name: {
                required: "This Field is Required",
               
            },
            category: {
                required: "This Field is Required",
               
            },
            description: {
                required: "This Field is Required",
               
            }
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});



$().ready(function() {
    // Selecting the form and defining validation method
    $("#services").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            name : {
                required : true,
               
            },
            subCategoryID : {
                required : true,
                
            },
            isrelated : {
                required : true,
                
            },
            clinicCode : {
                required : true,
                
            },
        
            cash : {
                required : true,
                digits: true,
                
            },
        
            credits : {
                required : true,
                digits: true,
                
            },
        
        fasttrack : {
                required : true,
                digits: true,
                
            },
        
        costsharing : {
                required : true,
                digits: true,
                
            },
        
        insurance : {
                required : true,
                
            }
        },
        // Setting error messages for the fields
        messages: {
            name: {
                required: "This Field is Required",
               
            },
            subCategoryID:{
                required: "This Field is Required",

            },
            isrelated:{
                required: "This Field is Required",

            },
            clinicCode:{
                required: "This Field is Required",

            },
            cash: {
                required: "This Field is Required",
               
            },
            credits:{
                required: "This Field is Required",

            },
            fasttrack:{
                required: "This Field is Required",

            },
            costsharing:{
                required: "This Field is Required",
                

            },
            insurance:{
                required: "This Field is Required",

            }
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script> 
<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
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
	}


