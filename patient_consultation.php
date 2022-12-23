<?php
$db = new DBHelper();
$patientNo=$db->my_simple_crypt($_GET['id'],'d');
$visitNo=$_REQUEST['visitNo'];
//$reportingDate=$_REQUEST['reportingDate'];

$patients = $db->getDoctorInfon($patientNo);
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
        $phone=$patient['telNumber'];
        $bloodGroup=$patient['bloodGroup'];

        $triageTime=$patient['triageTime'];
        $hrTest =$patient['hrTest'];
        $rrTest=$patient['rrTest'];
        $temperature=$patient['temperature'];
        $oxgenSats=$patient['oxgenSats'];
        $weight=$patient['weight'];
        $bpTest=$patient['bpTest'];
        $oxgenSats=$patient['oxgenSats'];
        $weight=$patient['weight'];
        $date = $patient['modifiedDate'];
        $age=$db->ageCalculator($dob);
        $name = $fname." ".$mname." ".$lname;
       // $company=$patient['insurerType'];
         $paymenttypeCode=$patient['paymenttypeCode'];
        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCode);
         }}
         $allergy= $db->getRows('patient_allergy',array('where'=>array('patientNo'=>$patientNo)));
         if(!empty($allergy))
         {
             $x=0;
             foreach ($allergy as $t)
             {
                 $allergyID=$t['allergyID'];
                 $allergy=$db->getData('allergy','allergyName','allergyID',$t['allergyID']);
                
                 
             }}

?>



<style>
   .feed {padding: 5px 0}
</style>


<!-- END: Head-->

