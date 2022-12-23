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
                        <h2> <i class="la la-user-plus font-large-2 success"></i>List of Registered Patients</h2>
                    </div>
                </div>
            </div>
            <div class="content-body">
    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               
                                     <div class="pull-right" style="margin-right:40px">
                                         <a href="index3.php?sp=add_patient" class="btn btn-info round btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Register Patient</a>
                                     </div>
                             
                            </div>
                           <div class="table-responsive">
                                    <table  id="patientdata" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <!-- <th>Patient No</th> -->
                                                    <th>FullName</th>
                                                    <th>Sex</th>
                                                    <th>Age</th>
                                                    <th>Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Health Scheme</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $db = new DBHelper();
                                                $patients = $db->getRows( 'patient', array('order_by'=>'patientNo ASC') );
                                                // $patients = $db->getPatientInfo();
                                                ?>
                                                <?php if(!empty($patients))
                                                    {
                                                        
                                                        $x=0;
                                                        foreach ($patients as $patient)
                                                        {
                                                            $x++;
                                                            $patientNo=$patient['patientNo'];
                                                            $firstName=$patient['firstName'];
                                                            $middleName=$patient['middleName'];
                                                            $lastName=$patient['lastName'];
                                                            $sex=$patient['sex'];
                                                            $age=$patient['dob'];
                                                            $Address=$patient['address'];
                                                            $phone=$patient['telNumber'];
                                                            $paymenttypecode=$patient['paymenttypeCode'];
                                                            $visitNo=$patient['visitNo'];
                                                            
                                                        ?>
                                                <tr>
                                                    <td><?php echo $x;?></td>
                                                    <!-- <td><?php echo $patientNo?></td> -->
                                                    <td><?php echo $fullName = $firstName." ".$middleName." ".$lastName;?></td>
                                                    <td><?php echo $sex;?></td>
                                                    <td><?php echo $db->ageCalculator($age); ?></td>
                                                    <td><?php echo $Address;?></td>
                                                    <td><?php echo $phone;?></td>
                                                    <td><?php echo $db->getData("paymenttype","paymentTypeName","paymentTypeCode",$paymenttypecode);?></td>
                                                    <td>
                                                        <a  title="View and Update Patient Information" class="btn  btn-info btn-sm" href="index3.php?sp=profile&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>&visitNo=<?php echo $visitNo?>"><i class="ft-eye" title="View and Update Patient Information"></i></a>
                                                        <a  class="btn  btn-info btn-sm" title="Update Patient Information" href="index3.php?sp=edit_patient&id=<?php echo $db->my_simple_crypt($patientNo,'e')?>"><i class="ft-edit" ></i></a>
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
       
    