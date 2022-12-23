<?php
include_once "DB.php";
$db = new DBHelper();
$servicecategoryy = $db->getRows('servicecategory',array('order_by'=>'categoryID ASC'));
$subcategory = $db->getRows('servicesubcategory',array('order_by'=>'subcategoryID ASC'));
$service = $db->getRows('service',array('order_by'=>'serviceID ASC'));
$cadre = $db->getRows('cadre',array('order_by'=>'cadreID ASC'));
$diseases = $db->getRows('diseases',array('order_by'=>'ICDCode ASC'));
$district = $db->getRows('district',array('order_by'=>'districtCode ASC'));

$hospitallevel = $db->getRows('hospitallevel',array('order_by'=>'hospitalLevelID ASC'));
$paymenttype = $db->getRows('paymenttype',array('order_by'=>'paymentTypeCode ASC'));
$region = $db->getRows('region',array('order_by'=>'regionCode ASC'));
$shehia = $db->getRows('shehia',array('order_by'=>'shehiaCode ASC'));
$zone = $db->getRows('zone',array('order_by'=>'zoneCode ASC'));
//$district = $db->getRows('district',array('order_by'=>'districtCode ASC'));
?>

    <div class="row">
    <div class="col-10 mx-auto p-4 m-5 border-light shadow-sm">
    
    

    <div class="form-style">
    <form action="action_check_updates.php">
    <div class="container-fluid">
        <div class="form-body">

            <h4 class="form-section"><i class="la la-home"></i> Updates Results</h4>
                <p> Your hospital needs to check for updates from the Electronic Health Record Server</p>
                
        </div>
    <div>
     <div class="row">
            <div class="col-md-6">
                <div class="form-group">
              
                     <strong>
                     <?php 
                     $url = "http://localhost/ehr-server/data/get_category_json_api.php";
                     $servicecategories =  $db->getAPI($url);
                               if(sizeof($servicecategories) == sizeof($servicecategoryy)){?>
                               
                                    <p>Service Category : No Update Found </p>
                                    <?php
                                }else{?>
                                    <p>Service Category : New Update Found</p>
                                    <?php
                                    }
                    ?>
                     <!-- <p>Service Category : <?php echo $db->getTotalService()?></p> -->
                      <p>Service subcategory : <?php echo $db->getTotalService()?></p>
                       <p>Service : <?php echo $db->getTotalService()?></p>
                        <p>Cadre : <?php echo $db->getTotalService()?></p>
                         <p>Diseases : <?php echo $db->getTotalService()?></p></strong>
                    </div>
                            </div>
                          
                            
                            <div class="col-md-6">
                            
                       <strong><p>District : <?php echo $db->getTotalService()?></p>
                      <p>Hospitallevel : <?php echo $db->getTotalService()?></p>
                       <p>Paymenttype : <?php echo $db->getTotalService()?></p>
                        <p>Region : <?php echo $db->getTotalService()?></p>
                         <p>Shehia : <?php echo $db->getTotalService()?></p></strong>
        </div>
        </div>
            
                
        </div>
    </div>
      <input type="submit"  id="loadservices" value="Save updates"  class="btn btn-primary pull-right" style="margin-bottom:20px;">
     <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none;">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    
    <!-- <?php
        
       
            
             if(!empty($_SESSION['msg'])):?>
                <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                <script src="https://code.jquery.com/qunit/qunit-1.18.0.js"></script>    
                    <script>
                    setTimeout(function() {
                        swal({
                            title: "Service Successfully Loaded!",
                            text: "Your required to relogin to continue using Aspire EHR. Please remember to register system users  as well as services your hospital is offering",
                            type: "success",
                            confirmButtonText: "Ok"
                        }, function() {
                            window.location = "index3.php";
                        }, 1000);
                    });
                    </script>   
                <?php
            session_unset();
            endif;?>

            <h4 class="form-section"><i class="la la-home"></i> New Updates Found</h4>
            <p> The following are the newly updates found during update cheking</p>
            <p>Services Loaded : <?php echo $db->getTotalService()?></p>
            <p>Services Sub Categories Loaded : <?php echo $db->getTotalSubCategory()?></p>
            <p>Services Categories Loaded : <?php echo $db->getTotalCategory()?></p>
           
    </div>
            

    <div class="row pull-right ">
            <div class="col-md-12 ">
                <a href="activate-disease.php"type="submit" class="btn btn-primary w-100 font-weight-bold mt-2 ">Save and Continue</a>
                    <input type="hidden" name="action_type" value="activatehospital">
            </div>
            <?php
      
        ?> -->
            
                                             
    
        </form>                                                     
        </div>
    </div>
</div>
</div>
</div>