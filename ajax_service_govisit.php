<?php

include( 'DB.php' );
$db = new DBHelper();
$categoryCode = $_POST['categoryCode'];
if ( $categoryCode )

?>

<div class='container-fluid'>
    <form name='register' id='register' method='post' action='action_patient_service.php'>
        <?php

if ( empty( $visitNo ) ) {
    ?>
        <div class='row' style='margin-top:10px;'>
        </div>
        <div class=' form-inline' id='triageOptional' style='display:none'>
            <label>Pass through Triage?</label>&nbsp;
            &nbsp;
            <select name='triage' id='triage' class='form-control' required>
                <option value='no'>No ( Default )</option>
                <option value='yes'>Yes</option>

            </select>
        </div>
</div>
<?php }
    ?>
</div>

<table class='table table-striped table-bordered patients-list ' style='margin-top:20px;'>
    <thead>
        <tr>

            <th width='3px;'>Select</th>
            <th>Service</th>
            <th>Category</th>
            <th>Payment Scheme</th>
            <th>Price</th>

        </tr>
    </thead>
    <tbody>
        <?php
    $services = $db->getGovisit( $categoryCode, $paymenttypeCode );

    //$services = $db->getRows( 'serviceoffered', array( 'where'=>array( 'categoryCode'=>$categoryCode, 'isActive'=>1 ), 'order_by'=>'serviceOfferedID ASC' ) );
    // $services = $db->getService( $categoryID, $hospital_code );
    if ( !empty( $services ) ) {
        // $count = 0;
        foreach ( $services as $service ) {
            // $count++;
            $id = $service['serviceCode'];
            $category = $service['categoryName'];
            //$cash = $service['cash'];
            $price = $service['price'];
            //$insurance = $service['insurance'];
            //$costsharing = $service['costsharing'];
            //$fasttrack = $service['fasttrack'];
            $categoryCode = $service['categoryCode'];
            ?>

        <tr>
            <td><input type='checkbox' class='checkbox_class' name='id[]' value='<?php echo $id; ?>'></td>

            <td><?php echo $db->getData( 'service', 'serviceName', 'serviceCode', $service['serviceCode'] );
            ?></td>

            <td><?php echo $category ?></td>

            <td>
                <select name='available_payment_types' class='form-control' required>
                    <?php
            echo "<option value='$paymenttypeCode'>$healthScheme</option>";
            $available_payment_types = $db->getavailable_payment_types();
            if ( !empty( $available_payment_types ) ) {
                $count = 0;
                foreach ( $available_payment_types as $available_payment_type ) {
                    $count++;
                    $available_payment_typeID = $available_payment_type['paymenttypeCode'];
                    $available_payment_typeName = $db->getData( 'paymenttype', 'paymentTypeName', 'paymentTypeCode', $available_payment_type['paymenttypeCode'] );
                    ?>
                    ?>
                    <option value="<?php echo $available_payment_typeID;?>"><?php echo $available_payment_typeName;
                    ?>
                    </option>
                    <?php }
                }
                ?>
                </select>
            </td>
            <td><?php echo number_format( $price, 2 );
                ?></td>

        </tr>
        <?php }
            } else {
                ?>

        <center>
            <td colspan='8'>No service( s ) that match the Category</td>
        </center>
        <?php
            }
            ?>

    </tbody>
</table>

<div class='col-lg-6 col-md-12' id='docAppoitment' style='display:none'>
    <div class='card' id='doctorsAvailable'>
        <div class='card-content collapse show'>
            <div class='card-body'>

                <h5>
                    <center>Book Appointment</center>
                </h5>
                <hr>
                <div class='col-md-10'>
                    <label for='Available Doctor'>Available Doctor</label>
                    <select name='doctor' class='form-control'>
                        <?php
            $doctor = $db->getRows( 'users', array( 'where'=>array( 'roleCode'=>'UjA0' ), 'order_by'=>'username ASC' ) );
            if ( !empty( $doctor ) ) {
                echo "<option value=' '>Select Here</option>";
                foreach ( $doctor as $doctors ) {

                    $userID = $doctors['userID'];
                    $firstName = $doctors['firstName'];
                    $middleName = $doctors['middleName '];
                    $lastName = $doctors['lastName'];
                    $name = $firstName.' '.$middleName.' '.$lastName;
                    ?>
                        <option value="<?php echo $userID;?>"><?php echo $name;
                    ?></option>

                        <?php }
                } else {

                    echo 'No doctor Avaialable';

                }
                ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-lg-8'></div>
    <div class='col-lg-2'>
        <input type='hidden' name='number_applicants' value="<?php echo $id; ?>">
        <input type='hidden' name='ageAtVisit' value="<?php echo $ageAtVisit; ?>">
        <input type='hidden' name='patientNo' value="<?php echo $patientNo; ?>">
        <!-- <input type = '' name = 'serviceCode' value = "<?php echo $id; ?>"> -->
        <input type='hidden' name='action_type' value='add' />
        <input type='submit' name='doUpdate' onclick=' return validateChecks()' value='Save'
            class='btn btn-info form-control'>
    </div>
    <div class='col-lg-2'>
        <input type='hidden' name='action_type' value='cancel' />
        <input type='submit' name='docancel' value='Cancel' class='btn btn-danger form-control'>
    </div>
</div>

</div>
</div>

</form>
<div>
</div>
?>