
<?php
include("DB.php");
$db=new DBHelper();
$categoryID = $_POST['categoryID'];

$category = $db->getRows('servicecategory', array('order_by' => 'categoryName ASC'));
if(!empty($category)){
    echo"<option value=''>Select Service Name</option>";
    $count = 0; foreach($category as $cat){ $count++;
        $catName=$cat['categoryName'];
        $catID=$cat['categoryID'];
        ?>
        <option value="<?php echo $catID;?>"><?php echo $catName;?></option>
    <?php }}

?>