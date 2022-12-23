
<?php
include("DB.php");
$db=new DBHelper();
$doctor=$_POST['employeeId'];
if($doctor)
{       echo'
    <div class="row">
    <div class="row col-lg-12">
            <div class="col-md-4">
                <h3>Upcoming Schedule for:</h3> 
            </div>
            <div class="col-md-5">
                <h3><div  id="docname"></div></h3> 
            </div>
            <div class="col-lg-2">
                <a class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#add_new_zone_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Create Schedule</a>
            </div>
        </div>
    </div> 
 </div>
 <br>
    ';
   
    $docSchedule= $db->getRows('schedule',array('where'=>array('employeeId'=>$doctor),'order_by'=>'scheduleID ASC'));
    if(!empty($docSchedule))
    {
        echo'

        <div class="row">
            <div class="col-12">
                <div class="card">
                     <div class="table-responsive">
                            <table   class="table">
                        <thead>
                            <tr>'?>
                            <input type="hidden" id="doctor" value="<?php echo $doctor ?>" name="doctor">
                                <?php echo'<th>No</th>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Clinic</th>
                                
                                <th>From (Time)</th>
                                <th>To (Time)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>'?>
                    
                                                    <?php if(!empty($docSchedule))
                                                        {
                                                            
                                                            $x=0;
                                                            foreach ($docSchedule as $sc)
                                                            {
                                                                $x++;
                                                                $date=$sc["date"];
                                                                $clinic=$sc['clinicCode'];
                                                                $From=$sc["from_"];
                                                                $To=$sc["to_"];
                                                                $ClinicName =  $db->getData("clinic","clinicName","clinicCode",$clinic);
                                                                $day=$sc["date"];
                                                                $dayname = date('l',strtotime($day));
                                                                // $day = $db->getDayName();
                                                                // //var_dump($day);
                                                                //     foreach($day as $key=>$value){
                                                                //         echo $value;
                                                                //     }
                                                            
                                                                
                                                            
                                                                
                                                            ?>
                                                    <tr>
                                                        <td><?php echo $x;?></td>
                                                        <td><?php echo $dayname?></td>
                                                        <td><?php echo $date;?></td>
                                                        <td><?php echo $ClinicName;?></td>
                                                        <td><?php echo $From;?></td>
                                                        <td><?php echo $To; ?></td>
                                                    
                                                        
                                                        <td>
                                                            <a type="button" class="btn btn-info btn-sm" title="Modifiy Schedule Information" href=""><i class="ft-edit" > Modify</i></a>
                                                            <?php
                                                            $check= $db->CheckSchedule($date,$doctor);
                                                            //var_dump($check);
                                                                if(!empty($check))
                                                                {
                                                                 
                                                                ?>
                                                                      <a type="button" id="<?php echo $date;?>" class="btn btn-info btn-sm " onclick="return confirm('Patients have been booked to this doctor in this date.You need to reschedule patient appointments before deleting the doctors schedule');" href="index3.php?sp=Patient_reschedule&&employeeId=<?php echo $doctor;?>"  title="delete Schedule Information" ><i class="ft-delete" > Delete</i></a>
                                                                  <?php
                                                                   }else{?>
                                              
                                                                     <a type="button" class="btn btn-info btn-sm " title="delete Schedule Information" onclick="return confirm('There is no any appointment in this schedule, Are you sure you want to delete the appointment?');" href="deleteSchedule.php?date=<?php echo $date;?>&employeeId=<?php echo $doctor;?>" ><i class="ft-delete" > Delete</i></a>
                                                                      
                                                                       <?php
                                                                   }
                                                                   ?>
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php }
                                                        }else{
                                                                

                                                        }
                                                    
                                                    ?>
                                                
                                                </tbody>

                                            </table>

                                    
                                
                            </div>
                        </div>
                    </div>
                </div></div>

            </div>
       
    
                </tbody>

            </table>

        
    
</div>
</div>
</div>
</div>

</div>
<?php


        }else{
            echo 'No schedule Available ';
        }

    }else{

        echo 'Please Choose Doctor To Continue';
    }

?>

<script type="text/javascript">
    $(document).ready(function() {
        $(".delete").click(function () {
            var date = $(this).attr("id");
            var employeId = $('#doctor').val();
            var dataString = 'aptDate='+date+'&employeeId='+employeId;
            //alert(dataString);
            $.ajax
            ({
                type: 'POST',
                url: "ajax_checkAppointment.php",
                data:dataString,
                cache: false,
                success: function (data) {
                   // alert(data);
                    window.location="index3.php?sp=Patient_reschedule&employeeId=<?php echo $doctor?>";
                   //console.log(data);
                  
                 
                   $("#day").html(data);
                }
            });
        });
    });
</script>
