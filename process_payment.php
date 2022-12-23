<!-- BEGIN: Content-->
<?php 
     $hospital_code=$_SESSION['hospitalCode'];
     $hospitalName=$auth_user->getData("hospital","hospitalName","hospitalCode",$hospital_code);
         $db = new DBHelper();
         $patientNo = $_REQUEST['patientNo'];
         $visitNo = $_REQUEST['visitNo'];
         $address = $db->getData("patient", "address", "patientNo", $patientNo);
         $firstName = $db->getData("patient", "firstName", "patientNo", $patientNo);
         $middleName = $db->getData("patient", "middleName", "patientNo", $patientNo);
         $lastName = $db->getData("patient", "lastName", "patientNo", $patientNo);
         $name = $firstName." ".$middleName." ".$lastName;
          $patientservice=$db->getPatientService($patientNo,$visitNo);
      ?>

<div class="content-wrapper">
    <div class="content-body">
        <section class="card">
            <div id="invoice-template" class="card-body">
                <div id="invoice-company-details" class="row">
                    <div>
                        <h1><b>Service Payment</b></h1>
                        <?php                  
                                    if(!empty($patientservice)) {
                                    
                                    $total = 0;
                                    foreach ($patientservice as $service) {
                                    $price=$service['price'];
                                    $total = $total+ $price;
                                ?>
                        <?php }}?>
                    </div>
                </div>
                <div id="invoice-customer-details" class="row pt-2">
                    <div class="col-md-6 col-sm-12 text-center text-md-left">
                        <ul class="px-0 list-unstyled">
                            <li class="text-bold-800"><b><?php echo $name ?></b></li>
                            <li><b><?php echo $patientNo ?></b></li>
                            <li><b><?php echo $address?></b></li>
                        </ul>
                    </div>
                </div>
                <div id="invoice-items-details" class="pt-2">
                    <div class="container-fluid">
                        <div class="table-responsive col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Service</th>
                                        <th>Payment Scheme</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                         if(!empty($patientservice)) {
                                            $count = 0;
                                            $total = 0;
                                            foreach ($patientservice as $service) {
                                            $count++;
                                                            
                                            $patientServiceID = $service['patientServiceID'];
                                            // $id = $service['servicesCode'];
                                            //$name = $db->getData("service", "serviceName", "serviceID", $id);
                                            $healthSchemeID=$service['paymenttypeCode'];
                                            $saleStatus = $service['saleStatus'];
                                            $price=$service['price'];
                                            $total = $total+ $price;

                                         ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $db->getData("service", "serviceName", "serviceCode", $service['serviceCode']); ?>
                                        </td>
                                        <td><?php echo $db->getData("paymenttype", "paymentTypeName", "paymentTypeCode", $healthSchemeID); ?>
                                        </td>
                                        <td><?php echo number_format($price,2)?></td>
                                    </tr>
                                    <?php }} ?>
                                    <tr>
                                        <td colspan="3"><b>Total due<b></td>
                                        <td><b><?php echo number_format($total,2).'/=';?></b></td>
                                    </tr>
                                    <form name="form1" method="post" action="action_paymentbill.php" id="register">
                                        <div class="row">
                                            <div class="col-4">
                                                <label><b>Total :</b></label>
                                                <input type="text" name="num1" id="num1" value="<?php echo ($total)?>"
                                                    class="form-control" readonly="" />
                                            </div>
                                            <div class="col-4">
                                                <label><b>Discount:</b></label>
                                                <input type="text" name="num2" id="num2" value="0" class="form-control"
                                                    autocomplete="off" />
                                            </div>
                                            <div class="col-4">
                                                <label><b>Net Pay:</b></label>
                                                <input type="text" class="form-control" name="subt" id="subt"
                                                    readonly /><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label><b>Amount Tendered:</b></label>
                                                <input type="text" name="num4" id="num4" class="form-control"
                                                    autocomplete="off" required><br>
                                            </div>
                                            <div class="col-4">
                                                <label type="hidden"><b>Change :</b></label>
                                                <input type="text" class="form-control" name="change" id="change"
                                                    readonly /><br>
                                            </div>
                                            <div class="col-2">
                                                <label><b></b></label>
                                                <input type="hidden" name="sum" id="sum" readonly />
                                                <input type="hidden" name="patientServiceID"
                                                    value="<?php echo $patientServiceID;?>" />
                                                <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>" />
                                                <input type="hidden" name="patientNo"
                                                    value="<?php echo $patientNo;?>" />
                                                <input type="hidden" name="action_type" value="add" />
                                                <input type="submit" name="doSubmit" value="Pay Bill"
                                                    class="btn btn-info form-control" tabindex="8">
                                            </div>
                                            <div class="col-2">
                                                <label><b></b></label>
                                                <a href="index3.php" type="submit" name="doSubmit"
                                                    class="btn btn-warning form-control">cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </tbody>
                            </table>
                            <br><br>
                            <p>
                            <h5 style="margin-left:40%"><b>Thank you for using <?php echo $db->decrypt($hospitalName);?>
                                    services.
                                    <br> Get well soon!</b></h5>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="invoice-footer">
                    <br><br><br><br>

                    <script type="text/javascript" src="js/jquery.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        //this calculates values automatically 
                        sum();
                        $("#num1, #num2,#num4").on("keydown keyup", function() {
                            sum();
                        });
                    });

                    function sum() {
                        var num1 = document.getElementById('num1').value;
                        var num2 = document.getElementById('num2').value;
                        var num4 = document.getElementById('num4').value;

                        var result = parseInt(num1) + parseInt(num2);
                        var result1 = parseInt(num1) - parseInt(num2);
                        var result2 = parseInt(num4) - (parseInt(num1) - parseInt(num2));
                        if (!isNaN(result)) {
                            document.getElementById('sum').value = result;
                            document.getElementById('subt').value = result1;
                            document.getElementById('change').value = result2;
                        }
                    }
                    </script>
                </div>
            </div>
    </div>
    </section>
</div>
</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript">
function Confirm(form) {
    alert("Are you sure you want a discount?");
    form.submit();
}
</script>
<script>
$().ready(function() {
    $("#register").validate({
        rules: {
            num4: {
                required: true,
            },
        },
        messages: {
            num4: {
                required: "Please provide patient Name",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>