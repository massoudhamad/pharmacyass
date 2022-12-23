<div class="content-wrapper">
    <div class="content-header">
        <div class="card-header">
            <h2><i class="la la-medkit font-large-2 success"></i>Medicine</h2>
        </div>
    </div>

    <?php          
          $db = new DBHelper();         
            $patientNo=$_REQUEST['patientNo'];
            $visitNo=$_REQUEST['visitNo'];
                
            $patients = $db->getRows('patient',array('where'=>array('patientNo'=>$_GET['patientNo'])));
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
                //$visitNo=$db->getData("patientvisit","visitNo","patientNo",$patientNo);
                $address=$patient['address'];
                $telNumber=$patient['telNumber'];
                $name="$fname $mname $lname";
            }
            }
            ?>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-hover">
                    <tr>
                        <th>Patient No</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Address</th>
                        <th>Visit No</th>
                    </tr>
                    <tr>
                        <td><?php echo $patientNo;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $db->ageCalculator($dob);?></td>
                        <td><?php echo $sex;?></td>
                        <td><?php echo $address;?></td>
                        <td><?php echo $visitNo;?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="col-md-12">
        <hr>
        <form method="POST" action="action_medication.php">
            <div class='block'>
                <div class='col-md-12'>
                    <div class='row'>
                        <div class='col-md-4'><select class='form-control chosen-select' name='drugID[]'>
                                <option value=''>Select Medicine</option>
                                <?php 
                                $drugs = $db->getRows('drugs',array('where'=>array('isMedicine'=>1),'order_by'=>'drugID  ASC'));
                                if(!empty($drugs)){
                                    foreach($drugs as $dept){
                                        $drugID=$dept['drugID'];
                                        $drugName=$dept['drugName'];?>
                                <option value='<?php echo $drugID;?>'><?php echo $drugName;?></option>
                                <?php 
                                    }
                                }?>
                            </select></div>
                        <div class='col-md-4'>
                            <div class='form-group'><input type='text' name='dose[]' placeholder='Dose'
                                    class='form-control' required /></div>
                        </div>&nbsp; &nbsp;<input type='button' value='Drop' class='remove btn btn-danger'
                            style='height:40px;' id="remove">
                    </div>
                </div>
            </div>
            <div class="block">
                <hr>
                <div class="form-actions">
                    <div class="col-lg-12">
                        <input type="button" value='Add Medicine' onclick="return add" class="btn btn-info add"
                            id="add">
                        <input type="hidden" name="patientNo" value="<?php echo $patientNo;?>">
                        <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>">
                        <input type="hidden" name="action_type" value="add" />
                        <input type="submit" name="doSubmit" value="Save" class="btn btn-info" style="color:white" />
                    </div>
        </form>

    </div>
</div>
</div>




<br><br><br>
<div class="row">
    <div class="col-12">
        <table id="orderTest" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Medicine</th>
                    <th>Dose</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
    $medication = $db->getRows('patient_medication',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo,'isEmergency'=>0),'order_by'=>'patient_medicationID  ASC'));
    if(!empty($medication)){ 
    $count = 0; 
    foreach($medication as $service){ 
    $count++;
    $drugID = $service['drugID'];
    $dose = $service['dose'];
    ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $db->getData("drugs","drugName","drugID",$drugID);?></td>
                    <td><?php echo  $dose ?></td>
                    <td>
                        <a type="button" onclick="return confirm('Are you sure you want to delete')"
                            href="delete_medication.php?patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>&drugID=<?php echo $drugID?>"><i
                                class="la la-trash danger"></i></a>
                    </td>
                </tr>
                <?php } }else{ ?>
                <tr>
                    <td colspan="4">No Medicine(s) found......</td>
                    <?php } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-2">
                <a type="button"
                    href="index3.php?sp=consultation&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>"
                    class="form-control btn btn-warning" style="color:white;">Continue</a>
            </div>
        </div>
    </div>
</div>
</div>


<script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
$('#add').click(function() {
    $('.block:last').before(
        "<div class='block'><div class='col-md-12'><div class='row'><div class='col-md-4'><select  class='form-control chosen-select' name='drugID[]'><option value=''>Select Medicine</option><?php $drugs = $db->getRows('drugs',array('order_by'=>'drugID  ASC'));if(!empty($drugs)){foreach($drugs as $dept){$drugID=$dept['drugCode'];$drugName=$dept['drugName'];?><option value='<?php echo $drugID;?>''><?php echo $drugName;?></option><?php }}?></select></div><div class='col-md-4'><div class='form-group'><input type='text' name='dose[]' placeholder='Dose' class='form-control'/></div></div>&nbsp; &nbsp;<input type='submit' value='Drop' class='remove btn btn-danger' style='height:40px;'></div></div></div></div>"
    );
    $('.chosen-select').trigger("chosen:updated");
    $('.chosen-select').chosen();
});

$(document).on('click', '#remove', function() {
    $(this).closest('.block').remove();
});
</script>
<script>
$(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true
    });
});
</script>