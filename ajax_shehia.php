<?php
include("DB.php");
$db=new DBHelper();
$districtID=$_POST['districtID'];
if (!empty($districtID)) {
    $shehias= $db->getRows('shehia',array('where'=>array('districtCode'=>$districtID),'order_by'=>'shehiaID ASC'));

if(!empty($shehias)){ ?>
    <select name='shehiaID' class='form-control'>
    <option value=''>Select District</option>
    <?php
    foreach($shehias as $shehia){ 
        $shehiaCode = $shehia['shehiaCode'];
        $shehiaName = $shehia['shehiaName'];
        ?>
        <option value="<?php echo $shehiaCode;?>"><?php echo $shehiaName;?></option>
        <?php
    }
}else{?>
     <option>No Data(s) Found</option>
     
    <?php
}
}
?>

   
    








