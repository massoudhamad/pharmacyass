<?php
include("DB.php");
$db=new DBHelper();
$regionID=$_POST['regionID'];
if (!empty($regionID)) {
    $districts= $db->getRows('district',array('where'=>array('regionCode'=>$regionID),'order_by'=>'districtID ASC'));

if(!empty($districts)){ ?>
    <select name='districtID' id="districtID" class='form-control'>
    <option value=''>Select District</option>
    <?php
    foreach($districts as $district){ 
        $DistrictCode = $district['districtCode'];
        $DistrictName = $district['districtName'];
        ?>
        <option value="<?php echo $DistrictCode;?>"><?php echo $DistrictName;?></option>
       
        <?php
    }
    ?>
     </select>
     <?php
}else{?>
<select name='districtID' id="districtID" class='form-control'>
    
      
     <option>No Data(s) Found</option>
     </select>
    <?php
}
}
?>


   
    
