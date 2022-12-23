<style>
#zone label.error {
    color: red;
    font-weight: bold;
}

#regionn label.error {
    color: red;
    font-weight: bold;
}

#districtt label.error {
    color: red;
    font-weight: bold;
}

#shehiaa label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}

</style>

 <script type="text/javascript" src="js/jquery.min.js"></script>
<?php $db=new DBHelper();?>
<div class="card-content">
  <div class="card-body">
       <div class="card-header">
         <h2>Manage Location</h2>
    </div>
    <ul class="nav nav-tabs nav-linetriangle no-hover-bg" id="myTab" style="margin-top:40px;">
        <li class="nav-item">
            <a href="#zone" aria-expanded="true" class="nav-link active " data-toggle="tab"><i class="la la-flag"></i> Zone</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#region" aria-expanded="false" class="nav-link"><i class="la la-flag"></i> Region</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#district" aria-expanded="false" class="nav-link"><i class="la la-flag"></i> District</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#shehia" aria-expanded="false" class="nav-link"><i class="la la-flag"></i> Shehia</a>
        </li>
    </ul>
    <div class="tab-content">
    <div id="zone" class="tab-pane active" style="margin-top:20px;">
    <h3>List of Zones</h3>
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
        <script type="text/javascript">
            $(document).ready(function () {
                $("#districtab").DataTable({
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
                $("#shehiaID").DataTable({
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
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_zone_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Zone</a>
                    </div>
                </section>
            </div>
            
        </div>
        <br><br>
     <div class="row">
        <div class="col-md-12">   
        <?php  
            $db = new DBHelper();
            $zone = $db->getRows('zone',array('order_by'=>'zoneCode ASC'));
            ?>
         <div class="table-responsive">
                <table class="table" id="zonetab">
                     <thead>
                         <tr>
                            <th>No</th>
                            <th>Zone Code</th>
                            <th>Zone Name</th>
                            <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                <?php 
                    if(!empty($zone)){ 
                        $count = 0; 
                        foreach($zone as $inst){
                             $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $inst['zoneCode']; ?></td>
                        <td><?php echo $inst['zoneName'] ?></td>
                        <td>
                             <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#zone<?php echo $inst['zoneID'];?>"><i class="ft-edit default"></i>Update</button>
                        </td>
                    </tr>
                 <!-- Modal zone -->
    <div class="modal animated zoomInRight text-left" id="zone<?php echo $inst['zoneID'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_location.php">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Zone Code: </label>
                                        <input type="text" id="lname" name="code" value="<?php echo $inst['zoneCode'];?>" class="form-control" required="required" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Zone Name: </label>
                                        <input type="text" id="lname" name="name" value="<?php echo $inst['zoneName'];?>" class="form-control" required="required" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                <input type="hidden" name="zoneID" value="<?php echo $inst['zoneID'];?>"/>
                                <input type="hidden" name="action_type" value="Updatezone"/>
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
         </div>

        <!--add Zone-->
        <div class="modal fade" id="add_new_zone_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                    </div>
                    <form name="" method="post" action="action_location.php" id='zonee'>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="zoneCode">Zone Code: </label>
                                        <input type="text" id="lname" name="code" placeholder="001" class="form-control"  autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="zoneName">Zone Name: </label>
                                        <input type="text" id="mname" name="name" placeholder="Eg. Pwani" class="form-control"  autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                <input type="hidden" name="action_type" value="addzone"/>
                                <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end add zone-->
</div>

        <!--Region-->
        <div id="region" class="tab-pane fade" style="margin-top:20px;">

            <h3>List of Region</h3>
            <div class="row">
                <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_region_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Region</a>
                    </div>
                </section>
                </div>
            </div><br><br>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $db = new DBHelper();
                    $region = $db->getRows('region',array('order_by'=>'zoneCode ASC'));
                    ?>
                    <table class="table" id="regiontab" cellspacing="0" width="100%" >
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Region Code</th>
                            <th>Region Name</th>
                            <th>Zone Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($region)){ $countrg = 0; foreach($region as $inst){ $countrg++;
                            ?>
                            <tr>
                                <td><?php echo $countrg; ?></td>
                                <td><?php echo $inst['regionCode']; ?></td>
                                <td><?php echo $inst['regionName'];?></td>
                                <td><?php echo $db->getData('zone','zoneName','zoneCode',$inst['zoneCode']);?></td>
                                <td>
                                     <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#region<?php echo $inst['regionCode'];?>"><i class="ft-edit default"></i>Update</button>  
                                </td>
                            </tr>
    <!-- Modal region -->
    <div class="modal animated zoomInRight text-left" id="region<?php echo $inst['regionCode'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_location.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Region Code: </label>
                                            <input type="text" id="lname" name="code" value="<?php echo $inst['regionCode'];?>"class="form-control" required="required" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Region Name: </label>
                                            <input type="text" id="lname" name="name"value="<?php echo $inst['regionName'];?>" class="form-control" required="required" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Zone Name: </label>
                                            <select name=zoneCode  class="form-control">
                                                <option value="<?php echo $inst['zoneCode'];?>"><?php echo $db->getData('zone','zoneName','zoneCode',$inst['zoneCode']);?></option>
                                                <?php
                                                $category = $db->getRows('zone',array('order_by'=>'zoneCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                    $count = 0; foreach($category as $dept){ $count++;
                                                        $zoneID=$dept['zoneCode'];
                                                        $zoneName=$dept['zoneName'];
                                                        ?>
                                                        <option value="<?php echo $zoneID;?>"><?php echo $zoneName;?></option>
                                                    <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                    <input type="hidden" name="regionCode" value="<?php echo $inst['regionCode'];?>"/>
                                    <input type="hidden" name="action_type" value="editregion"/>
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
            <!--add Zone-->
            <div class="modal fade" id="add_new_region_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form name="" method="post" action="action_location.php" id='regionn'>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Region Code: </label>
                                            <input type="text" id="RegionCode" name="code" placeholder="001" class="form-control" required="required" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Region Name: </label>
                                            <input type="text" id="RegionName" name="name" placeholder="Eg. Pwani" class="form-control" required="required" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Zone Name: </label>
                                            <select name=zoneCode  class="form-control">
                                                <?php
                                                $category = $db->getRows('zone',array('order_by'=>'zoneCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                         foreach($category as $dept){
                                                        $zoneID=$dept['zoneCode'];
                                                        $zoneName=$dept['zoneName'];
                                                        ?>
                                                        <option value="<?php echo $zoneID;?>"><?php echo $zoneName;?></option>
                                                    <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                    <input type="hidden" name="action_type" value="addregion"/>
                                    <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
 <!--end add zone-->

 <!--end of Region-->
        <div id="district" class="tab-pane fade" style="margin-top:20px;">
                    <h3>List of District</h3>
            <div class="row">
                <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_district_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register District</a>
                    </div>
                </section>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                <?php
                            $db = new DBHelper();
                            $district = $db->getRows('district',array('order_by'=>'regionCode ASC'));
                ?>
                    <table class="table" id="districtab" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>District Code</th>
                                <th>District Name</th>
                                <th>Region</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        <tbody>
                                <?php
                                if(!empty($district)){ $count = 0; foreach($district as $inst){ $count++;
                                ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $inst['districtCode']; ?></td>
                                    <td><?php echo $inst['districtName'] ;?></td>
                                    <td><?php echo $db->getData("region","regionName","regionCode",$inst['regionCode']);?></td>
                                    <td>
                                         <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#destrict<?php echo $inst['districtID'];?>"><i class="ft-edit default"></i>Update</button>  
                                    </td>
                                </tr>
    <!-- Modal destrict -->
    <div class="modal animated zoomInRight text-left" id="destrict<?php echo $inst['districtID'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_location.php" >
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="District Code">District Code: </label>
                                            <input type="text" id="regionCode" name="code" value="<?php echo $inst['districtCode'];?>"" class="form-control" required="required" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="District Name">District Name: </label>
                                            <input type="text" id="regionName" name="name" value="<?php echo $inst['districtName'];?>" class="form-control" required="required" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Region Name">Region Name: </label>
                                            <select name=regionCode  class="form-control">
                                                <option value="<?php echo $inst['regionCode'];?>"><?php echo $db->getData("region","regionName","regionCode",$inst['regionCode']);?></option>
                                                <?php
                                                $category = $db->getRows('region',array('order_by'=>'regionCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                        foreach($category as $dept){
                                                        $regionID=$dept['regionCode'];
                                                        $regionName=$dept['regionName'];
                                                        ?>
                                                        <option value="<?php echo $regionID;?>"><?php echo $regionName;?></option>
                                                    <?php }}
                                                else
                                                {
                                                    ?>
                                                    <option value="">No Region Found</option>
                                                <?php
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                    <input type="hidden" name="districtID" value="<?php echo $inst['districtID'];?>"/>
                                    <input type="hidden" name="action_type" value="editdistrict"/>
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

            <div class="modal fade" id="add_new_district_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form name="" method="post" action="action_location.php" id='districtt'>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="District Code">District Code: </label>
                                            <input type="text" id="regionCode" name="code" placeholder="Eg.RC001" class="form-control"  autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="District Name">District Name: </label>
                                            <input type="text" id="regionName" name="name" placeholder="Eg. Mjini" class="form-control" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="Region Code">Region Name: </label>
                                            <select name=regionCode  class="form-control" id='RegionCode'>
                                                <?php
                                                $category = $db->getRows('region',array('order_by'=>'regionCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                        foreach($category as $dept){
                                                        $regionID=$dept['regionCode'];
                                                        $regionName=$dept['regionName'];
                                                        ?>
                                                        <option value="<?php echo $regionID;?>"><?php echo $regionName;?></option>
                                                    <?php }}
                                                else
                                                {
                                                    ?>
                                                    <option value="">No Region Found</option>
                                                <?php
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                    <input type="hidden" name="action_type" value="adddistrict"/>
                                    <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
             </div>
        </div>
        <div id="shehia" class="tab-pane fade" style="margin-top:20px;">
            <h3>List of Shehia</h3>
         <div class="row"> 
            <div class="col-md-12">
                <section id="add-patient">
                    <div class="pull-right" style="margin-right:50px">
                        <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_shehia_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Shehia</a>
                    </div>
                 </section>
             </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12">   
            <?php
                $db = new DBHelper();
                $shehia = $db->getRows('shehia',array('order_by'=>'shehiaID ASC'));
            ?>
            <table class="table" id="shehiaID" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>No.</th>
                <th>Shehia Code</th>
                <th>Shehia Name</th>
                <th>District Name</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(!empty($shehia)){$count = 0;
                    foreach($shehia as $inst){$count++;

                ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $inst['shehiaCode'] ?></td>
                                <td><?php echo $inst['shehiaName']; ?></td>
                                <td><?php echo $db->getData("district","districtName","districtID",$inst['districtID']); ?></td>
                                <td>
                                <button class="btn mr-1 mb-1 btn-info btn-sm" style="color:white;"  data-toggle="modal" data-target="#shehia<?php echo $inst['shehiaID'];?>"><i class="ft-edit default"></i>Update</button>  
                                </td>
                            </tr>
     <!-- Modal shehia -->
    <div class="modal animated zoomInRight text-left" id="shehia<?php echo $inst['shehiaID'];?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="" method="post" action="action_location.php">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email">Shehia Code: </label>
                                    <input type="text" id="lname" name="code" value="<?php echo $inst['shehiaCode'];?>" class="form-control"required="required" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email">Shehia Name: </label>
                                    <input type="text" id="lname" name="name" value="<?php echo $inst['shehiaName'];?>" class="form-control" required="required" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email">District Name: </label>
                                    <select name="districtID"  class="form-control">
                                        <option value="<?php echo $inst['districtID'];?>"><?php echo $db->getData("district","districtName","districtID",$inst['districtID']); ?></option>
                                        <?php
                                                $category = $db->getRows('district',array('order_by'=>'regionCode ASC'));
                                                if(!empty($category)){
                                                    echo "<option value=''>Select Here</option>";
                                                    foreach($category as $dept){
                                                    $districtID=$dept['districtID'];
                                                    $districtName=$dept['districtName'];
                                                ?>
                                                <option value="<?php echo $districtID;?>"><?php echo $districtName;?></option>
                                      <?php }}?>
							</select>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                    <input type="hidden" name="shehiaID" value="<?php echo $inst['shehiaID'];?>"/>
                    <input type="hidden" name="action_type" value="editshehia"/>
                    <input type="submit" name="doSubmit" value="Update" class="btn btn-primary" tabindex="8">
                </div>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>                                          
 <!-- modal -->
                            <?php } }?>
                </tbody>
                </table>
            </div>
        </div>
  
    <div class="modal fade" id="add_new_shehia_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form name="" method="post" action="action_location.php" id='shehiaa'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Shehia Code">Shehia Code: </label>
                                    <input type="text" id="name" name="code" placeholder="001" class="form-control"required="required" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Shehia Name">Shehia Name: </label>
                                    <input type="text" id="shehianame" name="name" placeholder="Eg. Kwahani" class="form-control" required="required" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="District Name">District Name: </label>
                                    <select name="districtID"  class="form-control">
                               <?php
                                    $category = $db->getRows('district',array('order_by'=>'regionCode ASC'));
                                    if(!empty($category)){
                                        echo "<option value=''>Select Here</option>";
                                        foreach($category as $dept){
                                        $districtID=$dept['districtID'];
                                        $districtName=$dept['districtName'];
                                    ?>
                                    <option value="<?php echo $districtID;?>"><?php echo $districtName;?></option>
                                    <?php }}?>
							</select>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                    <input type="hidden" name="action_type" value="addshehia"/>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
  // Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#zonee").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            code : {
                required : true,
                // digits:true
                // Setting email pattern for email input
               
            },
            name : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            }
        },
        // Setting error messages for the fields
        messages: {
            code: {
                required: "This Field is Required",
                //digits:true
               
            },
            name:{
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
$().ready(function() {
    // Selecting the form and defining validation method
    $("#regionn").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            code : {
                required : true,
                // digits:true
                // Setting email pattern for email input
               
            },
            name : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            zoneCode : {
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
            zoneCode:{
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
$().ready(function() {
    // Selecting the form and defining validation method
    $("#districtt").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            code : {
                required : true,
                // digits:true
                // Setting email pattern for email input
               
            },
            name : {
                required : true,
                // Setting minimum and maximum lengths of a password
                
            },
            regionCode : {
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
            regionCode:{
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
$().ready(function() {
    // Selecting the form and defining validation method
    $("#shehiaa").validate({
        
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
            districtID : {
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
            districtID:{
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