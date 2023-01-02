<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);


try {
    include 'DB.php';
    require 'vendor/vendor/autoload.php';
    $db = new DBHelper();
    $item_id = $_POST['item_id'];

    if (isset($_POST['action_type']) && !empty($_REQUEST['action_type'])) {
        if ($_REQUEST['action_type'] == 'add') {
            $despencing_Data = array(
                'item_id' => $_POST['item_id'],
                // 'expire_date' => $_POST['expire_date'],
                // 'item_type' => $_POST['item_type'],
                // 'medi_type' => $_POST['medi_type'],
                'prediscribed_quantity' => $_POST['quantity_to_be_sold'],
                // 'price' => $_POST['price'],
                // 'status' => 1,

            );

            $staff = $db->getRows('store', array('where' => array('item_id' => $item_id)));
            if (!empty($staff)) {
                foreach ($staff as $st){
                    $quantity = $st['quantity'];
                }
                $toatlQuantity = $quantity - $_POST['quantity_to_be_sold'];
            }

            $update_store_data = array(
                'quantity' => $toatlQuantity,
                // 'expire_date' => $_POST['expire_date'],
                // 'supplier_id' => $_POST['supplier_id'],
                // 'manu_date' => $_POST['manu_date'],
                // 'expire_date' => $_POST['expire_date'],

            );


            $insert = $db->insert('despencing', $despencing_Data);
            if($insert){
                $conditions = array('item_id' => $item_id);
                $insert = $db->update('store', $update_store_data,$conditions);


            }
            $boolStatus = true;
            $_SESSION['msg'] = "Staff Registered Successfully";
            header('Location:index3.php?sp=despencing#&msg=succ');
        } else if ($_REQUEST['action_type'] == 'editstaff') {

            $storeData = array(
                'item_name' => $_POST['firstName'],
                'item_description' => $_POST['middleName'],
                'status' => 1,

            );
            $conditions = array('item_id' => $item_id);
            $update = $db->update('store', $userData, $conditions);
            $_SESSION['error'] = "Staff Update Successfully";
            header('Location:index3.php?sp=receive_items#&msg=succ');
        }
    }
} catch (PDOException $ex) {
    $_SESSION['error'] = "OOps Something Occured";
    //header( 'Location:index3.php?sp=registerstaff&msg=error' );
    echo $ex;
}
