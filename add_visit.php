
<script type="text/javascript">
    $(document).ready(function () {
        $("#example1").DataTable({
            "processing": true,
             "paging":true,
             dom: 'Blfrtip',
              bLengthChange: true,
             "lengthMenu": [ [5,10, 15, 25, 50, 100, -1], [5,10, 15, 25, 50, 100, "All"] ],
             "iDisplayLength": 15,
             bInfo: false,
             "bAutoWidth": false,
             buttons: [
                 'copy', 'csv', 'excel', 'pdf', 'print'
             ],
             "order": [[1, 'asc']]
            });
    });
</script>
<!-- <script>
$(document).ready(function(){
    $("form").submit(function(){
 if ($('input:checkbox').filter(':checked').length < 1){
        alert("Please select atleast one service");
 return false;
 }
    });
});
</script> -->

    <div class="content-wrapper">
        <div class="col-12">
            <div  class="card-header">
                 <h2> <i class="la la-user-plus font-large-2 info"></i> Register Patient Visit</h2>
            </div>
        </div>
    
    <br>
    <div>
    
        <div class="col-md-12">
             <div class="card">
                    <div  class="card-body">
                    <?php
                    
                $db = new DBHelper();
                $patientNo=$_REQUEST['patientNo'];
                $visitNo=$_REQUEST['visitNo'];
                
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

                        $paymenttypeCode=$patient['paymenttypeCode'];
                        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$paymenttypeCode);
                        //$visitStatus = $db ->getData('patientvisit','visitStatus','visitStatus',$patient['visitStatus']);
                        $visitStatus=$db->getData("patientvisit","visitStatus"," visitNo",$patientNo);
                        
                       echo  $visitStatus;
                    }
                }

               
                ?>
                        
                                <table class="table table-striped table-bordered patients-list" id="example">
                                    <tr>
                                        <th>Patient No</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>Address</th>
                                        <th>Health Scheme</th>
                                        <th>Visit Status</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $patientNo;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $db->ageCalculator($dob);?></td>
                                        <td><?php echo $sex;?></td>
                                        <td><?php echo $address;?></td>
                                        <td><?php echo $healthScheme;?></td>
                                        <?php
                                        if($visitStatus==0)
                                        {?>
                                        <td>
                                            <a href="action_close_visit.php?action_type=close&patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>" class="label label-success" onclick="return confirm('Are you sure You want to Close Patient Visit?');">Open</a></td>
                                        <?php }
                                        else
                                        {
                                        ?>
                                        <td><span class="label label-danger">Closed</span></td>
                                        <?php
                                        }
                                         $ageAtVisit =  $db->ageCalculator1($dob)
                                        ?>
                                        
                                    </tr>

                                </table>
                              </div>  
                            </div>
                            
                            
                   <!-- end -->
                      
                       
               
               <!-- <div class="container-fluid"> -->
               <hr>
                     <form name="" method="post" action="">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <select name="categoryCode" class="form-control choosen-select" id='categoryCode' required=""
                            style='width:200px;'>
                            <?php
                                        $category = $db->getserviceRows();
                                        if(!empty($category)){
                                            echo"<option value=''>Select Service Category</option>";
                                            $count = 0; foreach($category as $cat){ $count++;
                                                $catName=$cat['categoryName'];
                                                $catID=$cat['categoryCode'];
                                                ?>
                            <option value="<?php echo $catID.",".$paymenttypeCode.",".$patientNo.",".$ageAtVisit;?>"><?php echo $catName;?></option>
                            <?php }}
                                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="submit" name="doSearch" value="Search Service" class="btn btn-info"
                            style='margin-left:35px;'>
                    </div>
                </div>
        </form>
    </div>

    <hr>
    <div id="govist"></div>
    <?php
                            //Save Records Buttoon
                            if((isset($_POST['doSearch'])=="Search Service")||(isset($_REQUEST['action'])=="getRecords")) {
                                if (isset($_POST['doSearch']) == "Search Service") {
                                    $categoryCode = $_POST['categoryID'];
                                } else {
                                    $categoryCode = $_REQUEST['categoryID'];
                                }
                                ?>
    <div class="container-fluid">
        <form name="register" id="register" method="post" action="action_patient_service.php">
            <?php 
                                  
               
            ?>
            <div class="row" style="margin-top:10px;">
            </div>
            <div class=" form-inline" id="triageOptional" style="display:none">
                <label>Pass through Triage?</label>&nbsp; &nbsp;
                <select name="triage" id='triage' class="form-control" required>
                    <option value='no'>No (Default)</option>
                    <option value="yes">Yes</option>

                </select>
            </div>
    </div>
  
</div>


                         
                                    <div class="row" style="margin-left:2%; margin-bottom:20px;">
                                        <input type="hidden" name="number_applicants" value="<?php echo $id; ?>">
                                        <input type="hidden" name="patientNo" value="<?php echo $patientNo; ?>">
                                        
                                            <div class="col-0.2">
                                                <input type="hidden" name="action_type" value="add"/>
                                                <input type="submit" name="doUpdate" value="Save" class="btn btn-info">
                                            </div>
                                            <div class="col-1" >
                                                <input type="hidden" name="action_type" value="cancel"/>
                                                <input type="submit" name="docancel" value="Cancel" class="btn btn-info">
                                            </div>
                                    </div>
                                </div>
                                </div>
                               
                                </form>
                                <div>
                            </div>
                                <?php
                            }
                            ?>
                            <br>
                             <?php include "service.php"?>
                             
            </div>
           
        </div>
       
    </div>
   
<script>
    function select(){
       // var x = document.getElementById('id[]') ;
       var x = document.['register']['id[]'].value;
        if(x==''){
            return false;
            alert'please select atleast one service';
        }else{
            return true;
        }
    }
</script>
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
<script>
$("#triage").change(function() {
    var data = $(this).val()
    //alert(data);
    if (data == 'yes') {
        $("#doctorsAvailable").hide();
    } else {
        $("#doctorsAvailable").show();
    }


});
</script>
<script>
$("#categoryCode").change(function() {
    var data = $(this).val()
    //alert(data);
    if (data == 'Q0FUMDE=') {
        $("#docAppoitment").show();
        $("#triageOptional").show();
    } else {
        $("#docAppoitment").hide();
        $("#triageOptional").hide();
    }


});
</script>
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



