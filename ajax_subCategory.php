<?php
include("DB.php");
$db=new DBHelper();
$categoryCode=$_POST['categoryCode'];

if (!empty($categoryCode)) {?>
    <select name='subcategoryCode' class='form-control'>
    <option value=''>Select Here</option>
    <?php
     $subcategory = $db->getRows('servicesubcategory',array('where'=>array('categoryCode'=>$categoryCode)));
     if (!empty($subcategory)) {
    foreach($subcategory as $serv){ 
        $subCategory = $serv['subCategory'];
        $subcategoryCode = $serv['subcategoryCode'];
        ?>
        <option value="<?php echo $subcategoryCode;?>"><?php echo $subCategory;?></option>
        <?php
    }
}else{
   echo  'No service(s) Found';
    
}
}
?>

    </select>
