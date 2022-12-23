<?php

$db = new DBHelper();
$today = date("Y-m-d");


?>
  
  <script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   <?php
                        if($_SESSION['role_session']=='UjAw' | $_SESSION['role_session']=='UjA4' | $_SESSION['role_session']=='UjA3') {
                    ?>
<div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-eraser font-large-1 success"></i>Pharmacy</h2>
                    </div>
                </div>
            </div>
            <div class="jumbotron" style="background-color:lavender;">
            <h2>Direct Dispensing</h2>
            <hr>
            <div class="pull-right" style="margin-right:50px">
                <a class="btn btn-info  btn-sm" href="index3.php?sp=direct_dispency_form"  style="color:white;"><i class="la la-dollar font-small-2"></i> New Sales</a>               </div>
            </div>
               
                <!-- Appointment Bar Line Chart Ends -->
                <?php } else { 
                    include "patient_clinic_doctor.php";
                }
                    ?>
              

                 
                

                <!-- end doctor-->

              
                <script type="text/javascript">
    $(document).ready(function () {
        $("#patientdata").DataTable({
            "dom": 'Blfrtip',
            "paging":true,
            "buttons":[
                {
                    extend:'excel',
                    title: 'List of all Register',
                    footer:false,
                    exportOptions:{
                        columns: [0, 1, 2, 3,5,6,7]
                    }
                },
                ,
                {
                    extend: 'print',
                    title: 'List of all Register',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Register',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3,5,6,7]
                    },

                }

            ],
            "order": []
        });
    });
</script>


<script type="text/javascript">
function validate(frm)
{
	var ele = frm.elements['feedurl[]'];
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
function add_feed()
{
	var div1 = document.createElement('div');
	// Get template data
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
	// append to our form, so that template data
	//become part of form
	document.getElementById('newlink').appendChild(div1);
}
</script>

            </div>
        </div>
    </div>