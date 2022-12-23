<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
              <script type="text/javascript">
              $(document).ready(function()
              {
              $("#programID").change(function()
              {
              var id=$(this).val();
              var dataString = 'id='+ id;

              //$("#studyYear").load('ajax_studyear.php?id='+id);

              $.ajax
              ({
              type: "POST",
              url: "ajax_studyear.php",
              data: dataString,
              cache: false,
              success: function(html)
              {
              $("#studyYear").html(html);
              } 
              });

              });

              });
              </script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#example1").DataTable({
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#example3").DataTable({
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
    <style>

</style>
   
</script>
             
<style type="text/css">
	.bs-example{
		margin: 10px;
	}
  #allergies label.error {
    color: red;
    font-weight: bold;
}
#allergiesType label.error {
    color: red;
    font-weight: bold;
}
#allergiesReaction label.error {
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
         <h2>Manage Health Facility</h2>
    </div>
    <ul class="nav nav-tabs nav-linetriangle no-hover-bg" id="myTab" style="margin-top:40px;">
        <li class="nav-item">
          <a data-toggle="tab" href="#category" aria-expanded="true" class="nav-link active">Allergy</a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#health" aria-expanded="true" class="nav-link">Allergy Type</a>
        </li>
<!--        <li><a data-toggle="tab" href="#clinics">Clinics</a></li>
-->      <li class="nav-item">
            <a data-toggle="tab" href="#facilitywards" aria-expanded="true" class="nav-link">Allergy Reaction</a>
          </li>
    </ul>
    <div class="tab-content">
    <div id="category" class="tab-pane active" style="margin-top:20px;">
        <h3>Allergies</h3>
        <div class="row"> 
            <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_record_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Allergy</a>
                     </div>
                </section> 
            </div>
      </div>
      <br><br>
            <div class="row">
                <div class="col-md-12">   
                <?php  
                      $db = new DBHelper();
                      //$zone = $db->getRows('allergy',array('order_by'=>'allergyID DESC'));
          ?>
      <table  id="example1" class="table" cellspacing="0" width="100%">
        <thead>
        <tr>
          <th>No</td>
          <th>Allergy Type</td>
          <th>Allergy Name</th>
          <th>Allergy Reaction</th>
          <th>Action</th>
          
          </tr>
        </thead>
        <tbody>
      <?php
      $zone = $db->getAllegy(); 
      if(!empty($zone)){
        $count = 0; 
        foreach($zone as $inst)
        { $count++;
      ?>
                  <tr>
                      <td><?php echo $count;?></td>
                      <td><?php echo $inst['allergy_type'];?></td>
                      <td><?php echo $inst['allergyName']?></td>
                      <td><?php echo $inst['allergyReaction']?></td>
                      <td>
                                    <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#U<?php echo $inst['wardCode'];?>"><i class="ft-edit default"></i>Update</button>
                       </td>
                      
                  </tr>
                  <?php } } ?>
      </tbody>
      </table>

            <!-- Health Facility Categories -->
             <!-- //update -->
                           

       
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
     <form name="" method="post" action="action_allergy.php" id='allergies'>
          <div class="modal-body">

          <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="courseCode">Allergy Type:</label>
                  <select name="allergy_type" class="form-control">
                        <?php
                            $allergy = $db->getRows('allergy_type',array('order_by'=>'allergy_typeID ASC'));
                                if(!empty($allergy)){
                                      echo "<option value=''>Select Here</option>";
                                        $count = 0; foreach($allergy as $dept)
                                        { $count++;
                                        $allergy_type=$dept['allergy_type'];
                                        $allergy_typeID =$dept['allergy_typeID'];
                                        
                                      ?>
                                      
                                      <option value="<?php echo $allergy_typeID ;?>"> <?php echo $allergy_type;?></option>
                          <?php }}?>
                  </select>
          </div>
      </div>
    </div>     
    <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label for="courseCode">Allergy Name:</label>
              <input type="text"  name="allergyName" placeholder="Eg. Beef" class="form-control" autocomplete="off"/>
          </div>
      </div>
    </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reaction </h3>
              <input type="text" name="allergyReaction" placeholder="Eg. Rash" class="form-control"/>
            </div><br>
          </div>
      </div>
    </div>


       
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
        <input type="hidden" name="action_type" value="addcategory"/>
        <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
        </div>
