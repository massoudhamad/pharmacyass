<style type="text/css">
#drugDispencing td.error {
    color: red;
    font-weight: bold;
}

.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="card-header">
            <h2> <i class="la la-stethoscope font-large-2 warning"></i>Patient Dispencing</h2>
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
                    $address=$patient['address'];
                    $telNumber=$patient['telNumber'];
                    $name="$fname $mname $lname";
                }
            }
          $services = $db->getRows('service',array('order_by'=>'subCategoryCode ASC'));
?>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <table id="ordertest" class="table table-hover">
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





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>List of Prescribed Medicines</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="dispencing" id="dispencing" method="post" id='drugDispencing'>
                            <input type="hidden" name="patientNo" value="<?php echo $patientNo?>">
                            <table class="table table-striped table-bordered patients-list" style="margin-top:20px;">
                                <thead>
                                    <tr>

                                        <th width="3px;">Select</th>
                                        <th>Medicine</th>
                                        <th>Dose</th>
                                        <th>Dispencing Quantity</th>
                                        <!-- <th>Price</th> -->


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //$services = $db->getRows('service',array('where'=>array('categoryID'=>$categoryID),'order_by'=>'subCategoryID ASC'));
                                        $newDrug  = 0;
                                        $today = date("Y-m-d");
                                        $medicine = $db->getPatientMedicine($patientNo,$today,$visitNo);
                                        if (!empty($medicine)){
                                            foreach ($medicine as $med) {                                               
                                                $id = $med['patient_medicationID'];
                                                $drugID = $med['drugID'];
                                                $newDrug = $med['drugID'];
                                                $dispensing_status = $med['dispensing_status'];
                                                $drugname = $db->getData('drugs','drugName','drugID',$drugID); 
                                                $dose = $med['dose'];
                                                ?>
                                    <tr>
                                        <td>
                                            <!-- <input type='checkbox' class='checkbox_class' name='drugID[]'
                                                value='<?php echo $newDrug;?>' id='drugID'> -->
                                            <?php 
                                                if($dispensing_status == 1){?>
                                            <input type="checkbox" class="checkbox" checked
                                                patient-no="<?php echo $patientNo?>" drug-id="<?php echo $drugID?>"
                                                visit-no="<?php echo $visitNo?>" />
                                            <?php
                                                }else{?>
                                            <input type="checkbox" class="checkbox" patient-no="<?php echo $patientNo?>"
                                                drug-id="<?php echo $drugID?>" visit-no="<?php echo $visitNo?>" />
                                            <?php
                                                }
                                                ?>
                                        </td>
                                        <td><?=  $drugname ?></td>
                                        <td><?=  $dose ?></td>
                                        <td><input type="number" name="prediscribed_quantity[]" placeholder="Quantity"
                                                class="form-control">
                                            <input style="display:none;" readonly type="number"
                                                name="prediscribed_quantity[]" placeholder="Quantity"
                                                class="form-control">
                                        </td>
                                        </td>
                                    </tr>
                                    <?php }
                                        }
                                        ?>
                                </tbody>
                            </table>
                            <div class="" style="margin-left:30px;">
                                <input type="checkbox" name="isChecked" checked><span style="font-weight:bold"> Print
                                    Patient
                                    prescription</span>
                            </div>
                            <br>
                    </div>

                </div>

                <div class="form-actions">
                    <div class="col-md-6">
                        <input type="hidden" name="visitNo" value="<?php echo $visitNo; ?>">
                        <input type="hidden" name="patientNo" value="<?php echo $patientNo; ?>">
                        <input type="hidden" name="action_type" value="addDispencing" />

                        <input type="submit" name="doSubmit" id="savebtn" value="Save" class="btn btn-primary">
                        <a target="_blank"
                            href="printcertificate.php?action=getPDF&patientNo=<?php echo $patientNo;?>&visitNo=<?php echo $visitNo;?>"
                            type="button" class="btn btn-success" name="doSubmit"><i class="la la-print"></i> Print
                            Prescrption</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div>
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
function select() {
    var x = document.getElementById('drugID[]');
    var x = document.register['register']['drugID[]'].value;
    if (x == ' ') {
        return false


    } else {
        return true;
    }
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#example1").DataTable({
        "processing": true,
        "paging": true,
        dom: 'Blfrtip',
        bLengthChange: true,
        "lengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 15,
        bInfo: false,
        "bAutoWidth": false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [
            [1, 'asc']
        ]
    });
});
</script>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Download the latest jquery.validate minfied version -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
// Waiting until DOM is ready

