<script type="text/javascript">
 $(document).ready(function () {
           $('#newtest').DataTable(
               {
                   scrollX: false,
                   paging: true,
                  
               });
         });
</script>
<script type="text/javascript">
    $(document).ready(function () {
    $("#orderTest").DataTable({
        paging:true,
        dom: 'Blfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf'
                ]
            });
        });
</script>

    <div class="content-wrapper">
        <div class="content-header">
            <div  class="card-header">
                  <h2><i class="la la-medkit font-large-2 success"></i>Diagnosis</h2>
            </div>
       </div>
      
       <?php  
             
          $db = new DBHelper();         
            $patientNo=$db->my_simple_crypt($_GET['id'],'d');
            $visitNo=$_REQUEST['visitNo'];
            $date=$_REQUEST['date'];
                
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
    <div class="row">
      <div class="col-12">   
        <table  id="orderTest" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Disease Name</th>
                    <th>New case/Repeate case</th>
                    <th>Document</th>
                </tr>
            </thead>
      <tbody>
    <?php 
    $disease = $db->getRows('patientdiagnosis',array('where'=>array('patientNo'=>$patientNo,'reportingDate'=>$date)));
    if(!empty($disease)){ 
    $count = 0; 
    foreach($disease as $d){ 
    $count++;
    $icdcode = $d['icdcode'];
    $patientDiseaseCase =$d['patientDiseaseCase']
    ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $db->getData("icdcode","icdName","icdcode",$icdcode);?></td> 
            <td><?php if($patientDiseaseCase==0) echo 'Repeate case'; 
            else if($patientDiseaseCase==1) echo 'New case'; ?></td>
            <td>
                <a type="button" href="delete_diagnosis.php?patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>&icdcode=<?php echo $icdcode?>"><i class="la la-trash success"></i></a>
            </td>
          </tr>
          <?php } } ?>
</tbody>
</table>
        <div class="row">
                <div class="col-2">
                    <a type="button" href="index3.php?sp=consultation&patientNo=<?php echo $patientNo?>&visitNo=<?php echo $visitNo?>" class="form-control btn btn-danger" style="color:white;">Cancel</a>
                </div>
        </div>
</div>
</div>
</div>
</div>
 


