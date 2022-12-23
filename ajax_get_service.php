
<?php 
include("DB.php");
$db = new DBHelper(); 
$subcategory = $_POST['subCategoryCode'];

if(!empty($subcategory)){
    $services = $db->getRows('service',array('where'=>array('subCategoryCode'=>$subcategory),'order_by'=>'serviceID ASC')); ?>
    <select name='serviceID' class='form-control'>
    <option value=''>Select Here</option>
    <?php
   
    foreach($services as $serv){ 
        $serviceNam = $serv['serviceName'];
        $serviceCode = $serv['serviceCode'];
        ?>
        <option value="<?php echo $serviceCode;?>"><?php echo $serviceNam;?></option>
        <?php
    }
}else{?>
    No service(s) Found
    <?php
    //echo "No service(s) Found";
   
}
?>


   
    </select>


 