<!-- BEGIN: Body-->


    <!-- BEGIN: Content-->
  
        <div class="content-wrapper">
         <div class="content-header">
                   <div  class="card-header">
                        <h2> <i class="la la-stethoscope font-large-2 warning"></i>Consultation</h2>
                    </div>
                </div>
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                    </div>
                </div>

            </div>
            <div class="content-body">
            <div class="card">
            </div>
                <section id="patient-profile">
                    <div class="row match-height">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mx-3">
                                            <div class="patient-img-name text-left">
                                                <img src="app-assets/images/portrait/medium/images.png" alt="" class="card-img-top mb-1 patient-img img-fluid rounded-circle">
                                                <b><?php echo $name;?></b><hr>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <li><span class="patient-info-heading">Age  :</span> <?php echo $db->ageCalculator($dob); ?></li><hr>
                                                        <li><span class="patient-info-heading">Contact     :</span> <?php echo $phone ?></li><hr>
                                                        <li><span class="patient-info-heading">Address     :</span> <?php echo $address ?></li><hr>
                                                        <li><span class="patient-info-heading">Blood Group :</span> <?php echo $bloodGroup ?></li><hr>
                                                        <li><span class="patient-info-heading">Allergy     :</span><?php echo $allergy ?></li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                        <div class="col-lg-8 col-md-6">
                            <div class="card ">
                               
                                <div class="card-content mx-3">
                                 
        <?php 
          $triage= $db->getRows('triage',array('where'=>array('visitNo'=>$visitNo)));
          if(!empty($triage))
          {
              $x=0;
              foreach ($triage as $t)
              {
                  $tDate=$t['triageDate'];
                  $tTime=$t['triageTime'];
                  $userID=$t['userID'];
                  $score=$t['score'];
                  
                  if($tDate=="")
                      $tDate=date('d-m-Y');
                  else
                      $tDate=$tDate;
                  if($tTime=="")
                      $tTime=date('h:m:s');
                  else 
                      $tTime=$tTime;
                  if($userID=="")
                      $userID=$_SESSION['user_session'];
                  else 
                      $userID=$userID;
        ?>   
                    <h4  style="margin-top:30px;margin-bottom:20px;">Vital Signs</h4> 
                        <div class="row">
                            <div class="col-4">
                                <h4><span>Date  :</span> <?php echo date("d-m-Y");?></h4>
                            </div>
                            <div class="col-6">
                                <h4><span>Time Taken  :</span> <?php echo $t['createdDate'];?></h4>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <li><span class="patient-info-heading">HR:</span> <?php echo $t['hrTest'];?></li><hr>
                                <li><span class="patient-info-heading">RR:</span> <?php echo $t['rrTest'];?></li><hr>
                                <li><span class="patient-info-heading">Temperature:</span><?php echo $t['temperature'];?></li><hr>
                            </div>
                            <div class="col-4">
                                <li><span class="patient-info-heading">Weight  :</span><?php echo $t['weight'];?></li><hr>
                                <li><span class="patient-info-heading">02 Stats :</span><?php echo $t['oxgenSats'];?></li><hr>
                                <?php 
                                    if($t['trauma']==1)
                                        $ytr="active";
                                    else if($t['trauma']==0)
                                        $ntr="active";
                                    ?>
                                <li><span class="patient-info-heading">Trauma     :</span><?php if($t['trauma']=="1") echo "Yes"; else echo "No"?></li><hr>
                            </div>
                            <div class="col-4">
                                     <?php 
                                        if($t['response']=="A")
                                            $aresp="active";
                                        else if($t['response']=="V")
                                            $vresp="active";
                                        else if($t['response']=="P")
                                            $presp="active";
                                        else if($t['response']=="U")
                                            $uresp="active";
                                        else if($t['response']=="C")
                                            $cresp="active";
                                        ?>
                                <li><span class="patient-info-heading">Response     :</span> <?php if($t['response']=="A") echo "Alert(A)";
                                else if($t['response']=="V") echo "Voice(V)";
                                else if($t['response']=="P") echo "Pain(P)";
                                else if($t['response']=="U") echo "Unresponsive(U)";?></li><hr>
                            
                            </div>
                        </div> 
                        <br>
                        <?php if($age>12){
                            ?>
                                 <div class="row">
                                    <div class="col-4">
                                        <li><span class="patient-info-heading">BP  :</span> <?php echo $t['bpTest'];?>/<?php echo $t['bpTestDen'];?></li><hr>
                                        <li><span class="patient-info-heading">Mobility     :</span> <?php echo $t['rrTest'];?></li><hr>
                                    </div>
                                </div>
                       <?php }?>

                        <?php if($age<12){
                                ?>
                        <div class="row">
                            <div class="col-4">
                                <li><span class="patient-info-heading">Odema  :</span> <?php if($t['oedema']=="1") echo "Yes";else echo "No";?></li><hr>
                                <li><span class="patient-info-heading">Mobility     :</span> <?php echo $t['rrTest'];?></li><hr>
                            </div>
                            <div class="col-4">
                            <li><span class="patient-info-heading">Length  :</span><?php echo $t['length'];?></li><hr>
                                <li><span class="patient-info-heading">Moving  :</span> <?php if($t['moving']=="1") echo "Yes"; else echo "No";?></li><hr>
                            </div>
                        </div>

                                <?php
                                        }}}
                                        ?>
                             </div>
                      </div>
                    </div>

                    <?php                
                        $patientdiagnosis = $db->getRows('consultation',array('where'=>array('patientNo'=>$patientNo,'visitNo'=>$visitNo)));
                        if(!empty($patientdiagnosis))
                        {
                            $x=0;
                            foreach ($patientdiagnosis as $pdd)
                            {
                                $x++;
                                $clinicalHistory=$pdd['clinicalHistory'];
                                $patientStatus=$pdd['patientStatus'];
                            }
                        }
                    ?>   
                    <div class="container-fluid">
  
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h2 class="card-title">Clinical History</h2>
                                    <div class="table-responsive"> -->
                                    <div class='row'>
                                <div class='col-xs-12'>
                                    <h3><b>Clinical History</b></h3><br>
                                </div>
                                <div class='box-body table-responsive '>

                                    <?php
                                    $patientdiagnosis = $db->getRows( 'consultation', array( 'where'=>array( 'patientNo'=>$patientNo, 'visitNo'=>$visitNo ) ) );
                                    if ( !empty( $patientdiagnosis ) ) {
                                        $x = 0;
                                        foreach ( $patientdiagnosis as $pdd ) {
                                            $x++;
                                            $clinicalHistory = $pdd['clinicalHistory'];
                                            $patientStatus = $pdd['patientStatus'];
                                        }
                                    }else{
                                        $clinicalHistory = '';
                                    }

                                    ?>

                                    <div class='row'>
                                        <div class='col-10'>
                                       
                                            <form action='action_clinicalHistory.php' method='POST'>
                                                <textarea name='clinicalHistory'
                                                    style='width: 100%; height: 100px;  font-size: 15px;'><?php echo  $clinicalHistory?></textarea>
                                        </div>

                                        <div class='col-2' >
                                       
                                            <!-- <button type="submit" class='btn btn-info form-control'><i class='ft-'></i>Save</> -->
                                            <input type='hidden' name='patientNo' value="<?php echo $patientNo;?>">
                                            <input type='hidden' name='visitNo' value="<?php echo $visitNo;?>">
                                            <input type='hidden' name='action_type' value='add' />
                                        </div>
                                         </form>

                                    </div>
                                   
                                </div>
                            </div>
                                    <?php
