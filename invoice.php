
    <!-- BEGIN: Content-->
      <?php 
         $db = new DBHelper();
         $patientNo = $_REQUEST['patientNo'];
         $visitNo = $_REQUEST['visitNo'];
         $address = $db->getData("patient", "address", "patientNo", $patientNo);
         $firstName = $db->getData("patient", "firstName", "patientNo", $patientNo);
         $middleName = $db->getData("patient", "middleName", "patientNo", $patientNo);
         $lastName = $db->getData("patient", "lastName", "patientNo", $patientNo);
         $name = $firstName." ".$middleName." ".$lastName;
         $patientservice=$db->getPatientService($patientNo,$visitNo);
         $hospitals= $db->getRows('hospital',array('order_by'=>'hospitalID ASC'));
if(!empty($hospitals)){
    foreach($hospitals as $hospitals){
            $email = $hospitals['email'];
            $hospital_name = $hospitals['hospitalName'];
            $hospital_code = $hospitals['hospitalCode'];
            $profile=$hospitals['hospital_logo'];
            $firstname=$hospitals['firstname'];
            $middlename=$hospitals['middlename'];
            $lastname=$hospitals['lastname'];
            $phone=$hospitals['telephoneNumber'];
    }   
}
?>
                  
                   
        <div class="content-wrapper">
            <div class="content-body">
                <section class="card">
                    <div id="invoice-template" class="card-body">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-md-6 col-sm-12 text-center text-md-left">
                                <div class="media">
                                    <img src="<?php echo 'profile_img/'. $profile?>" width="130px" alt="company logo" class="" />
                                    <div class="media-body">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800"><b>Raudhat Medical Clinic</b></li>
                                            <li><b>Kwarara</b></li>
                                            <!-- <li>Melbourne,</li>
                                            <li>Florida 32940,</li>
                                            <li>USA</li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-right">
                                <h2>INVOICE</h2>
                                    <p class="pb-3">INV-001001</p>
                                <?php
                   
                                    if(!empty($patientservice)) {
                                    
                                    $total = 0;
                                    foreach ($patientservice as $service) {
                                    $price=$service['price'];
                                    $total = $total+ $price;
                                ?>
                                <ul class="px-0 list-unstyled">
                                <?php }}?>
                                    <li><b>Balance Due</b></li>
                                    <li class="lead text-bold-800"><?php echo number_format($total,2); ?></li>
                                </ul>
                                    
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->
                       
                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-sm-12 text-center text-md-left">
                                <p class="text-muted"><b>Bill To</b></p>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800"><b><?php echo $name ?></b></li>
                                    <li><b><?php echo $patientNo ?></b></li>
                                    <li><b><?php echo $address?></b></li>
                                    <!-- <li>New Mexico-87102.</li> -->
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-right">
                                <p><span class="text-muted"><b>Invoice Date :</span><?php echo date('d-m-Y')?></b></p>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->
                      
                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="container-fluid">
                                <div class="table-responsive col-sm-12">
                                    
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Service Name</th>
                                                <!-- <th class="text-right">Rate</th> -->
                                                <th>Scheme</th>
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
                                            $id = $service['serviceCode'];
                                            $name = $db->getData("service", "serviceName", "serviceCode", $id);
                                            $paymenttypeCode=$service['paymenttypeCode'];
                                            $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCode);
                                            $saleStatus = $service['saleStatus'];
                                            $price=$service['price'];
                                            $total = $total+ $price;
                                            $subCatID = $db->getData("service", "subCategoryCode", "serviceCode", $id);
                                            $CatID = $db->getData("servicesubcategory", "categoryCode", "subCategoryCode", $subCatID);

                                         ?>
                                            <tr>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $name ?> </td>
                                                <!-- <td class="text-right">$ 20.00/hr</td> -->
                                                <td><?php echo $healthScheme ?></td>
                                                <td><?php echo number_format($price,2)?></td>
                                            </tr>
                                            
                                            <?php }} ?>
                                        </tbody>
                                        <tr>
                                    <td colspan="3"><i><b>Total</b></i></td>
                                    <td><b><?php echo number_format($total, 2).'/='; ?></b></td>
                                </tr>
                                    </table>
                                    
                                </div>
                            </div>
                                
                        </div>
                       
                        <!-- Invoice Footer -->
                        <div id="invoice-footer">
                            <div class="row">
                                <div style="margin-left:20%;">
                                    <p><b>Thank you for using Raudhat Medical Clinic services. Get well soon!</b></p>
                                </div>
                                <div class="col-md-5 col-sm-12 text-right">
                                    <button type="button" class="btn btn-info btn-lg my-1"><i class="la la-print"></i>  Print Invoice</button>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Footer -->

                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

   