<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
<script type="text/javascript">
$(document).ready(function() {
    $('#newtest').DataTable({
        scrollX: false,
        paging: true,

    });
});
</script>
<?php
$serviceCode=$_REQUEST['serviceCode'];
?>

<div class="container-fluid">
    <div>

        <div class="card">
            <?php
                $db = new DBHelper();

                if (empty($_REQUEST['visitNo'])){
                 ?>
            <td colspan="4">
                <h4 style="color:red;">No Service selected, please select services</h4>
            </td>

            <?php
                }else {

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
                             $healthSchemeID=$patient['paymenttypeCode'];
                            $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$healthSchemeID);
                            $name = "$fname $mname $lname";
                            $visitStatus=$db->getData("patientvisit","visitStatus"," visitNo","visitStatus");
                            //   echo  $visitStatus;
                            //$patient['visitStatus'];
                        }
                    }
                }
                
                //'where'=>array('subCategoryID'=>),
                $services = $db->getRows('service', array('order_by' => 'serviceID ASC'));
                ?>
            <div>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h3 style="margin-left:30px;margin-bottom:20px;">Requested Services</h3>
                        </div>

                        <?php
                $today = date("Y-m-d");
                $patientservice=$db->getAppointmentPatientService($patientNo,$visitNo);
                if(!empty($patientservice)) {
                    

                    ?>
                        <table class="table table-striped table-bordered patients-list" id="example">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Services</th>
                                    <!-- <th>Category Name</th> -->
                                    <th>Payment Scheme</th>
                                    <th>List Price</th>
                                    <!-- <th>Net Price</th> -->
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 0;
                                    $total = 0;
                                    $netPrice=0;
                                    foreach ($patientservice as $service) {
                                        $count++;
                                        
                                        $patientServiceID = $service['patientServiceID'];
                                        $id = $service['serviceCode'];
                                        //$category = $service['categoryCode'];
                                        $healthSchemeID=$service['paymenttypeCode'];
                                        $saleStatus = $service['saleStatus'];
                                        //$discount=$service['discount'];
                                        $price=$service['price'];
                                       //$netPrice=$price-$discount;
                                        $total = $total+ $price;
                                        $subCatID = $db->getData("service", "subCategoryCode", "serviceCode", $id);
                                        //$CatCode = $db->getData("servicecategory", "categoryName", "categoryCode", $category);

                                        ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo  $db->getData("service", "serviceName", "serviceCode", $service['serviceCode']); ?>
                                    </td>
                                    <!-- <td><?php echo $CatCode; ?></td> -->
                                    <td><?php echo $db->getData("paymenttype", "paymentTypeName", "paymentTypeCode", $healthSchemeID); ?>
                                    </td>

                                    <td><?php echo number_format($price, 2); ?></td>
                                    <!-- <td><?php echo number_format($netPrice, 2); ?></td> -->

                                    <?php
                                        if($saleStatus==0)
                                        {?>
                                    <td>
                                        <a href="payment.php?pid=<?php echo $db->my_simple_crypt($patientServiceID,'e')?>&pno=<?php echo $db->my_simple_crypt($patientNo,'e');?>&visitNo=<?php echo $visitNo;?>"
                                            onclick="return confirm('Are you sure want paid this service')">Not Paid</a>
                                    </td>
                                    <?php }
                                        else
                                        {
                                        ?>
                                    <td><span class="label label-success">Paid</span></td>
                                    <?php
                                        }
                                        ?>

                                    <td><a href="action_delete_service.php?pid=<?php echo $db->my_simple_crypt($patientServiceID,'e')?>&pno=<?php echo $db->my_simple_crypt($patientNo,'e');?>&vno=<?php echo $db->my_simple_crypt($visitNo,'e');?>&saleStatus=<?php echo $saleStatus;?>"
                                            onclick="return confirm('Are sure want to delete this service')"><i
                                                class="la la-trash" title="Remove Service"></i></a>
                                    <td>

                                </tr>

                                <?php }
                                }else{ ?>
                                <tr>
                                    <td colspan="4">No Services(s) found......</td>
                                    <?php } }?>
                                <tr>
                                    <td colspan="4"><i><b>Total</b></i></td>
                                    <td><?php echo number_format($total, 2).'/='; ?></td>
                                </tr>
                            </tbody>
                    </div>
                    </table>

                    <div class="row" style="margin-top:20px;">
                        <div class="pull-left" style="margin-left:70%;">
                            <a href="index3.php?sp=process_payment&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"
                                <span class="btn btn-info">Process Payment</span></a>
                        </div>
                        <div class="col-2">
                            <a href="index3.php?sp=invoice&patientNo=<?php echo $patientNo; ?>&visitNo=<?php echo $visitNo; ?>"
                                <span class="btn btn-info">Print Bill</span></a>
                        </div>
                    </div>
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
</div>
</div>
</div>
<script>
function change() {
    var elem = document.getElementById("myButton1");
    if (elem.value == "Paid") elem.value = "Not Paid";
    else elem.value = "Paid";
}
</script>