<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);


try {
    include 'DB.php';
    require 'vendor/vendor/autoload.php';
    $db = new DBHelper();

    if (isset($_POST['action_type']) && !empty($_REQUEST['action_type'])) {
        if ($_REQUEST['action_type'] == 'add') {
            $manufacturesData = array(
                'manufacturer_name' => $_POST['manufacturer_name'],
                'address_man' => $_POST['address_man'],
                'man_email' => $_POST['man_email'],
                'man_phone_no' => $_POST['man_phone_no'],
                'status' => 1,

            );


            $insert = $db->insert('manufacturer', $manufacturesData);
            $boolStatus = true;
            $_SESSION['msg'] = "Staff Registered Successfully";
            header('Location:index3.php?sp=manufacturers#&msg=succ');
        } else if ($_REQUEST['action_type'] == 'editstaff') {
            $manufacturer_id = $_POST['manufacturer_id'];

            $storeData = array(
                'item_name' => $_POST['firstName'],
                'item_description' => $_POST['middleName'],
                'status' => 1,

            );
            $conditions = array('item_id' => $item_id);
            $update = $db->update('store', $userData, $conditions);
            $_SESSION['error'] = "Staff Update Successfully";
            header('Location:index3.php?sp=manufacturers#&msg=succ');
        }
    }
} catch (PDOException $ex) {
    $_SESSION['error'] = "OOps Something Occured";
    //header( 'Location:index3.php?sp=registerstaff&msg=error' );
    echo $ex;
}
