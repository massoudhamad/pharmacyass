<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#example111").DataTable({
        "processing": true,
        "paging": true,
        dom: 'Blfrtip',
        bLengthChange: true,
        "lengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 15,
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
<?php
include("DB.php");
$db=new DBHelper();
$categoryCodee = $_POST['categoryCode'];
$data =  explode( ',', $categoryCodee );
$categoryCode = $data[0];
$paymenttypeCode = $data[1];
$patientNo = $data[2];
$ageAtVisit = $data[3];
?>

<form name="register" id="register" method="post" action="action_patient_service.php">
    <div class="container-fluid">
        <?php 
                                  
                // if(empty($visitNo)){
                    if($categoryCode == 'CAT01'){
            ?>

        <div class="row">
            <div class="col-3" id="triageOptional">
                <label>Service</label>
                <select name="available_payment_types" id='triage' class="form-control" required>
                    <?php
                    $services = $db->getAvailableServiceConsultation($paymenttypeCode);
                    if(!empty($services)){
                        echo "<option value=' '>Select Here</option>";
                        foreach($services as $service){
                        $serviceCode=$service['serviceCode'];
                        $paymenttypeCode=$service['paymenttypeCode'];
                        $price=$service['price'];
                        $serviceName=$service['serviceName'];?>
                    <option value='<?php echo $serviceCode.",".$paymenttypeCode.",".$price.",".$categoryCode?>'>
                        <?php echo $serviceName?>
                    </option>
                    <?php
                        }
                    }else{?>
                    <option value=''>No Service Found</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-3" id="triageOptional">
                <label>Pass through Triage?</label>
                <select name="triage" id='triage' class="form-control" required>
                    <option value='yes'>Yes (Default)</option>
                    <option value="no">No</option>

                </select>
            </div>
            <div class="col-3" style="margin-top:27px;">
                <!-- <div class="col-2"> -->
                <input type="hidden" name="number_applicants" value="<?php echo $id; ?>">
                <input type="hidden" name="ageAtVisit" value="<?php echo $ageAtVisit; ?>">
                <input type="hidden" name="patientNo" value="<?php echo $patientNo; ?>">
                <input type="hidden" name="serviceCode" value="<?php echo $categoryCodee; ?>">
                <input type="hidden" name="action_type" value="add" />
                <input type="submit" name="doUpdate" style="color:white" onclick=' return validateChecks()' value="Save"
                    class="btn btn-success form-control">

            </div>
        </div>
        <?php } //}?>
    </div>

</form>
</div>
</div>


<div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#available_payment_types").change(function() {
        var categoryCode = $(this).val();
        var dataString = 'subCategoryCode=' + categoryCode
        //alert(dataString);
        $.ajax({
            type: 'POST',
            url: "ajax_payment_type_price.php",
            data: dataString,
            cache: false,
            success: function(data) {
                //alert(data)
                $("#price").html(data);
            }
        });
    });
});
</script>

<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript">
function validateChecks() {
    var chks = document.getElementsByName('id[]');
    var checkCount = 0;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            checkCount++;
        }
    }
    if (checkCount < 1) {
        alert('Please check atleast one service.');
        return false;
    }
    return true;
}
</script> -->

<script type="text/javascript">
$(document).ready(function() {
    $("#categoryCode").change(function() {
        var categoryCode = $(this).val();
        var dataString = 'categoryCode=' + categoryCode
        //alert(dataString);
        $.ajax({
            type: 'POST',
            url: "ajax_govisit.php",
            data: dataString,
            cache: false,
            success: function(data) {
                // alert(data)
                $("#govist").html(data);
            }
        });
    });
});
</script>