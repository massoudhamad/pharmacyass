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
            $storeData = array(
                'item_name' => $_POST['item_name'],
                'item_description' => $_POST['item_description'],
                'status' => 1,

            );
            $insert = $db->insert('store', $storeData);
            $boolStatus = true;
            $_SESSION['msg'] = "Staff Registered Successfully";
            header('Location:index3.php?sp=store#&msg=succ');
        } else if ($_REQUEST['action_type'] == 'editstaff') {

            $storeData = array(
                'item_name' => $_POST['firstName'],
                'item_description' => $_POST['middleName'],
                'status' => 1,

            );
            $conditions = array('item_id' => $item_id);
            $update = $db->update('store', $userData, $conditions);
            $_SESSION['error'] = "Staff Update Successfully";
            header('Location:index3.php?sp=store#&msg=succ');
        }
    }
} catch (PDOException $ex) {
    $_SESSION['error'] = "OOps Something Occured";
    //header( 'Location:index3.php?sp=registerstaff&msg=error' );
    echo $ex;
}
