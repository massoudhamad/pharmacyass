<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-server font-large-2 success"></i>Monthly Lab Report
                    <div class="pull-right" style="margin-right:00px;">
                        <div class="col-8">
                            <select name="hospitalCode" class="form-control" id="month" style="margin-right:150px;">
                                <?php
                                         $db = new DBHelper();
                                         $category = $db->getPatientvisitTime();
                                        if(!empty($category)){
                                            echo"<option value=''>Select Month</option>";
                                                foreach($category as $cat){
                                                $month=$cat['month'];
                                                $monthNo=$cat['montno'];
                                                $year=$cat['year'];
                                                
                                                ?>

                                <option value="<?php echo $monthNo;?>"><?php echo $month." - ".$year;?></option>
                                <?php }}
                                        ?>
                            </select>
                        </div>
                    </div>
                </h2>
            </div>
        </div>
    </div>
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
                        <p>
                            <h1>
                                <center> Please choose month to display the report</center>
                            </h1>
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#month").change(function() {
        var id = $(this).val();
        var dataString = 'month=' + id;
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "ajax_lab_report_with_gender.php",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#body").html(html);
            }
        });
    });
});
</script>