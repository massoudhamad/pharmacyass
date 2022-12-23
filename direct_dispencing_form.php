<?php
$db = new DBHelper();
$LastId =  $db->getLastId();
$LastId++;
?>    
<div class="card-content">
  <div class="card-body">
       <div class="card-header">
         <h2>Direct Sales</h2>
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
                                        <form class="form form-horizontal row-separator" id="direct_dispencing_form" action="action_direct_dispency.php" method="POST">
                                        <div class="col-md-8 pull-right">
                                                         <div class="form-inline"  style="margin-left:340px; !important">
                                                            <label for="firstName">Sales Reference &nbsp; <span class="danger"></span></label>
                                                            <input type="text" class="form-control required" readonly value="SR.<?php echo $LastId++;?>" id="sr" name="sr" style='width:100px;' />
                                                            <div class="error" id="errorfirstname"></div>
                                                        </div>
                                                    </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-dollar"></i>New Sales</h4>
                                             <div class="row">
                                                        </div>
                                                        
                                                       <div class="optionBox">
                                                            <div class="block">
                                                            <center><div id='errors'></center><div class='optionBox'><div class='block'><div class='col-md-12'><div class='row'><div class='col-3'><label class='label-control'>Drug</label><select name='drugID[]' id='drug' class='form-control chosen select' require><option value=''>Select Here</option><?php $drugs = $db->getRows('drugs',array('order_by'=>'drugID ASC'));if(!empty($drugs)){$count = 0; foreach($drugs as $dept){ $count++;$drugID=$dept['drugID'];$drugName=$dept['drugName'];?><option value='<?php echo $drugID;?>'><?php echo $drugName;?></option><?php }}?></select></div><div class='col-2'><label class='label-control'>Quantity</label><input  name='prediscribed_quantity[]' id='prediscribed_quantityy' class='form-control' placeholder='Dose' /></div><div class='col-3'><label class='label-control'>Quantity Type</label><select name='quantityType[]' id='quantityTypee' class='form-control'><option value=''>Select Here</option><?php $drugs = $db->getRows('Quantity_type',array('order_by'=>'quantityTypeId ASC'));if(!empty($drugs)){$count = 0; foreach($drugs as $dept){ $count++;$quantityTypeId=$dept['quantityTypeId'];$quantityType=$dept['quantityType'];?><option value='<?php echo $quantityTypeId;?>'><?php echo $quantityType;?></option><?php }}?></select></div><div class='col-2'><label class='label-control'>Price</label><input type='text' class='form-control' readonly  name='price[]' require></div>&nbsp; &nbsp;<input type='button' value='Drop' class='remove btn btn-danger ' style='margin-top:26px;'></span></div></div></div></div></div><br>
                                                            </div>
                                                            <div class="block">
                                                               
                                                            </div>
                                                        
                                                    <div class="form-actions">
                                                        <div class="col-lg-12">
                                                        <input type="button" value='Add Medicine' onclick="return add()" class="btn btn-info add">
                                                            <input type="hidden" name="action_type" value="addDirectDispencing"/>
                                                            <input type="submit" name="doSubmit"  value="Save" class="btn btn-info">
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
</div> 

<script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>

//function add(){
    $(document).on('click','.add',function() {
    var drugname = document.getElementById('drug').value;

        $('.block:last').append($(".optionBox").html());
        $('.chosen-select').trigger("chosen:updated");
        $('.chosen-select').chosen();
   
});

$(document).on('click','.remove',function(){
    $(this).closest('.optionBox').remove();
});

</script>
 <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script>
  // Waiting until DOM is ready
$().ready(function() {
    $('#direct_dispencing_form').each(function(){
        
    // Selecting the form and defining validation method
    $(this).validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            'drugID[]' : {
                required : true,
            },
            'prediscribed_quantity[]' : {
                required : true,
               
            },
            'quantityType[]' : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
            
        },
        // Setting error messages for the fields
        messages: {
            'drugID[]': {
                required: "This Field is Required",
               
            },
            'prediscribed_quantity[]': "This Field is Required",
            'quantityType[]': "This Field is Required",
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
});
</script>    
<!-- <script type="text/javascript">
    function Validation(){
        var drugname = document.getElementById('drug').value;
        var quantity = document.getElementById('prediscribed_quantity').value;
        var quantityType = document.getElementById('quantityType').value;
        var errors = document.getElementById('errors');
           if(drugname == ""){
            errors.innerHTML = 'All fields must be fiiled';
            errors.style.color = 'red';
            setTimeout(function(){
                errors.style.display = "none"
                }, 3000); 
               return false;
             
           }else if(isNaN(quantity)){
                errors.innerHTML = 'Only Numbers allowed in quantity';
                errors.style.color = 'red'; 
                setTimeout(function(){
                errors.style.display = "none"
                }, 3000); 
                return false;
               }
           
               if(quantity == ""){
            errors.innerHTML = 'All fields must be fiiled';
            errors.style.color = 'red';
            setTimeout(function(){
                errors.style.display = "none"
                }, 3000); 
            
               return false;
              

           }else if(quantityType == ""){
            errors.innerHTML = 'All fields must be fiiled';
            errors.style.color = 'red';
            setTimeout(function(){
                errors.style.display = "none"
                }, 3000); 
               return false;
          }else{
              return true;
          }
    }   
        </script> -->
        <script>
         $(function() {
        $('.chosen-select').chosen();
        $('#new').chosen();
        $('.chosen-select-deselect').chosen();
      });
      </script>
       
        
</body>
</html>