$().ready(function() {
    // Selecting the form and defining validation method
    $("#drugDispencing").validate({

        // Passing the object with custom rules
        rules: {
            // login - is the name of an input in the form
            'drugID[]': {
                required: true,
                // Setting email pattern for email input

            },
            "prediscribed_quantity[]": {
                required: true,
                // Setting email pattern for email input

            },
            "quantityType[]": {
                required: true,
                // Setting email pattern for email input

            }
        },
        // Setting error messages for the fields
        messages: {
            reaction: {
                required: "This Field is Required",

            },

        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
<script type="text/javascript">
function validateChecks() {
    var chks = document.getElementsByName('drugID[]');
    var checkCount = 0;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            checkCount++;
        }
    }
    if (checkCount < 1) {
        alert('Please Select atleast one Medicine.');
        return false;
    }
    return true;
}
</script>



<script type="text/javascript">
$(document).ready(function() {
    $("#savebtn").click(function() {
        $('input[name="isChecked"]:checked').each(function() {
            //alert(this.value);
            $.ajax({
                type: "POST",
                url: "ajax_shehia.php",
                data: dataString,
                cache: false,
                success: function(html) {
                    $("#shehiaID").html(html);
                }
            });

        });

    });
});

$(".checkbox_class").click(function() {
    var onoffswitch = $('.checkbox_class').val();
    var patientNo = $('#patientNo').val();
    var visitNo = $('#visitNo').val();
    var onoffswitchint = 'onoffswitch=' + onoffswitch + "-" + patientNo + "-" + visitNo;
    //alert(onoffswitchint);
    $.ajax({

        type: "POST",
        url: "update_dispaencingStatus.php",
        data: onoffswitchint,
        success: function(response) {
            //alert(response);
            content.html(response);
        }
    });

});


// IIFE (Immediately Invoke Function Expressions)
(function(myapp) {
    myapp(window.jQuery, window, document);
}(function myapp($, window, document) {
    // $ is now locally scoped
    $(function() {
        // dom is now ready
        //var dtTable = $("#sometable").DataTable();

        // dom events
        $(document).on("click", '.checkbox', function() {
            if ($(this).prop('checked') == true) {
                var $this = $(this);
                var drugID = $this.attr("drug-id");
                var patientNo = $this.attr("patient-no");
                var visitNo = $this.attr("visit-no");
                var data = 'onoffswitch=' + drugID + "-" + patientNo + "-" + visitNo
                //alert(data);
                // send ajax request 
                $.ajax({
                    url: "update_dispaencingStatus.php",
                    type: 'post',
                    data: data,
                    beforeSend: function() {
                        //alert(data);
                        // do something here before sending ajax
                    },
                    success: function(data) {
                        // do something here
                        window.location.href = 'index3.php';

                        //alert(data);
                        if (data.success) {
                            //alert(data); 
                        }
                    },
                    error: function(data) {
                        // do something here if error 
                        //alert(data);
                        // console.warn(data);
                    }
                });
            } else {
                //alert('Not Checked');
                var $this = $(this);
                var drugID = $this.attr("drug-id");
                var patientNo = $this.attr("patient-no");
                var visitNo = $this.attr("visit-no");
                var data = 'onoffswitch=' + drugID + "-" + patientNo + "-" + visitNo
                //alert(data);
                // send ajax request 
                $.ajax({
                    url: "update_dispaencingStatusNotChecked.php",
                    type: 'post',
                    data: data,
                    beforeSend: function() {
                        //alert(data);
                        // do something here before sending ajax
                    },
                    success: function(data) {
                        // do something here
                        //alert(data);
                        if (data.success) {
                            //alert(data); 
                        }
                    },
                    error: function(data) {
                        // do something here if error 
                        //alert(data);
                        // console.warn(data);
                    }
                });
            }
        });
    });
    // The rest of the code goes here
}));
</script>