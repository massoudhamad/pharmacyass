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
        <div class="col-12">
            <div  class="card-header">
                 <h2> <i class="la la-user font-large-2 info"></i>List Of All Services</h2>
            </div>
        </div>
    
     <div class="content-wrapper">
        <div class="col-md-12">
             <div class="card">
                    <div  class="card-body">
                    <?php
                    //require_once('DB.php');
                $db = new DBHelper();

                $patientNo=$_REQUEST['patientNo'];
                $patients = $db->getRows('patient',array('where'=>array('patientNo'=>$patientNo)));
                if(!empty($patients))
                {
                    $x=0;
                    foreach ($patients as $patient)
                    {
                        $x++;
                        $patientNo=$patient['patientNo'];
                        $fname=$patient['firstName'];
                        $mname=$patient['middleName'];
                        $lname=$patient['lastName'];
                        $dob=$patient['dob'];
                        $sex=$patient['sex'];
                        $address=$patient['address'];
                        $telNumber=$patient['telNumber'];
                        $name="$fname $mname $lname";

                        $healthSchemeID=$patient['healthSchemeID'];
                        $healthScheme=$db->getData("healthscheme","healthScheme","healthSchemeID",$healthSchemeID);
                    }
                }

                //'where'=>array('subCategoryID'=>),
                ?>
                        
                                <table class="table table-striped table-bordered patients-list" id="example">
                                    <tr>
                                        <th>Patient No</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>Address</th>
                                        <th>Health Scheme</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $patientNo;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $db->ageCalculator($dob);?></td>
                                        <td><?php echo $sex;?></td>
                                        <td><?php echo $address;?></td>
                                        <td><?php echo $healthScheme;?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                        <?php include "test.php"?>
                       
                <hr>
               
                    <form name="" method="post" action="">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                   
                                    <select name="categoryID" class="form-control chosen-select" required="">
                                        <?php
                                        $category = $db->getRows('servicecategory', array('order_by' => 'categoryName ASC'));
                                        if(!empty($category)){
                                            echo"<option value=''>Select Service Name</option>";
                                            $count = 0; foreach($category as $cat){ $count++;
                                                $catName=$cat['categoryName'];
                                                $catID=$cat['categoryID'];
                                                ?>
                                                <option value="<?php echo $catID;?>"><?php echo $catName;?></option>
                                            <?php }}
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                   
                                    <input type="submit" name="doSearch" value="Search Records" class="btn btn-info" />
                                </div>
                            </div>
                            </form>
                        </div>
                    
                        <hr>
                
                        <div class="row">
                        </div>
                            <?php
                            //Save Records Buttoon
                            if((isset($_POST['doSearch'])=="Search Records")||(isset($_REQUEST['action'])=="getRecords")) {
                                if (isset($_POST['doSearch']) == "Search Records") {
                                    $categoryID = $_POST['categoryID'];
                                } else {
                                    $categoryID = $_REQUEST['categoryID'];
                                }
                                ?>

                                <form name="register" id="register" method="post" action="action_patient_service.php">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>Payment during the visit:</label>
                                            <select name="healthSchemePaymentID" class="form-control" required>
                                                <?php
                                                echo "<option value='$healthSchemeID'>$healthScheme</option>";
                                                $healthScheme = $db->getRows('healthscheme', array('order_by' => 'healthScheme DESC'));
                                                if (!empty($healthScheme)) {
                                                    $count = 0;
                                                    foreach ($healthScheme as $hscheme) {
                                                        $count++;
                                                        $healthSchemeID = $hscheme['healthSchemeID'];
                                                        $healthScheme = $hscheme['healthScheme'];
                                                        ?>
                                                        <option value="<?php echo $healthSchemeID;?>"><?php echo $healthScheme; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                            <br>
                                        </div>
                                        <div class="col-2">
                                            <label>Pass through Triage:</label>
                                            <select name="triage" class="form-control" required>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <br>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered patients-list" id="example" >
                                        <thead>
                                        <tr>
                                            <!-- <th width="10"><input type="checkbox" name="select_all" id="select_all"> -->
                                            <th></th>
                                            <th width="5px">No.</th>
                                            </th>
                                            <th>Services Name</th>
                                            <th>Category Name</th>
                                            <th>Cash</th>
                                            <th>Credits</th>
                                            <th>Fast Track</th>
                                            <th>Government</th>
                                            <th>Health Insurance</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        //$services = $db->getRows('service',array('where'=>array('categoryID'=>$categoryID),'order_by'=>'subCategoryID ASC'));
                                        $services = $db->getService($categoryID);
                                        if (!empty($services)){
                                            $count = 0;
                                            foreach ($services as $service) {
                                                $count++;
                                                $id = $service['serviceID'];
                                                $name = $service['serviceName'];
                                                $cash = $service['cash'];
                                                $credits = $service['credits'];
                                                $insurance = $service['insurance'];
                                                $costsharing = $service['costsharing'];
                                                $fasttrack = $service['fasttrack'];
                                                $catID = $service['subCategoryID'];
                                                ?>
                                                <tr>
                                                     <td><input type='checkbox' class='checkbox_class' name='id[]'value='<?php echo $id; ?>'></td>
                                                    <td><?php echo $count; ?></td>
                                                   
                                                    <td><?php echo $name ?></td>

                                                    <td><?php echo $db->getData("servicesubcategory", "subCategory", "subCategoryID", $catID); ?></td>

                                                    <td><?php echo number_format($cash, 2); ?></td>
                                                    <td>
                                                        <?php echo number_format($credits, 2); ?>
                                                    </td>

                                                    <td><?php echo number_format($fasttrack, 2); ?></td>
                                                    <td><?php echo number_format($costsharing, 2); ?></td>
                                                    <td><?php echo number_format($insurance, 2); ?></td>
                                                    <td><span class="label label-success">Available</span></td>
                                                </tr>
                                            <?php }
                                        }
                                        ?>
                                        </tbody>
                                        <tr>

                                        </tr>
                                    </table>
                                    <div class="row">
                                        <div class="col-lg-9"></div>
                                        <input type="hidden" name="number_applicants" value="<?php echo $id; ?>">
                                        <input type="hidden" name="patientNo" value="<?php echo $patientNo; ?>">
                                        <div class="col-12"></div>
                                        <div class="col-2">
                                            <input type="hidden" name="action_type" value="add"/>
                                            <input type="submit" name="doUpdate" value="Save Records" class="btn btn-info">
                                        </div>
                                    <div class="pull-right">
                                        <div class="col-2">
                                            <input type="hidden" name="action_type" value="cancel"/>
                                            <input type="submit" name="docancel" value="Cancel" class="btn btn-info">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                </form>
                                <?php
                            }
                            ?>
            </div>
        </div>
    </div>




