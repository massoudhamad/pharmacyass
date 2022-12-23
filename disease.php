<script type="text/javascript" src="js/jquery.min.js"></script> 
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
                $("#exampleexample").DataTable({
                    paging:true,
                    dom: 'Blfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]
                });
            });
        </script>        
<style type="text/css">
	.bs-example{
		margin: 10px;
	}

#diseaseDifinition label.error {
    color: red;
    font-weight: bold;
}

#deathCause label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}
</style>
</style>
<?php $db=new DBHelper();?>
<div class="card-content">
  <div class="card-body">
  <div class="card-header">
         <h2>Disease Definition</h2>
    </div>
    <ul class="nav nav-tabs nav-linetriangle no-hover-bg" id="myTab" style="margin-top:40px;">
        <li class="nav-item">
          <a data-toggle="tab" href="#deseasedefinition" aria-expanded="true" class="nav-link active                           "><i class="la la-flag"></i> Disease Definition</a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#death" aria-expanded="true" class="nav-link"><i class="la la-flag"></i> Causes of Death</a>
        </li>
    </ul>
    <div class="tab-content" style="margin-top:20px;">
    <div id="deseasedefinition" class="tab-pane active">
      
        <h3>List of Diseases</h3>
         <div class="row"> 
            <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_record_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register New Disease</a>
                    </div>
                </section> 
            </div>
          </div><br><br>
            <div class="row">
                <div class="col-md-12">   
                    <?php  
                                $db = new DBHelper();
                                $zone = $db->getRows('icdcode',array('order_by'=>'icdName DESC'));
                    ?>
            <table  id="example" class="table" cellspacing="0" width="100%">
                <thead>
                  <tr>
                     <th>No.</th>
                    <th>ICD Code</th>
                    <th>ICD Name</th>
                    <th>ICD Description</th>
                   </tr>
                </thead>
              <tbody>
                <?php 
                if(!empty($zone)){ $count = 0; foreach($zone as $inst){ $count++;
                ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $inst['icdCode']; ?></td>
                            <td><?php echo $inst['icdName'] ?></td>
                            <td><?php echo $inst['icdDescription'] ?></td>
                        </tr>
                        <?php } } ?>
            </tbody>
            </table>
 </div></div>  
 
 
    <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
          <form name="" method="post" action="action_disease.php" id='diseaseDifinition'>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Disease Code">Disease Code:</label>
                            <input type="text" id="fname" name="code" placeholder="Eg. A001" class="form-control"/>
                        </div>
                   </div>
             </div>

            <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                      <label for="Disease Name">Disease Name:</label>
                      <input type="text" id="lname" name="name" placeholder="Eg. Malaria" class="form-control"/>
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="col-lg-12">
                     <div class="box">
                         <div class="box-header">
                           <h3 class="box-title">Description</h3>
              <!-- tools box -->
              <!-- <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
               -->
              <!-- </div> -->
              <!-- /. tools -->
            <!-- </div> -->
            <!-- /.box-header -->
            <!-- <div class="box-body pad"> -->
              
                <textarea class="textarea" name="description" placeholder="Please type your text here" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              
            </div>
          </div>
      </div>
    </div>
        <div class="row">
        <br />
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
              <input type="hidden" name="action_type" value="adddisease"/>
              <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
          </div>
        </div>
    </form>

</div>
</div>
</div>
 </div>
 
</div>

        
        <div id="death" class="tab-pane fade">
            <h3>List of Causes of Disease</h3>
             <div class="row"> 
                <div class="col-md-12">
                  <section id="add-patient">
                      <div class="pull-right" style="margin-right:50px">
                          <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register New Cause of Death</a>
                      </div>
                  </section> 
                </div>
              </div><br><br>
            <div class="row">
 <div class="col-md-12">   
<?php  
            $db = new DBHelper();
            $district = $db->getRows('death',array('order_by'=>'deathName DESC'));
?>
<table  id="exampleexample" class="table" cellspacing="0" width="100%">
  <thead>
  <tr>
      <th>No.</th>
    <th>Death Code</th>
    <th>Death Name</th>
    <th>Death Description</th>
     </tr>
  </thead>
  <tbody>
<?php 
if(!empty($district)){ $count = 0; foreach($district as $inst){ $count++;
 ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $inst['deathCode']; ?></td>
                <td><?php echo $inst['deathName'] ;?></td>
                <td><?php echo $inst['deathDescription'] ;?></td>
                
            </tr>
            <?php } }?>
</tbody>
 </table>
 </div></div>
 
 <div class="modal fade" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Add New Record</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form name="" method="post" action="action_disease.php" id='deathCause'>
<div class="modal-body">

<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="deathCode">Death Code:</label>
<input type="text" id="dname" name="code" placeholder="Eg. A001" class="form-control"/>
</div>
</div></div>

<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="courseCode">Death Name:</label>
<input type="text" id="fname" name="name" placeholder="Eg. Malaria" class="form-control"/>
</div>
</div></div>
<div class="row">
<div class="col-lg-12">
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Description 
                              
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              
                <textarea class="textarea" name="description" placeholder="Please type your text here" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              
            </div>
          </div>
</div></div>
<div class="row">
<br />
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
<input type="hidden" name="action_type" value="adddeath"/>
<input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
</div>
</div>
</form>

</div>
</div>
</div>
 
            
         </div>
            
</div></div></div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
  // Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#diseaseDifinition").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            code : {
                required : true,
                // Setting email pattern for email input
               
            },
            name : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            description : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
          code: {
                required: "This Field is Required",
               
            },
            name:{
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


$().ready(function() {
    // Selecting the form and defining validation method
    $("#deathCause").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            code : {
                required : true,
                // Setting email pattern for email input
               
            },
            name : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            description : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
          code: {
                required: "This Field is Required",
               
            },
            name:{
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


