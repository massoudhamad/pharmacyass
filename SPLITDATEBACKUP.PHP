
<?php
include("DB.php");
$db=new DBHelper();
$employeeId=$_POST['employeeId'];
$date=$_POST['date'];
// $checkDate = $db->getAppTime($employeeId,$date);
// var_dump($checkDate);
if($employeeId && $date)
{
    $dates = $db->getDates($employeeId,$date);
    if(!empty($dates))
    {
        foreach($dates as $dt){
            $from = $dt['from_'];
            $to = $dt['to_'];
        }
            if($from && $to){
                $split = $db->SplitTime($from,$to,$Duration="60");
                if($split){
                    if(!empty($split)){
                                   ?>
                                    <select name="time" class="form-control chosen-select" required="">
                                       <?php
                                           echo'<option value="">Select Time</option>';
                                           $count = 0; foreach($split as $key=> $value){ $count++;
                                               //echo $valu;
                                               ?>
                                           
                                               <option value="<?php echo $value;?>"><?php echo $value;?></option>
                               <?php 
                             
                            
                           }
                        
                            }else{
                                    echo 'NO';
                                }
                            
                            
                          
                                }else{

                                echo' <div class="col-md-4">
                                <div class="form-group">
                               
                                            <input type="text" class="form-control" value ="No schedule Availabale"  name="time" required>
                                        </div>
                                </div>
                                
                                ';}?>                  
                    </select> 
                    <?php
            
                } else{
                    echo 'bado';
                }
            }else{
                echo'sivoo';
            }
        }else{
            echo' <div class="col-md-12">
            <div class="form-group">
           
                        <input "type="text" class="form-control danger" value ="No schedule Availabale"  name="time" required>
                    </div>
            </div>
            
            ';
        }
        }else{
            ECHO 'GDFGDFGGF';
        }
    
    






?>