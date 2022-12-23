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
                $("example").DataTable({
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
             
<style type="text/css">
	.bs-example{
		margin: 10px;
	}
</style>
<?php $db=new DBHelper();?>
<div class="card-content">
  <div class="card-body">
  <div class="card-header">
         <h2>Manage Services</h2>
    </div>
    <ul class="nav nav-tabs nav-linetriangle no-hover-bg"id="myTab" style="margin-top:40px;">
        <li class="nav-item">
            <a data-toggle="tab" href="#category" aria-expanded="true" class="nav-link active"><i class="la la-flag"></i>Category</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#subcategory" aria-expanded="true" class="nav-link"><i class="la la-flag"></i>Sub Category</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#service" aria-expanded="true" class="nav-link"><i class="la la-flag"></i>Services</a>
        </li>
    </ul>
    <div class="tab-content">
    <div id="category" class="tab-pane active" style="margin-top:20px;">
        <h3>List of Services Categories</h3>
        <div class="row"> 
            <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_record_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register New Services Category</a>
                    </div>
                </section> 
            </div>
        </div><br><br>
            <div class="row">
                <div class="col-md-12">   
                <?php  
                    $db = new DBHelper();
                    $category = $db->getRows('servicecategory',array('order_by'=>'categoryName DESC'));
                ?>
            <table  id="example" class="table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Category</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>Action</th>
                    </tr>
            </thead>
            <tbody>
            <?php 
            if(!empty($category)){ 
                $count = 0; 
                foreach($category as $inst){ 
                    $count++;
            ?>
                    <tr>
                        <td><?php echo $count;?></td>
                         <td><?php if($inst['category']=="1") echo'Doctor Service'; 
                         else if($inst['category']=="2") echo 'Test and Investigation';
                         elseif($inst['category']=="3") echo 'Other Service';
                         elseif($inst['category']=='4') echo 'Dressing and Procedure'; ?></td>

                        <td><?php echo $inst['categoryName']; ?></td>
                        <td><?php echo $inst['categoryDesc'];?></td>
                        <td>
                            <button style="color:white" class="btn mr-1 mb-1 btn-info btn-sm" data-toggle="modal" data-target="#zoomInRight<?php echo $inst['categoryID']?>"><i class="ft-edit default"></i> Update</button>
                        </td>
                    </tr>
                    <!-- Modal -->
    <div class="modal animated zoomInRight text-left" id="zoomInRight<?php echo $inst['categoryID']?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_service.php">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="courseCode">Category Name:</label>
                                <select class="form-control" name="category">
                                    <option value="1">Doctor Service</option>
                                    <option value="2">Test and Investigation</option>
                                    <option value="3">Other Service</option>
                                    <option value="4">Dressing and Procedure</option>
                                </select>
                            </div>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="courseCode">Category Name:</label>
                            <input type="text" value="<?php echo $inst['categoryName']; ?>" name="name" placeholder="Eg. Procedure" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Description</h3>
                            </div>
                        <div class="box-body pad">
                            <textarea class="textarea" name="description"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $inst['categoryDesc'];?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        <input  type="hidden" name="categoryID" value="<?php echo $inst['categoryID']; ?>"/>
                        <input  type="hidden" name="action_type" value="updateService"/>
                        <input type="submit" name="doSubmit" value="Update" class="btn btn-primary" tabindex="8">
                    </div>
            </div>
            </form>
     </div>
    </div>
 </div>
</div>                                          
 <!-- modal -->
                    <?php } } ?>
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
                <form name="" method="post" action="action_service.php">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="courseCode">Category Name:</label>
                                <select class="form-control" name="category">
                                    <option value="1">Doctor Service</option>
                                    <option value="2">Test and Investigation</option>
                                    <option value="3">Other Service</option>
                                    <option value="4">Dressing and Procedure</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="courseCode">Category Name:</label>
                                <input type="text" id="fname" name="name" placeholder="Eg. Procedure" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Description</h3>
                                    <div class="pull-right box-tools">
                                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                        title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                    <div class="box-body pad">
                        <textarea class="textarea" name="description" placeholder="Please type your text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                        </div>
        </div>
    </div>
        <div class="row">
        <br />
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
        <div id="subcategory" class="tab-pane fade">
            <h3>Sub Category</h3>
             <div class="row"> 
                <div class="col-md-12">
                    <section id="add-patient">
                        <div class="pull-right" style="margin-right:50px">
                            <a class="btn btn-info round btn-sm" data-toggle="modal"  data-target="#add_sub_category_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register New Sub Category</a>
                        </div>
                    </section> 
                 </div>
            </div><br><br>


<!-- Sub Category -->
<div class="row">
 <div class="col-md-12">   
<?php  
            $db = new DBHelper();
            $subcategory = $db->getRows('servicesubcategory',array('order_by'=>'subCategory asc'));
?>
<table  id="example2" class="table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th>Sub Category</th>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
  <tbody>
<?php 
if(!empty($subcategory)){
     $c=0;
      foreach($subcategory as $inst){ 
          $c++;
          
 ?>
            <tr>
                <td><?php echo $c;?></td>
                <td><?php echo $inst['subCategory'];?></td>
                <td><?php echo $db->getData("servicecategory","categoryName","categoryID",$inst['categoryID']);?></td>
                <td><?php echo $inst['description'];?></td>
                <td>
                     <a style="color:white;" class="btn mr-1 mb-1 btn-info btn-sm" data-toggle="modal" data-target="#zoomIn<?php echo $inst['categoryID']?>"><i class="ft-edit default"></i> Update</a>
                </td>
            </tr>
             <!-- Modal -->
    <div class="modal animated zoomInRight text-left" id="zoomIn<?php echo $inst['categoryID']?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_service.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="courseCode">Sub Category Name:</label>
                            <input type="text" value="<?php echo $inst['subCategory'] ;?>" name="name" placeholder="Eg. Procedure" class="form-control"/>
                        </div>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="courseCode">Service Category:</label>
                            <select name="categoryID"  class="form-control">
                                <option value="<?php echo $inst['categoryID']?>"><?php echo $db->getData("servicecategory","categoryName","categoryID",$inst['categoryID']);?></option>
                                <?php
                                $category = $db->getRows('servicecategory',array('order_by'=>'categoryName ASC'));
                                if(!empty($category)){
                                    echo "<option value=''>Select Here</option>";
                                    foreach($category as $dept){
                                    $categoryID=$dept['categoryID'];
                                    $categoryName=$dept['categoryName'];
                                ?>
                               <option value="<?php echo $categoryID;?>"><?php echo $categoryName;?></option>
                               <?php }}?>
							</select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Description</h3>
                            </div>
                        <div class="box-body pad">
                            <textarea class="textarea" name="description"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $inst['description'];?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        <input  type="hidden" name="subCategoryID" value="<?php echo $inst['subCategoryID']; ?>"/>
                        <input  type="hidden" name="action_type" value="UpdateSubcategory"/>
                        <input type="submit" name="doSubmit" value="Update" class="btn btn-primary" tabindex="8">
                    </div>
            </div>
            </form>
            
     <!-- </div> -->
    </div>
 </div>
</div>                                          
 <!-- modal -->
 <?php } } ?>     
</tbody>
 </table>
 </div></div>
           
           
           <!-- Add New health Facility -->
         <div class="modal fade" id="add_sub_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form name="" method="post" action="action_service.php">
                <div class="modal-body">
                <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                <label for="courseCode">Sub Category Name:</label>
                <input type="text" id="fname" name="name" placeholder="Eg. Internal Theatre" class="form-control"/>
                </div>
                </div></div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="email">Service Category: </label>
                            <select name="categoryID"  class="form-control">
                               <?php
                               $category = $db->getRows('servicecategory',array('order_by'=>'categoryName ASC'));
                               if(!empty($category)){
                                   echo "<option value=''>Select Here</option>";
                             foreach($category as $dept){
                                $categoryID=$dept['categoryID'];
                                $categoryName=$dept['categoryName'];
                               ?>
                               <option value="<?php echo $categoryID;?>"><?php echo $categoryName;?></option>
                               <?php }}?>
							</select>
                        </div>
                    </div>
                </div>

        <div class="row">
            <div class="col-lg-12">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Description </h3>
                <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body pad">
                <textarea class="textarea" name="description" placeholder="Please type your text here" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
        </div>
</div>
    <div class="row">
    <br />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
            <input type="hidden" name="action_type" value="addsubcategory"/>
            <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
        </div>
    </div>
</form>

</div>
</div>
</div>
</div>
<!-- End of Sub Category -->

 <!-- Health Facility -->       
        <div id="service" class="tab-pane fade">
            <h3>Health Services</h3>
             <div class="row"> 
                <div class="col-md-12">
                    <section id="add-patient">
                        <div class="pull-right" style="margin-right:50px">
                            <a class="btn btn-success  btn-sm" data-toggle="modal" data-target="#add_new_health_facility_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Service</a>
                        </div>
                    </section>  
                 </div>
            </div><br><br>
            <div class="row">
 <div class="col-md-12">   
<?php  
            $db = new DBHelper();
            $service = $db->getRows('service',array('order_by'=>'serviceName asc'));
?>
    <table  id="example3" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                
                <th>Service Name</th>
                <th>Servie Category</th>
                <th>Cash</th>
                <th>Credits</th>
                <th>Cost Sharing</th>
                <th>Insurance</th>
                <th>Fast Track</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
        <?php 
         $service = $db->getRows('service',array('order_by'=>'serviceID asc'));
        if(!empty($service)){ $count = 0; foreach($service as $inst){ $count++;
            $status = $inst['isActive'];
            $serviceID = $inst['serviceID'];
        ?>
            <tr>
                <td><?php echo $count;?></td>
                
                <td><?php echo $inst['serviceName'];?></td>
                <td><?php echo $db->getData("servicesubcategory","subCategory","subCategoryID",$inst['subCategoryID']);?></td>
                <td><?php echo number_format($inst['cash'],2);?></td>
                <td><?php echo number_format($inst['credits'],2);?></td>
                <td><?php echo number_format($inst['costsharing'],2);?></td>
                <td><?php echo number_format($inst['insurance'],2);?></td>
  				<td><?php echo number_format($inst['fasttrack'],2);?>
                  <td>
                    <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  title="Update Service"  data-toggle="modal" data-target="#facility<?php echo $inst['subCategoryID'];?>"><i class="ft-edit default"></i></button>
                    <?php
                    if($status == 1){?>
                         <a href='block_service.php?serviceID=<?php echo  $serviceID;?>'><button class="btn mr-1 mb-1 btn-danger btn-sm" style="color:white;"  title="Click to block"   data-toggle="modal" ><i class="ft-shield default"></i></button></a>
                         <?php
                    }else{?>
                        <a href='unblock_service.php?serviceID=<?php echo  $serviceID;?>'><button class="btn mr-1 mb-1 btn-success btn-sm" style="color:white;"  title="Click to unblock"   data-toggle="modal"><i class="ft-shield default"></i></button></a>
                        <?php
                    }
                   ?>
                </td>
            </tr>
             <!-- modal Facility -->
             <!-- //update -->
        <div class="modal animated zoomInRight text-left" id="facility<?php echo $inst['subCategoryID'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_service.php">
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Service Name: </label>
                                    <input type="text" id="lname" name="name" value="<?php echo $inst['serviceName'];?>" class="form-control" tabindex="3" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Service Category: </label>
                                    <select name="subCategoryID"  class="form-control">
                                    <option value="<?php echo $inst['subCategoryID']?>"><?php echo $db->getData("servicesubcategory","subCategory","subCategoryID",$inst['subCategoryID']);?></option>
                                                    <?php
                                                $category = $db->getRows('servicesubcategory',array('order_by'=>'subCategory ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                     foreach($category as $dept){
                                                    $subCategoryID=$dept['subCategoryID'];
                                                    $subCategory=$dept['subCategory'];
                                                ?>
                                                <option value="<?php echo $subCategoryID;?>"><?php echo $subCategory;?></option>
                                                <?php }}?>
                                        </select>
                                </div>
                            </div>
                      
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Clinical Service: </label>
                                    <select name="isrelated"  id="irelated" class="form-control" required>
                                    <?php 
                                    if($inst['IsRelated']==1){
                                        echo $ins = 'Yes';
                                    }else{
                                        echo $ins = 'No';
                                    }?>
                                    <option value="<?php echo $inst['IsRelated']?>"><?php echo $ins?></option>
                                    <option value="">Select Here</option>
                                              <option value="1">Yes</option>
                                              <option value="0">No</option>
                                              </select>
                                </div>
                            </div>
                            <div class="col-lg-6"id="clinicCode">
                                <div class="form-group">
                                    <label for="email">Clinic Name: </label>
                                    <select name="clinicCode"  class="form-control">
                                    <option value="<?php echo $inst['clinicCode']?>"><?php echo $db->getData("clinic","clinicName","clinicCode",$inst['clinicCode']);?></option>
                                                    <?php
                                                $category = $db->getRows('clinic',array('order_by'=>'clinicCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                     foreach($category as $dept){
                                                    $clinicCode=$dept['clinicCode'];
                                                    $clinicName=$dept['clinicName'];
                                                ?>
                                                <option value="<?php echo $clinicCode;?>"><?php echo $clinicName;?></option>
                                                <?php }}?>
                                        </select>
                                </div>
                            </div>
                        </div>
                           
                      
                        
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Cash: </label>
                                <input type="text" id="cashs" name="cash"value="<?php echo $inst['cash'];?>" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Credits: </label>
                                <input type="text" id="creditss" name="credits" value="<?php echo $inst['credits'];?>" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Fast Track: </label>
                                <input type="text" id="lname" name="fasttrack" value="<?php echo $inst['fasttrack'];?>" class="form-control" tabindex="3" />
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
                            <label for="email">Insurance: </label>
                            <input type="text" id="lname" name="insurance" value="<?php echo $inst['insurance'];?>" class="form-control" tabindex="3" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="serviceID" value="<?php echo $inst['serviceID'];?>"/>
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
            <?php } } ?>
</tbody>
 </table>
 </div>
 </div>
       
           
           
           <!-- Add New health Facility -->
         <div class="modal fade" id="add_new_health_facility_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <form name="" method="post" action="action_service.php">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Service Name: </label>
                                    <input type="text" id="lname" name="name" placeholder="Eg. HIV" class="form-control" tabindex="3" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Service Category: </label>
                                    <select name="subCategoryID"  class="form-control">
                                                    <?php
                                                $category = $db->getRows('servicesubcategory',array('order_by'=>'subCategory ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                     foreach($category as $dept){
                                                    $subCategoryID=$dept['subCategoryID'];
                                                    $subCategory=$dept['subCategory'];
                                                ?>
                                                <option value="<?php echo $subCategoryID;?>"><?php echo $subCategory;?></option>
                                                <?php }}?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Clinical Service: </label>
                                        <select name="isrelated"  id="irelated" class="form-control" required>
                                              <option value="">Select Here</option>
                                              <option value="1">Yes</option>
                                              <option value="0">No</option>
                                              
                                        </select>
                                </div>
                                </div>
                                <div class="col-lg-6" id="clinicCode">
                                <div class="form-group">
                                    <label for="email">Clinic Name: </label>
                                        <select name="clinicCode"   class="form-control">
                                                    <?php
                                                $category = $db->getRows('clinic',array('order_by'=>'clinicCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                     foreach($category as $dept){
                                                    $clinicCode=$dept['clinicCode'];
                                                    $clinicName=$dept['clinicName'];
                                                ?>
                                                <option value="<?php echo $clinicCode;?>"><?php echo $clinicName;?></option>
                                                <?php }}?>
                                        </select>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Cash: </label>
                                <input type="text" id="cashs" name="cash" placeholder="Eg.4000000" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Credits: </label>
                                <input type="text" id="creditss" name="credits" placeholder="Eg.4000000" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Fast Track: </label>
                                <input type="text" id="lname" name="fasttrack" placeholder="Eg.4000000" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Cost Sharing: </label>
                            <input type="text" id="costsharing" name="costsharing" placeholder="Eg.20000" class="form-control" tabindex="3" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Insurance: </label>
                            <input type="text" id="lname" name="insurance" placeholder="Eg.4000000" class="form-control" tabindex="3" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="action_type" value="addcategoryservice"/>
                        <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                    </div>
                </div>
            </form>
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
