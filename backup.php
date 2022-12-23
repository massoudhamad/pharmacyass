<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#patientdata").DataTable({
            dom: 'Blfrtip',
            paging:true,
            buttons:[
                {
                    extend:'excel',
                    title: 'List of all Patient',
                    footer:false,
                    exportOptions:{
                        columns: [0, 1, 2, 3,5,6,7]
                    }
                },
                ,
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Patient',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3,5,6,7]
                    },

                }

            ],
            order: []
        });
    });
</script>

<div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-user-plus font-large-2 success"></i>Hospital Back Up Time</h2>
                    </div>
                </div>
            </div>
            <div class="content-body">
    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               
                                     <div class="pull-right" style="margin-right:40px">
                                     <a class="btn btn-info  btn-sm" data-toggle="modal" data-target="#add_new_zone_modal"
                                    style="color:white;"><i class="la la-plus font-small-2"></i>Add Backup Time</a>
                                     </div>
                             
                            </div>
                           <div class="table-responsive">
                                    <table  id="patientdata" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <!-- <th>Patient No</th> -->
                                                    <th>Back up Time</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $db = new DBHelper();
                                                $backup_time_setting = $db->getRows('backup_time',array('order_by'=>'time_id ASC'));
                                                ?>
                                                <?php if(!empty($backup_time_setting))
                                                    {
                                                        
                                                        $x=0;
                                                        foreach ($backup_time_setting as $patient)
                                                        {
                                                            $x++;
                                                            $time=$patient['backup_time'];
                                                            $description=$patient['description'];
                                                            
                                                            
                                                        ?>
                                                <tr>
                                                    <td><?php echo $x;?></td>
                                                    <td><?php echo $time?></td>
                                                    <td><?php echo $description?></td>
                                                    <td>
                                                    <button class="btn btn-info btn-sm" style="color:white;" data-toggle="modal"
                                                data-target="#time<?php echo $patient['time_id'];?>"><i class="ft-edit default"></i>Update</button>
                                                     </td>
                                                </tr>
                                                <!-- Modal zone -->
                                    <div class="modal animated zoomInRight text-left"
                                        id="time<?php echo $patient['time_id'];?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel72">Update</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form name="" method="post" action="action_backup_time.php" id='backup'>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="email">Backup Time: </label>
                                                                    <input type="time" id="lname" name="backup_time"
                                                                        value="<?php echo  $patient['backup_time'];?>"
                                                                        class="form-control" required="required"
                                                                        autocomplete="off" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="email">Description: </label>
                                                                    <textarea rows="" cols="" class="form-control" required="required" name="description"><?php echo $patient['description'];?></textarea>
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal" tabindex="9">Cancel</button>
                                                            <input type="hidden" name="time_id"
                                                                value="<?php echo $patient['time_id'];?>" />
                                                            <input type="hidden" name="action_type"
                                                                value="editbackup" />
                                                            <input type="submit" name="doSubmit" value="Update"
                                                                class="btn btn-primary" tabindex="8">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                                <?php }
                                                    }
                                                ?>
                                            
                                            </tbody>

                                        </table>
   
                            </div>
                        </div>
                    </div>
                </div></div>

            </div>
            <!--add Backup time-->
            <div class="modal fade" id="add_new_zone_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Add Back up Time</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form name="" method="post" action="action_backup_time.php" id='backup'>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="zoneCode">Time: </label>
                                            <input type="time" max="12:10"  min="12:40" id="lname" name="backup_time" placeholder="10:00 AM"
                                                class="form-control" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="zoneName">Time Description: </label>
                                            <textarea rows="" cols=""name="description" placeholder="Eg. BackUp Description Goes Here..." class="form-control"></textarea> 
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"
                                        tabindex="9">Cancel</button>                                   
                                    <input type="hidden" name="action_type" value="addbackup" />
                                    <input type="submit" name="doSubmit" value="Save" class="btn btn-primary"
                                        tabindex="8">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end add zone-->
       
    