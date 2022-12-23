

<?php
include("DB.php");
$db=new DBHelper();
$auth_user = new DBHelper();
$userID = $_SESSION['user_session'];
$user_privilege=$_SESSION['role_session'];
$hospital_code=$_SESSION['hospitalCode'];
                        $userData=$auth_user->getRows("users",array('where'=>array('userID'=>$userID),'order_by'=>'userID'));
                        if(!empty($userData))
                        { 
                             foreach($userData as $user)
                             {
                                $fname=$user['firstName'];
                                $lname=$user['lastName'];
                                $roleID=$user['roleCode'];
                                $hCode=$user['hospitalCode'];
                            }
                        }
                        $roleName=$auth_user->getData("roles","role","roleCode",$roleID);
                        if($hCode=="")
                            $section="";
                        else
                            $section="-".$hCode;
                        $_SESSION['hospitalCode']=$hCode;
                        $name="$fname $lname";
                        $roleName=$auth_user->getData("roles","role","roleCode",$roleID);
                        $hospitalName=$auth_user->getData("hospital","hospitalName","hospitalCode",$hCode);
                       
                      
$month=$_POST['month'];
$monthy = $month;
if($month){
    if($monthy ==1){
        $monthy = 'January';
    }elseif($monthy ==2){
        $monthy = 'February';
    }elseif($monthy ==3){
        $monthy = 'March';
    }elseif($monthy ==4){
        $monthy = 'April';
    }elseif($monthy ==5){
        $monthy = 'May';
    }elseif($monthy ==6){
        $monthy = 'June';
    }elseif($monthy ==7){
        $monthy = 'Jully';
    }elseif($monthy ==8){
        $monthy = 'August';
    }elseif($monthy ==9){
        $monthy = 'September';
    }elseif($monthy ==10){
        $monthy = 'October';
    }elseif($monthy ==11){
        $monthy = 'November';
    }else{
        $monthy = 'December';
    }?>
    <div class="content-body" id='body'>
    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="pull-right" style="margin-right:50px">
                                    <!-- <div class="col-12">
                                        <select name="hospitalCode" class="form-control chosen-select" id="hospital">
                                            <option value="">Select Here</option>
                                            <option value=""></option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                            <div id='table'>
                            <h2 style='margin-left:20px;'> <i class=""></i>  Monthly Lab Report With Gender for <?php echo $monthy?><small> (<?php echo $db->decrypt($hospitalName)?>)</small></p></h2>
                            <div class="form-actions">
                             <div class="col-lg-12">
                            <input type="button" value='EXCEL' onclick="Export()" class="btn btn-info" id='btnExport3'>
                            <input type="submit" name="doSubmit" value="PDF" class="btn btn-info" style="color:white"/>
                        </div>
                        </div>
                        <table id="example" class="table table-striped table-bordered table-condensed" style='width:100%;margin-top:20px;'>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Test</th>
                                <th colspan='2'><center> Under 5yrs</center></th>
                                <th  colspan='2'><center>5yrs+</center></th>
                                <th>Total</th>
                            
                            </tr>

                            <tr>
                                <th></th>
                                <th></th>

                                <th>Male</th>
                                <th>Female</th>


                                <th>Male</th>
                                <th>Female</th>
                            
                            </tr>
                               
                        </thead>
                        <tbody>
                        <?php
                                               
                                                $LabReport = $db->getLabReportWithGender($month);
                                                ?>
                                                <?php if(!empty($LabReport))
                                                    {
                                                        
                                                        $x=0;
                                                        foreach ($LabReport as $patient)
                                                        {
                                                            $x++;
                                                            //$icd=$patient['icdcode'];
                                                            $serviceName=$patient['serviceName'];
                                                            $underfiveNomale=$patient['underfivenoMale'];
                                                            $underfiveNofemale=$patient['underfivenofe'];

                                                            $overfiveNomale=$patient['overfivenoMale'];
                                                            $overfiveNofemale=$patient['Overfivenofe'];
                                                           
                                                           
                                                            
                                                        ?>
                                                        <tr>
                                <td><?php echo $x;?></td>
                                <td><?php echo $serviceName;?></td>
                                <td><?php echo $underfiveNomale;?></td>
                                <td><?php echo $underfiveNofemale;?></td>


                                <td><?php echo $overfiveNomale;?></td>
                                <td><?php echo $overfiveNofemale;?></td>
                                <td></td>
                                
                        </tr>
                        
                        <?php
                     }
                    }
                            ?>
                            

                    </table>

                  
                   </div>
                </div>
            </div>
                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   <?php
}else{?>

<div class="content-body" id='body'>
    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="pull-right" style="margin-right:50px">
                                    <!-- <div class="col-12">
                                        <select name="hospitalCode" class="form-control chosen-select" id="hospital">
                                            <option value="">Select Here</option>
                                            <option value=""></option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                            <div id='body'>
                                <p><h1><center> Please choose month to display the report</center></h1></p>
                            </div>
                </div>
            </div>
                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php
   
}
?>
<script>
    $(document).ready(function() {
$("#btnExport3").click(function(e) {

    var a = document.createElement('a');
    //getting data from our div that contains the HTML table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
    a.href = data_type + ', ' + table_html;
    //setting the file name
    a.download = 'Lab Monthly Report With Gender.xlsx';
    //triggering the function
    a.click();
    //just in case, prevent default behaviour
    e.preventDefault();
});
});
</script>

