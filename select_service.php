<style>
#serviceCost label.error {
    color: red;
    font-weight: bold;
}

.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#example3").DataTable({
        "processing": true,
        "paging": true,
        dom: 'Blfrtip',
        bLengthChange: true,
        "lengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 10,
        bInfo: false,
        "bAutoWidth": false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [
            [1, 'asc']
        ]
    });
});
</script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>
<?php 

if($_SESSION['msg'] == 'Data Inserted Successfully'){?>
<script>
alertify.set('notifier', 'position', 'bottom-right');
alertify.success("Inserted Successfully");
</script>
<?php
}elseif($_SESSION['msg'] == 'Data Already Exist'){?>
<script>
alertify.set('notifier', 'position', 'top-right');
alertify.warning("Data Already Exist");
</script>
<?php
}elseif($_SESSION['msg'] == 'Something Went Wrong'){?>
<script>
alertify.set('notifier', 'position', 'top-right');
alertify.error("Ooops! Something Went Wrong");
</script>

<?php
}
unset($_SESSION['msg']);

?>
<style>
.alertify-notifier .ajs-message.ajs-error {
    color: white;
}

.alertify-notifier .ajs-message.ajs-success {
    color: white;
}
</style>

<div class="card-content">
    <div class="card-body">
        <div class="card-header">
            <h2><i class="la la-home font-large-2 success"></i>Manage Hospital Services</h2>
        </div>
        <br>
        <h3>List of Available Services</h3>
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <section id="add-patient">
                        <div class="pull-right" style="margin-right:50px">
                            <a href="action_registered_services.php" class="btn btn-info  btn-sm"
                                style="color:white;"><i class="la la-plus font-small-2"></i>Register Hospital
                                service</a>
                        </div>
                    </section>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <?php  
                                $db = new DBHelper();
                                $service_offered = $db->getRows('serviceoffered',array('order_by'=>'serviceOfferedID DESC'));
                    ?>
                    <table id="example3" class="table" cellspacing="0" width="100%">
                        <thead class="">
                            <tr>
                                <th>No.</th>
                                <th>Service Name</th>
                                <th>Department</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
            if(!empty($service_offered)){ $count = 1; foreach($service_offered as $service){ 
                          
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $db->getData("service","serviceName","serviceCode",$service['serviceCode']);?>
                                </td>
                                <td><?php echo $db->getData("department","deptname","deptCode",$service['deptCode']);;?>
                                </td>
                                <td>
                                    <?php
                                    if($service['isActive'] == 1){?>
                                    <a class="btn  btn-danger btn-sm" style="color:white;"
                                        href="block_service_offered.php?serviceCode=<?php echo $service['serviceCode'];?>"><i
                                            class="ft-shield default"></i>Block</a>
                                    <?php
                                    }else{?>
                                    <a class="btn  btn-success btn-sm" style="color:white;"
                                        href="unblock_service_offered.php?serviceCode=<?php echo $service['serviceCode'];?>"><i
                                            class="ft-edit default"></i>Unblock</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!-- Modal zone -->
                            <div class="modal animated zoomInRight text-left"
                                id="department<?php echo $service_cost['service_costID'];?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel72">Update</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form name="" method="post" action="action_serviceCost.php">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="Cadre">Service Name: </label>
                                                            <select name="serviceCode" class="form-control">
                                                                <option
                                                                    value='<?php echo $service_cost['serviceCode'];?>'>
                                                                    <?php echo $db->getData("service","serviceName","serviceCode",$service_cost['serviceCode']);?>
                                                                </option>
                                                                <?php
                                                    $services = $db->getRows('serviceoffered',array('order_by'=>'serviceOfferedID ASC'));
                                                    if(!empty($services)){
                                                        echo "<option value=' '>Select Here</option>";
                                                        foreach($services as $serviceOffered){
                                                            $serviceCode=$serviceOffered['serviceCode'];
                                                            $paymenttypeName=$db->getData("service","serviceName","serviceCode",$serviceOffered['serviceCode']);
                                                ?>
                                                                <option value="<?php echo $serviceCode;?>">
                                                                    <?php echo $paymenttypeName;?></option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="Cadre">Payment Type: </label>
                                                            <select name="paymenttypeCode" class="form-control">
                                                                <option
                                                                    value='<?php echo $service_cost['paymenttypeCode'];?>'>
                                                                    <?php echo $db->getData("paymenttype","paymentTypeName","paymentTypeCode",$service_cost['paymenttypeCode']);?>
                                                                </option>
                                                                <?php
                            $payment_types = $db->getRows('available_payment_types',array('order_by'=>'available_paymenttypeCode ASC'));
                             echo "<option value=' '>Select Here</option>";
                            if(!empty($payment_types)){
                               
                                foreach($payment_types as $payment_type){
                                    $paymenttypeCode=$payment_type['paymenttypeCode'];
                                    $paymenttypeName=$db->getData("paymenttype","paymentTypeName","paymentTypeCode",$payment_type['paymenttypeCode']);
                        ?>
                                                                <option value="<?php echo $paymenttypeCode;?>">
                                                                    <?php echo $paymenttypeName;?></option>
                                                                <?php }}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="Cadre">Price: </label>
                                                            <input type="text" id="dname" name="Price"
                                                                value="<?php echo $service_cost['price'];?>"
                                                                class="form-control" tabindex="3" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"
                                                        tabindex="9">Cancel</button>
                                                    <input type="hidden" name="service_costID"
                                                        value="<?php echo $service_cost['service_costID'];?>" />
                                                    <input type="hidden" name="action_type" value="Updated" />
                                                    <input type="submit" name="doSubmit" value="Updated"
                                                        class="btn btn-primary" tabindex="8">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            <!-- modal -->

            <?php } }else{ ?>
            <tr>
                <td colspan="5">No Service Cost(s) found......</td>
                <?php } ?>
                </tbody>
                </table>
        </div>
    </div>

    <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form method="Post" action="action_serviceCost.php" id='serviceCost'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadre">Service Name: </label>
                                    <select name="serviceCode" class="form-control">
                                        <?php
                            $services = $db->getAvailableServive();
                            if(!empty($services)){
                                echo "<option value=' '>Select Here</option>";
                                foreach($services as $service){
                                    $serviceCode=$service['serviceCode'];
                                    $paymenttypeName=$db->getData("service","serviceName","serviceCode",$service['serviceCode']);
                        ?>
                                        <option value="<?php echo $serviceCode;?>"><?php echo $paymenttypeName;?>
                                        </option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadre">Payment Type: </label>
                                    <select name="paymenttypeCode" class="form-control">
                                        <?php
                            $payment_types = $db->getRows('available_payment_types',array('order_by'=>'available_paymenttypeCode ASC'));
                             echo "<option value=' '>Select Here</option>";
                            if(!empty($payment_types)){
                               
                                foreach($payment_types as $payment_type){
                                    $paymenttypeCode=$payment_type['paymenttypeCode'];
                                    $paymenttypeName=$db->getData("paymenttype","paymentTypeName","paymentTypeCode",$payment_type['paymenttypeCode']);
                        ?>
                                        <option value="<?php echo $paymenttypeCode;?>"><?php echo $paymenttypeName;?>
                                        </option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadre">Price: </label>
                                    <input type="text" id="dname" name="Price" placeholder="Eg.20,000"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>


                        </div>
                    </div>
                    <br />

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                        <input type="hidden" name="action_type" value="add" />
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
    $("#serviceCost").validate({

        // Passing the object with custom rules
        rules: {
            // login - is the name of an input in the form
            paymenttypeCodee: {
                required: true,
                // Setting email pattern for email input

            },
            serviceCodee: {
                required: true,
                // Setting email pattern for email input

            },
            Price: {
                required: true,
                digits: true

                // Setting minimum and maximum lengths of a password

            }
        },
        // Setting error messages for the fields
        messages: {
            paymenttypeCode: {
                required: "This Field is Required",

            },
            serviceCode: {
                required: "This Field is Required",

            },
            Price: {
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