//if($patientStatus==1)
//{
?>
<br><br><br>
<div class="row">
        <div class="col-xs-12">        
              <h3><b>Laboratory Test Results</b></h3><br>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Order Date</th>
                  <th>Test Name</th>
                  <th>Result</th>
                  <th>File Preview</th>
                  <th>Remarks</th>
                  <th>Test Status</th>                 
                </tr>                
               <?php 
               $patientvisit=$db->getRows('patienttest',array('where'=>array('visitNo'=>$visitNo,'patientNo'=>$patientNo),'order_by'=>'testStatus DESC'));
            //    print_r($patientvisit);
if(!empty($patientvisit))
{
    $x=0;
    foreach ($patientvisit as $pvisits)
    {
        $x++;
        $testNo=$pvisits['testNo'];
        $servicesID=$pvisits['servicesCode'];
        $result=$pvisits['result'];
        $fileurl=$pvisits['fileurl'];
        $remarks=$pvisits['remarks'];
        $testStatus=$pvisits['testStatus'];
?>
                <tr>
                  <td><?php echo $testNo;?></td>
                  <td><?php echo $db->getData("service","serviceName","serviceCode",$servicesID);?></td>
                   <td><?php echo $result;?></td>
                  <td><a href='profile_img/<?php echo $fileurl?>' target="_blank">View Image</td>
                  <!-- <td>
                  <a href="view_image.php?visitNo=<?= $visitNo ?>&patientNo=<?= $patientNo ?>&testNo=<?= $testNo ?>" title="View Radiology Image">View Image
				</a>
                </td> -->
                  <td><?php echo $remarks;?></td>  
                  <?php 
                  if($testStatus==1)
                      $status="Done";
                  else 
                      $status="Inprogress";
                  ?>
                  
                  <td><?php echo $status;?></td>
              <?php
              if($testStatus=="")
              {
              ?>
              <td><a href="#" class="btn btn-primary a-btn-slide-text">
       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>
        <?php
              }
              else 
              {
                  ?>
                  
                  <?php }}}else{?>
                    <tr><td colspan="6">No Lab Test found(s) found......</td></tr>
                      <?php
                      }?>   
                </tr>
              </table>
                 <!-- <div class="col-2" style="margin-left:1000px;">
                    <a href="index3.php?sp=ordertest&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>" class="btn btn-info form-control"><i class="ft-"></i>Add Lab Test</a>
                </div> -->
            </div>        
     </div>

    <div class="row">
        <div class="col-xs-12">        
        <h3><b>Diagnosis</b></h3><br>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <td>No</td>
                    <th>Desease Name</th>
                    <th>New case/Repeate case</th>      
                </tr>                
               <?php 
                 $patientdiagnosis=$db->getRows('patientdiagnosis',array('where'=>array('visitNo'=>$visitNo,'patientNo'=>$patientNo),'order_by'=>'patientdiagnosisID ASC'));
                    if(!empty($patientdiagnosis))
                    {
                        $x=0;
                        foreach ($patientdiagnosis as $d)
                        {
                            $x++;
                            $icdcode=$d['icdcode'];
                            $patientDiseaseCase=$d['patientDiseaseCase'];
                           
                            ?>
                <tr>
                    <td><?php echo $x?></td>
                    <td><?php echo $db->getData("diseases","diseasesName","icdcode",$icdcode);?></td>
                    <td><?php if($patientDiseaseCase==0) echo 'Repeat case';
                    elseif($patientDiseaseCase==1) echo 'New case';?></td>
                  
       
                  
                  <?php }}else{?>
                    <tr><td colspan="3">No Diagnosis(s) found......</td></tr>
                      <?php
                      }?>  
                </tr>
              </table>
                 <!-- <div class="col-2" style="margin-left:1000px;">
                    <a href="index3.php?sp=diagnosis&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>" class="btn btn-info form-control"><i class="ft-"></i>Add Diagnosis</a>
                </div> -->
            </div>        
         </div>

