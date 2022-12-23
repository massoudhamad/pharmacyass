<?php
include("DB.php");
$db=new DBHelper();
$criteria=$_POST['criteria'];

if($criteria == 1)
{
    if(!empty($criteria)){?>
        <div class="content-body">
    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="pull-right" style="margin-right:50px">
                                    <div class="col-12">
                                        <select name="hospitalCode" class="form-control chosen-select" id="hospital">
                                            <option value="">Select Here</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="example" class="table table-striped table-bordered table-condensed" style='width:100%:'>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Dignosis</th>
                                <th colspan='2'><center>5yrs and above</center></th>
                                <th colspan='2'><center>Under 5yrs</center></th>
                              
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>New case</th>
                                <th>Repeate case</th>
                                <th>New case</th>
                                <th>Repeate case</th>
                               
                        </thead>
                        <tbody>
                        <?php
                                                $db = new DBHelper();
                                                $diagnosisReport = $db->getDiagnosisReport();
                                                ?>
                                                <?php if(!empty($diagnosisReport))
                                                    {
                                                        
                                                        $x=0;
                                                        foreach ($diagnosisReport as $patient)
                                                        {
                                                            $x++;
                                                            $icd=$patient['icdcode'];
                                                            $newcase=$patient['new'];
                                                            $oldcase=$patient['repeate'];
                                                            $age=$patient['AGE'];
                                                           
                                                           
                                                            
                                                        ?>
                                                        <tr>
                                <td><?php echo $x;?></td>
                                <td><?php echo $db->getData("icdcode","icdName","icdcode",$icd);?></td>
                                <?php 
                                  
                                if($age > 5){
                                    $overfiverepeatecase = $newcase;
                                    $overfivenew = $oldcase;
                                    
                                }else{

                                    $underfiverepeatecase =$newcase;
                                    $underfivenew= $oldcase;

                                  
                                  
                                }
                                ?>
                                <td><?php echo $overfivenew;?></td>
                                <td><?php echo $overfiverepeatecase;?></td>
                                <td><?php echo $underfivenew;?></td>
                                <td><?php echo $underfiverepeatecase;?></td>
                                
                        </tr>
                        <?php
                     }
                    }
                

                ?>
                <th></th>
                                <th></th>
                                <th>New case(Total):</th>
                                <th>Repeate case(Total):</th>
                                <th>New case(Total)</th>
                                <th>Repeate case(Total):</th>
                    </table>
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
}else{

    echo 'no way';
}
?>
