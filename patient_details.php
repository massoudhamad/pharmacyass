<script type="text/javascript">
    $(document).ready(function () {
        $('#newtest').DataTable(
            {
                scrollX: false,
                paging: true,

            });
    });
</script>
<div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-user-plus font-large-2 success"></i>List Of Requested Service</h2>
                    </div>
        
                <?php
                $db = new DBHelper();

                $patientNo=$_REQUEST['patientNo'];
                $visitNo=$_REQUEST['visitNo'];
                $patientvisit=$db->getRows('patientvisit',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo),'order_by'=>'patientNo DESC'));
                if(!empty($patientvisit))
                {
                $x = 0;
                foreach ($patientvisit as $pvisits) {
                    $x++;
                    $patientNo = $pvisits['patientNo'];
                    $visitDate=$pvisits['visitDate'];

                    $patients = $db->getRows('patient', array('where' => array('patientNo' => $patientNo), 'order_by' => 'patientNo DESC'));
                    if (!empty($patients)) {
                        foreach ($patients as $patient) {
                            $fname = $patient['firstName'];
                            $mname = $patient['middleName'];
                            $lname = $patient['lastName'];
                            $dob = $patient['dob'];
                            $sex = $patient['sex'];
                            $address = $patient['address'];
                            $telNumber = $patient['telNumber'];
                            $healthSchemeID = $patient['healthSchemeID'];
                            $healthScheme = $db->getData("healthscheme", "healthScheme", "healthSchemeID", $healthSchemeID);
                            $name = "$fname $mname $lname";
                            $visitStatus=$db->getData("patientvisit","visitStatus"," visitNo","visitStatus");
                            //   echo  $visitStatus;
                            //$patient['visitStatus'];
                        }
                    }
                }

                //'where'=>array('subCategoryID'=>),
                $services = $db->getRows('service', array('order_by' => 'subCategoryID ASC'));
                ?>
                <div style="margin-top:30px;">
                    <div class="card">
                        <h3 style="margin-left:30px;margin-top:20px;">Patient Information</h3>
                     <div class="card-body">
                        <table class="table table-striped table-bordered patients-list" id="example">
                                    <tr>
                                        <th>Patient No</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>Address</th>
                                        <th>Health Scheme</th>
                                        <th>Visit No</th>
                                        <th>Visit Date</th>
                                        <th>Visit Status</th>
                                        
                                    </tr>
                                    <tr>
                                        <td><?php echo $patientNo; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $db->ageCalculator($dob); ?></td>
                                        <td><?php echo $sex; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $healthScheme; ?></td>
                                        <td><?php echo $visitNo;?></td>
                                        <td><?php echo $visitDate;?></td>
                                        <?php
                                        if($visitStatus==0)
                                        {?>
                                        <td>
                                            <a href="action_close_visit.php?action_type=close&patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>" class="label label-success" onclick="return confirm('Are you sure You want to Close Patient Visit?');" title="Click to close visit">Open</a></td>
                                        <?php }
                                        else
                                        {
                                        ?>
                                        <td><span class="label label-danger">Closed</span></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>

                                </table>
                     <hr style="margin-top:110px;margin-bottom:60px;">    
                    <?php
                    if($visitStatus==0) {
                        ?>
                        <div class="pull-right" style="margin-top:30px;margin-bottom:25px;">
                            <a href="index3.php?sp=addvisit&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"><span
                                            class="btn btn-info pull-right">Add New Service</span></a>
                        </div>
                        <?php
                    }
                        ?>
                   
                
                    <div>
                        <h3 style="margin-left:30px;margin-bottom:20px;">Requested Services</h3>
                    </div>

                <?php
                $patientservice=$db->getPatientService($patientNo,$visitNo);
                if(!empty($patientservice)) {

                    ?>
                            <table class="table table-striped table-bordered patients-list" id="example">
                                <thead>
                                <tr>
                                    <th width="5px">No.</th>
                                    <th>Services Name</th>
                                    <th>Category Name</th>
                                    <th>Payment Scheme</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count = 0;
                                    foreach ($patientservice as $service) {
                                        $count++;
                                        $id = $service['servicesID'];
                                        $name = $db->getData("service", "serviceName", "serviceID", $id);
                                        $healthSchemeID=$service['healthSchemeID'];
                                        $price=$service['price'];
                                        $subCatID = $db->getData("service", "subCategoryID", "serviceID", $id);
                                        $CatID = $db->getData("servicesubcategory", "categoryID", "subCategoryID", $subCatID);
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $db->getData("servicecategory", "categoryName", "categoryID", $CatID); ?></td>
                                            <td><?php echo $db->getData("healthscheme", "healthScheme", "healthSchemeID", $healthSchemeID); ?></td>
                                            <td><?php echo number_format($price, 2); ?></td>
                                            <td><a href="index3.php?sp=delete&pid=<?php echo $db->my_simple_crypt($patientNo,'e')?>&vid=<?php echo $db->my_simple_crypt($visitNo,'e') ?>" name="delete" onclick="return confirm('Are sure want to delete this service')"><i class="la la-trash" title="Remove Service"></i></a><td>
                                           
                                        </tr>
                                    <?php }
                                }else{ ?>
                                <tr>
                                    <td colspan="4">No Services(s) found......</td>
                                    <?php } ?>
                                </tbody>
                                </tr>
                            </table>
                            <div class="row" style="margin-top:20px;">
                            <div class="pull-left" style="margin-left:85%;">
                                <a href="index3.php?sp=triageinfo&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"<span class="btn btn-success">Proceed</span></a>
                            </div>
                            <div class="col-1">
                                <input type="hidden" name="action_type" value="cancel"/>
                                <input type="submit" name="docancel" value="Print Bills" class="btn btn-success">
                            </div>
                            </div>
                    <!-- <div class="row">
                        <div class="col-lg-9"></div>
                        <input type="hidden" name="number_applicants" value="<?php echo $i; ?>">
                        <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
                        <input type="hidden" name="patientNo" value="<?php echo $patientNo; ?>">
                        <div class="row">
                        <div class="col-6">
                                <input type="hidden" name="action_type" value="add"/>
                                <input type="submit" name="doUpdate" value="Print Report" class="btn btn-info">
                            </div>

                            <div class="col-2">
                                <input type="hidden" name="action_type" value="cancel"/>
                                <input type="submit" name="docancel" value="Print Bills" class="btn btn-info">
                            </div>
                        </div>
                        </div> -->
                    </div>
                    </div>
                            <!-- /.box-body -->
                      </div>  
                    </div>
                </div>

                    <?php
                }
                ?>
            </div>
   