<div class="row">
        <div class="col-xs-12">   
                <h3><b>Medication</b></h3><br>      
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <th>No</th>
                    <th>Medicine Name</th>
                    <th>Dose</th>                
                </tr>      
                           
               <?php 
               $drugs=$db->getRows('patient_medication',array('where'=>array('visitNo'=>$visitNo,'patientNo'=>$patientNo),'order_by'=>'patient_medicationID DESC'));
                    if(!empty($drugs))
                    {
                        $x=0;
                        foreach ($drugs as $p)
                        {
                            $x++;
                            $drugID=$p['drugID'];
                            $dose=$p['dose']
?>
                <tr>
                    <td><?php echo $x?></td>
                    <td><?php echo $db->getData("drugs","drugName","drugID",$drugID);?></td>
                    <td><?php echo $dose;?></td>
                  
                  <?php }}else{?>
                    <tr><td colspan="3">No Medication(s) found......</td></tr>
                      <?php
                      }?>    
                </tr>
              </table>
                 <!-- <div class="col-2" style="margin-left:1000px;">
                    <a href="index3.php?sp=medication&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>" class="btn btn-info form-control"><i class="ft-"></i>Add Medicine</a>
                </div> -->
            </div>        
     </div>

     <div class="row">
        <div class="col-xs-12">        
                <h3><b>Ordered Procedure</b></h3><br>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <td>No</td>
                    <th>Desease Name</th>
                    <th>New case/Repeate case</th>      
                </tr>                
               <?php 
                 $patientprocedure=$db->getRows('patientprocedure',array('where'=>array('visitNo'=>$visitNo,'patientNo'=>$patientNo),'order_by'=>'patientprocedureID DESC'));
                    if(!empty($patientprocedure))
                    {
                        $x=0;
                        foreach ($patientprocedure as $d)
                        {
                            $x++;
                            $reportingDate=$d['reportingDate'];
                            $serviceID=$d['serviceCode'];
                            $visitNo=$d['visitNo'];
                            $service = $db->getData("service","serviceName","serviceCode",$d['serviceCode']);
                           
                            ?>
                <tr>
                    <td><?php echo $x?></td>
                    <td><?php echo $service?></td>
                    <td><?php echo $visitNo?></td>                      
                  <?php }}else{?>
                    <tr><td colspan="3">No Procedure(s) found......</td></tr>
                      <?php
                      }?>  
                </tr>
              </table>
                <!-- <div class="col-2" style="margin-left:1000px">
                     <br><br><br>
                    <a href="index3.php?sp=orderProcedure&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>" class="btn btn-info form-control" style="color:white"></i>Order Procedure</a>
                </div> -->
            </div>        
         </div>
        <!-- <div class="col-12"><br>
              <h3><b>End Consultation</b></h3>
            </div>           
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control" name="remarks" id="remarks">    
                                    <?php
                                        $OPDreleaseStatus = $db->getRows('opdreleasestatus',array('order_by'=>'OPDreleaseStatusID  ASC'));
                                        if(!empty($OPDreleaseStatus)){
                                            echo "<option value=''>Select OPDreleaseStatus</option>";
                                            foreach($OPDreleaseStatus as $dept){
                                            $OPDreleaseStatusID=$dept['OPDreleaseStatusID'];
                                            $name=$dept['name'];
                                            
                                        ?>
                                        <option value="<?php echo $OPDreleaseStatusID;?>"><?php echo $name;?></option>
                                        <?php }}?>
                                </select>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="div1">
                       <div class="col-2">
                            <label><b>Hospital Name:</b></label>
                        </div>
                        <div class="col-4">
                            <select name="hospitalCode" class="form-control" id="hospital">
                                <option value="">Select Here</option>
                                <?php
                                    $hospital = $db->getRows('hospital',array('order_by'=>'hospitalName ASC'));
                                    if(!empty($hospital)){
                                        foreach($hospital as $dept){
                                        $hospitalCode=$dept['hospitalCode'];
                                        $hospitalName=$dept['hospitalName'];
                                ?>
                                <option value="<?php echo $hospitalCode;?>"><?php echo $hospitalName;?></option>
                                <?php }}?>
                            </select>
                        </div>
                        </div>
                        <br>
                        <div class="row" id="div2">
                            <div class="col-2">
                                <label><b>Clinical:</b></label>
                            </div>
                            <div class="col-4">
                                <select name="clinicalCode" class="form-control" id="ward">
                                    <option value="">Clinical</option>
                                <?php
                                    $clinic = $db->getRows('clinic',array('order_by'=>'clinicName ASC'));
                                        if(!empty($clinic)){
                                            echo "<option value=''>Select Here</option>";
                                            foreach($clinic as $dept){
                                            
                                            $clinicCode=$dept['clinicCode'];
                                            $clinicName=$dept['clinicName'];
                                    ?>
                                    <option value="<?php echo $clinicCode;?>"><?php echo $clinicName;?></option>
                                    <?php }}?> 
                                </select>
                            </div>
                         </div>  
                        <div class="row" id="div3">
                            <div class="col-2">
                                <label><b>Ward:</b></label>
                            </div>
                            <div class="col-4">
                                <select name="wardCode" class="form-control" id="clinic">
                                <?php
                                    $clinic = $db->getRows('ward',array('order_by'=>'wardName ASC'));
                                        if(!empty($clinic)){
                                            echo "<option value=''>Select Here</option>";
                                            foreach($clinic as $dept){
                                            
                                            $wardName =$dept['wardName'];
                                            $wardCode=$dept['wardCode'];
                                    ?>
                                    <option value="<?php echo $wardCode;?>"><?php echo $wardName;?></option>
                                    <?php }}?> 
                                </select>
                            </div>
                        </div>  
                        <div class="row" id="div4">
                            <div class="col-2">
                                <label><b>death:</b></label>
                            </div>
                            <div class="col-4">
                                <select name="deathCauseID" class="form-control" id="death">
                                    <option value="">Select Death:</option>
                                <?php
                                    $deathID = $db->getRows('death',array('order_by'=>'deathID ASC'));
                                        if(!empty($deathID)){
                                            echo "<option value=''>Select Here</option>";
                                            foreach($deathID as $dept){
                                            
                                            $deathID =$dept['deathID'];
                                            $deathName=$dept['deathName'];
                                    ?>
                                    <option value="<?php echo $deathID;?>"><?php echo $deathName;?></option>
                                    <?php }}?> 
                                </select>
                            </div>
                        </div> 
                        <br>  
                        <div class="row" id="div5">
                            <div class="col-2">
                                <label><b>Description:</b></label>
                            </div>
                            <div class="col-4">
                                <textarea name="description" height="200px" width="200px" id="description"></textarea>
                            </div>
                        </div>   
        </div>
      </div>
                                            <?php //}?>
       <div class="row">
            <div class="col-lg-12"></div>
                <input type="hidden" name="patientNo" value="<?php echo $patientNo;?>">
                <input type="hidden" name="visitNo" value="<?php echo $visitNo;?>">
                
                
                
             <div class="col-lg-8"></div>
             <div class="col-lg-2">
                 <input type="hidden" name="action_type" value="add"/>
                <input type="submit" name="doUpdate" value="Save Records" class="btn btn-info form-control" style="color:white">
            </div>         
             <div class="col-lg-2">
                 <input type="hidden" name="action_type" value="cancel"/>
                <input type="submit" name="docancel" value="Cancel" class="btn btn-danger form-control" style="color:white">
            </div> 
        </div> -->
        </form>
        </div>
