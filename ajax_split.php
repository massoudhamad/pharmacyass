
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
           
                $split = $db->SplitTime($from,$to,$Duration="60");
                
                    if(!empty($split)){
                                   ?>
                                    <select name="time" id='time' class="form-control chosen-select"  required="">
                                       <?php
                                           echo'<option value="">Select Time</option>';
                                            foreach($split as $key=> $value){ 
                                                 if(!empty($split)){
                                                         $aptTime = $db->getAppTime($employeeId,$date);
                                                         //var_dump($aptTime);
                                                       
                                            }


                                                   ?>
                                                        <option value="<?php echo $value; ?>"<?php  foreach($aptTime as $key){ 
                                                            $time =$key['time'];
                                                
                                                        if($value == $key['time']) { echo 'disabled="disabled"'; }}?>><?php echo $value; ?></option>
                                                        
                                                    <?php
                                                   
                                
                                                        }

                            }else{

                                echo' <div class="col-md-12">
                                <div class="form-group">
                               
                                            <input type="text" class="form-control  danger" readonly value ="No schedule Availabale"  name="time" required>
                                        </div>
                                </div>
                                
                                ';}?>                  
                    </select> 
                    <?php
            
                
            
    }else{
        echo' <div class="col-md-12">
        <div class="form-group">
       
                    <input "type="text" class="form-control danger" readonly value ="No schedule Availabale"  name="time" required>
                </div>
        </div>
        
        ';
    }
    
    

}else{
        echo' <div class="col-md-12">
        <div class="form-group">
       
                    <input "type="text" class="form-control danger" readonly value ="Please Choose Doctor or date"  name="time" required>
                </div>
        </div>
        
        ';
    }
    



?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#time").change(function () {
            var employeeId = $('#employeeId').val();
            var date=$("#datee").val();
            var time=$("#time").val();
            var dataString = 'employeeId='+ employeeId+'&date='+date+'&time='+time;
            //alert(dataString);
            $.ajax
            ({
                type: 'POST',
                url: "checkTimeApp.php",
                data:dataString,
                cache: false,
                success: function (data) {
                //    //window.location='ajax_split.php';
                    alert(data);
                //   //console.log(data);
                   // $("#datey").html(data);
                }
            });
        });
    });
</script>