<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Hospital Activation</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
    <link rel="stylesheet" href="sweet/dist/sweetalert.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
   
    <div class="container">
    <br>
    <?php
    include 'DB.php';
    $db = new DBHelper();
    $region = $db->getRows('region',array('order_by'=>'regionCode ASC'));
    $district = $db->getRows('district',array('order_by'=>'districtID ASC'));
    $shehia = $db->getRows('shehia',array('order_by'=>'shehiaID ASC'));
    $zone = $db->getRows('zone',array('order_by'=>'zoneID ASC'));
    ?>
    <center><h1>Aspire EHR - Hospital Activation </h1></center>
        <div class="row">
        <div class="col-10 mx-auto p-4 m-5 border-light shadow-sm">
        
   
        <div class="form-style">
        <form action="action_administrative_entities.php">
        <div class="container-fluid">
            <div class="form-body">
            <?php
            if(empty( $region & $district & $shehia & $zone )){?>

                <h4 class="form-section"><i class="la la-home"></i>Step 5: Load Administrative Entities</h4>
                    <p> Your hospital requires this set of pre-defined services to select the services you offer.To load the services please click the below button.</p>
                    
            </div>
        <div>
            <div class="col-md-6">
                    <input type="submit"  id="loadservices" value="Load Services"  class="btn btn-warning pull-right" style="margin-bottom:20px;">
                    
            </div>
        </div>
        <div class="d-flex justify-content-center" >
            <div class="spinner-border" role="status" style="display:none;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        
        
        <?php
            
            }else{
                
                if(!empty($_SESSION['msg'])){?>
                <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                <script src="https://code.jquery.com/qunit/qunit-1.18.0.js"></script>    
                <script type="text/javascript">
                

						$(document).ready(function() {
									// data-tables
									swal('Added','Administrative Entities Loaded Successfully','success');
                        });			
                </script>
                <?php
                session_unset();
                }
                
                
                ?>

                <h4 class="form-section"><i class="la la-home"></i>Step 5: Load Hospital Services</h4>
                <p> Your hospital requires this set of officially defined administrative entities to operate.To load the administrative entities please click the below button.</p>
                <p>Region Loaded : <?php echo $db->getTotalRegion()?></p>
                <p>District Categories Loaded : <?php echo $db->getTotalDistrict()?></p>
                <p>Shehia Sub Categories Loaded : <?php echo $db->getTotalShehia()?></p>
                <p>Zone Sub Categories Loaded : <?php echo $db->getTotalZone()?></p>
        </div>
                

        <div class="row pull-right ">
                <div class="col-md-12 ">
                    <a href="activate-meta-data.php"type="submit" class="btn btn-primary w-100 font-weight-bold mt-2 ">Save and Continue</a>
                        <input type="hidden" name="action_type" value="activatehospital">
                </div>
                <?php
            }
            ?>
                
                                                 
        
            </form>                                                     
            </div>
        </div>
    </div>

 <!-- END: Content-->

 <script src="sweet/dist/sweetalert.min.js"></script>
 <script type="text/javascript" src="js/jquery.min.js"></script>
   <!-- BEGIN: Vendor JS-->
   <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script> -->
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="app-assets/js/scripts/forms/form-login-register.js"></script> -->
    <!-- END: Page JS-->
    
  <!-- Download the latest jquery.validate minfied version -->
  <script>
   $(function(){
   $('#loadservices').on('click',function(){  
      $('.spinner-border').show();
      $('#loadservices').hide();
   });
});
  </script>
  