</div> </div> 
</div>
</div>
</div>
</div>
</div>                     
                </section>

    <!-- END: Content-->

   
    <script src="app-assets/jQuery/jQuery-2.1.4.min.js"></script>
    <script  src="app-assets/js/jquery-1.12.4.js"></script>
   
    <script src="app-assets/js/scripts/pages/hospital-patient-profile.js"></script>
</body>
</html>
<script type="text/javascript">
function validate(frm)
{
	var ele = frm.elements['feed2url[]'];
	if (! ele.length)
	{
		alert(ele.value);
	}
	for(var i=0; i<ele.length; i++)
	{
		alert(ele[i].value);
	}
	return true;
}
function add_feed2()
{
	var div1 = document.createElement('div');

	div1.innerHTML = document.getElementById('link').innerHTML;
	document.getElementById('newlink2').appendChild(div1);
}
</script>

<script>
$("#remarks").change(function() {
  if ($(this).val() == 2) {

    $('#div3').show();
    $('#clinic').attr('required');
    $('#clinic').attr('data-error');
    $('#div5').show();
    $('#description').attr('required');
    $('#description').attr('data-error');

    $('#div1').hide();
    $('#hospital').removeAttr('required', '');
    $('#hospital').removeAttr('data-error', 'This field is required.');
    $('#div2').hide();
    $('#ward').removeAttr('required');
    $('#ward').removeAttr('data-error');
    $('#div4').hide();
    $('#death').removeAttr('required');
    $('#death').removeAttr('data-error');

    
  } else if ($(this).val() == 5) {
    
    $('#div1').show();
    $('#hospital').attr('required');
    $('#hospital').attr('data-error');
    $('#div5').show();
    $('#description').attr('required');
    $('#description').attr('data-error');

    $('#div2').hide();
    $('#ward').removeAttr('required');
    $('#ward').removeAttr('data-error');
    $('#div3').hide();
    $('#clinic').removeAttr('required');
    $('#clinic').removeAttr('data-error');
    $('#div4').hide();
    $('#death').removeAttr('required');
    $('#death').removeAttr('data-error');
  } else if ($(this).val() == 4) {
    
    $('#div4').show();
    $('#death').attr('required');
    $('#death').attr('data-error');
    $('#div5').show();
    $('#description').attr('required');
    $('#description').attr('data-error');

    $('#div1').hide();
    $('#hospital').removeAttr('required');
    $('#hospital').removeAttr('data-error');
    $('#div2').hide();
    $('#ward').removeAttr('required');
    $('#ward').removeAttr('data-error');
    $('#div3').hide();
    $('#clinic').removeAttr('required');
    $('#clinic').removeAttr('data-error');
   }else if ($(this).val() == 3) {
    
    $('#div2').show();
    $('#ward').attr('required');
    $('#ward').attr('data-error');
    $('#div5').show();
    $('#description').attr('required');
    $('#description').attr('data-error');

    $('#div1').hide();
    $('#hospital').removeAttr('required', '');
    $('#hospital').removeAttr('data-error', 'This field is required.');
    $('#div3').hide();
    $('#clinic').removeAttr('required');
    $('#clinic').removeAttr('data-error');
    $('#div4').hide();
    $('#death').removeAttr('required');
    $('#death').removeAttr('data-error');
  }else if ($(this).val() == 1) {
    $('#div1').hide();
    $('#hospital').removeAttr('required', '');
    $('#hospital').removeAttr('data-error', 'This field is required.');
    $('#div2').hide();
    $('#ward').removeAttr('required');
    $('#ward').removeAttr('data-error');
    $('#div3').hide();
    $('#clinic').removeAttr('required');
    $('#clinic').removeAttr('data-error');
    $('#div5').hide();
    $('#description').removeAttr('required');
    $('#description').removeAttr('data-error');
  }

   else {
    $('#div1').hide();
    $('#hospital').removeAttr('required', '');
    $('#hospital').removeAttr('data-error', 'This field is required.');
    $('#div2').hide();
    $('#ward').removeAttr('required');
    $('#ward').removeAttr('data-error');
    $('#div3').hide();
    $('#clinic').removeAttr('required');
    $('#clinic').removeAttr('data-error');
    $('#div4').hide();
    $('#death').removeAttr('required');
    $('#death').removeAttr('data-error');
    $('#div5').hide();
    $('#description').removeAttr('required');
    $('#description').removeAttr('data-error');
  }
});
$("#remarks").trigger("change");


</script>