<style>
.main {
    width: 600px;
    margin: 0 auto;
}
.alertify-notifier .ajs-message.ajs-error{
    color: white;
}
.alertify-notifier .ajs-message.ajs-success{
    color: white;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#patientdata").DataTable({
            dom: 'Blfrtip',
            paging:true,
            buttons:[
                {
                    extend:'excel',
                    title: 'List of all Staff',
                    footer:false,
                    exportOptions:{
                        columns: [0, 1, 2, 3,5,6,7]
                    }
                },
                ,
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Staff',
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
</script>
  <script src="js/jquery-3.3.1.min.js"></script>
    <script src="alertifyjs/alertify.js"></script>
    <script src="alertifyjs/alertify.min.js"></script>
<?php 

session_start();
if($_SESSION['msg']){?>
    <script>
    alertify.set('notifier','position', 'bottom-right');
    alertify.success("Staff Registered Successfully");
    </script>
<?php
}
unset($_SESSION['msg']);
?>


<div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-user-plus font-large-2 success"></i>List of Registered Users</h2>
                    </div>
                </div>
            </div>
            <div class="content-body">
    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               
                                     <div class="pull-right" style="margin-right:40px">
                                         <a href="index3.php?sp=registerstaff" class="btn btn-info round btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Register User</a>
                                     </div>
                             
                            </div>
                           <div class="table-responsive">
                                    <table  id="patientdata" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <!-- <th>Employee No</th> -->
                                                    <th style="width:150px;">FullName</th>
                                                    <th>Physical Address</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Education Level</th>
                                                    <th>Award</th>
                                                    <th>Phone Number</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $db = new DBHelper();
                                                $staff = $db->getRows('staff',array('order_by'=>'staffId ASC'));
                                                ?>
                                                <?php if(!empty($staff))
                                                    {
                                                        
                                                        $x=0;
                                                        foreach ($staff as $st)
                                                        {
                                                            $x++;
                                                            $staffId=$st['staffId'];
                                                            $firstName=$st['firstname'];
                                                            $middleName=$st['middlename'];
                                                            $lastName=$st['lastname'];
                                                            $physicalAddress=$st['physicalAddress'];
                                                            $dateofbirth=$st['dateofbirth'];
                                                            $eduLevel=$st['eduLevel'];
                                                            $award=$st['award'];
                                                            $phone=$st['tell'];
                                                           
                                                            
                                                        ?>
                                                <tr>
                                                    <td><?php echo $x;?></td>
                                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName;?></td>
                                                    <td><?php echo $physicalAddress;?></td>
                                                    <td><?php echo $dateofbirth;?></td>
                                                    <td><?php echo $eduLevel; ?></td>
                                                    <td><?php echo $award;?></td>
                                                    <td><?php echo $phone;?></td>
                                                    <td>
                                                        <a type="button" class="btn  btn-info btn-sm" title="Update Staff Information" href="index3.php?sp=edit_staff&id=<?php echo $db->my_simple_crypt($staffId,'e')?>"><i class="ft-edit" ></i></a>
                                                     </td>
                                                </tr>
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
       
    