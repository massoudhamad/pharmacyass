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
//$auth_user = new DBHelper();
?>
<div class="card-content">
  <div class="card-body">
  <div class="card-header">
   <div class="pull-right" style="margin-right:40px">
        <a href="index3.php?sp=paymenttypes" class="btn btn-info  btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Add Payment Type</a>
    </div>
         <h2>Payment Schemes</h2>
    </div><br>
            <h3>List of Available Payment Schemes</h3>
             <div class="row"> 
                <div class="col-md-12">
                    
                 </div>
            </div><br><br>
            <div class="row">
            
 <div class="col-md-12"> 
  <form name="register" id="register" method="post" action="action_payment_type.php">  
<?php  
            $service = $db->getRows('available_payment_types',array('order_by'=>'available_paymenttypeCode asc'));
?>
    <table  id="example2" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                 <th>Payment Scheme</th>
                  <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
         <?php 
        if(!empty($service)){ $count = 1; foreach($service as $inst){ 
            $paymenttypecode = $inst['paymenttypeCode'];
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                 <td><?php echo  $db->getData("paymenttype","paymentTypeName","paymentTypeCode",$paymenttypecode);?></td>
                  <td><?php  if($inst['isAvailable'] == 1){echo 'Available';}else{echo ' Not Available';}?></td>
                 <td>
                 <?php  if($inst['isAvailable'] == 1){?>
                 <a href='block_paymenttype.php?paymentTypeCode=<?php echo $inst['paymenttypeCode'];?>' class="btn  btn-danger btn-sm" style="color:white;"  title="Click to block" ><i class="ft-shield default"></i></a>
                 <?php }else{?>
                     <a href='block_paymenttype.php?paymentTypeCode=<?php echo $inst['paymenttypeCode'];?>' class="btn  btn-success btn-sm" style="color:white;"  title="Click to unblock" ><i class="ft-shield default"></i></a>
                     <?php
                 }
                 ?>
                  </td>
                    <?php }
                    ?>
            </tr>
             <!-- modal Facility -->
             <!-- //update -->
                           

        <!-- end modal -->
            <?php } ?>
</tbody>
 </table>
 </div>
 </div>
       
           
           

            <section id="add-patient">
                        <div class="pull-left" style="margin-right:50px">
                        <input type="hidden" name="action_type" value="add"/>
                         <!-- <input type="hidden" name="paymentTypeCod" value="<?php echo  $paymenttypecode?>"/> -->
                            <input type="submit" name="action_type" value="Save"  onclick=' return validateChecks()' class="btn btn-info form-control">
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

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
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

    <script type="text/javascript">
      
        function validateChecks() {
		var chks = document.getElementsByName('paymentTypeCode[]');
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
    </script>