</div>
</form>
</div>
</div>
</div>

    </div>
 


 <!-- Health Facility -->       
        <div id="health" class="tab-pane fade" style="margin-top:20px;">
            <h3>Allergy Types</h3>
             <div class="row"> 
                <div class="col-md-12">
                    <section id="add-patient">
                       <div class="pull-right" style="margin-right:50px">
                          <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_health_facility_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Allergy Type</a>
                       </div>
                    </section>
                  </div>   
                </div>
                <br><br>
            <div class="row">
 <div class="col-md-12">   
 <?php  
                    $db = new DBHelper();
                    $district = $db->getRows('allergy_type',array('order_by'=>'allergy_typeID'));
        ?>
      <table  id="example2" class="table" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Allergy Type</th>
            <th>Action</th>
            
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($district)){ $count = 0; foreach($district as $inst){ $count++;
            ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $inst['allergy_type']; ?></td>
                            <td><?php echo $inst['allergy_reactionID']; ?></td>
                            <td>
                                    <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#<?php echo $inst['allergy_reactionID'];?>"><i class="ft-edit default"></i>Update</button>
                            </td>
                            
                            
                        </tr>
                        <?php } }?>
          </tbody>
    </table>
   
 </div></div>
           
           
           <!-- Add New health Facility -->
           <div class="modal fade" id="add_new_health_facility_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Add New Record</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form name="" method="post" action="action_allergy.php" id='allergiesType'>
<div class="modal-body">

      <div class="row">
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="courseCode">Allergy Type:</label>
                  <input type="text" id="fname" name="allergy_type" placeholder="Eg. Food" class="form-control"/>
              </div>
          </div>
        </div>
    <div class="row">
       <br />
         </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                  <input type="hidden" name="action_type" value="addhealthfacility"/>
                  <input type="submit" name="doSubmit" value="Save Record" class="btn btn-primary" tabindex="8">
             </div>
         </div>
    </form>
</div>
</div>
</div>
</div>
           <!-- End -->    
         </div> 
                   
         <!-- Wards -->
        <div id="facilitywards" class="tab-pane fade">
        <h3>Allergy Reaction</h3>
        <div class="row"> 
          <div class="col-md-12">
              <section id="add-patient">
                  <div class="pull-right" style="margin-right:50px">
                       <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_ward_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Allergy Reaction</a>
                   </div>
              </section>  
           </div>
        </div>
        <br><br>
            <div class="row">
                <div class="col-md-12">   
                    <?php  
                                $db = new DBHelper();
                                $reaction = $db->getRows('allergy_reaction',array('order_by'=>'allergy_reactionID'));
                    ?>
              <table  id="example3" class="table" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Allergy Reaction</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($reaction)){ $cnt = 0; foreach($reaction as $inst){ $cnt++;
                    ?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $inst['allergy_reaction']; ?></td>
                                   <?PHP $inst['allergy_reactionID']; ?>
                                   
                                    <td>
                                    <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#U<?php echo $inst['allergy_reactionID'];?>"><i class="ft-edit default"></i>Update</button>
                                    </td>
                                </tr>
          <!-- ward -->
          <!-- //update -->
        <div class="modal animated zoomInRight text-left" id="U<?php echo $inst['allergy_reactionID'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_allergy.php">
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="courseCode">Allergy Reaction:</label>
                        <input type="text"  name="code" value="<?php echo $inst['allergy_reaction'];?>" class="form-control" tabindex="1" />
                    </div>
                  </div>
                
                </div>
           </div>
       
          
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
        <input type="hidden" name="wardCode" value="<?php echo $inst['wardCode']?>"/>
        <input type="hidden" name="action_type" value="reaction"/>
        <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
    </div>
  </div>
</form>
    </div>
    </div>
 </div>
</div>                             

        <!-- end modal -->
        <?php } }else{ ?>
           <tr><td colspan="4">No allergy reaction(s) found......</td>
            <?php } ?>
                </tbody>
            </table>
 </div>
 </div>  
 
    <div class="modal fade" id="add_new_ward_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
          <form name="" method="Post" action="action_allergy.php" id='allergiesReaction'>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="courseCode">Allergy Reaction:</label>
                        <input type="text" id="fname" name="reaction" placeholder="Eg. 001" class="form-control" tabindex="1" />
                    </div>
                  </div>
               
          
   
            </div>
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
          <input type="hidden" name="action_type" value="reaction"/>
          <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
      </div>
  </div>
</form>
</div>
</div>
</div> 
</div> 
         <!-- End of Wards -->  
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
    $("#allergies").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            allergy_type : {
                required : true,
                // Setting email pattern for email input
               
            },
            allergyName : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            allergyReaction : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
          allergy_type: {
                required: "This Field is Required",
               
            },
            allergyName:{
                required: "This Field is Required",

            },
            allergyReaction:{
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
    $("#allergiesType").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            allergy_type : {
                required : true,
                // Setting email pattern for email input
               
            }
        },
        // Setting error messages for the fields
        messages: {
          allergy_type: {
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
    $("#allergiesReaction").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            reaction : {
                required : true,
                // Setting email pattern for email input
               
            }
        },
        // Setting error messages for the fields
        messages: {
          reaction: {
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


