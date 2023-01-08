<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);


try {
    include 'DB.php';
    require 'vendor/vendor/autoload.php';
    $db = new DBHelper();
    $item_id = $_POST['item_id'];
    // $recieved_items_id = $_POST['recieved_items_id'];

    if (isset($_POST['action_type']) && !empty($_REQUEST['action_type'])) {
        if ($_REQUEST['action_type'] == 'add') {
            $recieve_item_Data = array(
                'item_id' => $_POST['item_id'],
                'manufacturer_id' => $_POST['manufacturer_id'],
                'supplier_id' => $_POST['supplier_id'],
                'manufactured_date' => $_POST['manu_date'],
                'expire_date' => $_POST['expire_date'],
                'item_type' => $_POST['item_type'],
                // 'medi_type' => $_POST['medi_type'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'status' => 1,

            );
            if ($db->isFieldExist('store', 'item_id', $_POST['item_id'])) {
                echo 'imo';

                $staff = $db->getRows('store', array('where' => array('item_id' => $item_id)));
                if (!empty($staff)) {
                    foreach ($staff as $st) {
                        $quantity = $st['store_quantity'];
                    }
                    $toatlQuantity = $quantity + $_POST['quantity'];
                }


                $update_store_data = array(
                    'store_quantity' => $toatlQuantity,
                    'expire_date' => $_POST['expire_date'],
                );


                if ($db->isFieldExist('recieved_items', 'item_id', $_POST['item_id'])) {

                $condition = array('item_id' => $_POST['item_id']);
                $insert = $db->update('recieved_items', $condition, $recieve_item_Data);
                echo $insert;
                if ($insert) {

                    $conditions = array('item_id' => $_POST['item_id']);
                    $insert = $db->update('store', $update_store_data, $conditions);

                    $_SESSION['msg'] = "Staff Registered Successfully";
                    header('Location:index3.php?sp=incoming_purchase#&msg=succ');
                }else{
                    echo 'error';
                }
            }else{
                $insert = $db->insert('recieved_items', $recieve_item_Data);
                echo $insert;
                if ($insert) {

                    $conditions = array('item_id' => $_POST['item_id']);
                    $insert = $db->update('store', $update_store_data, $conditions);

                    $_SESSION['msg'] = "Staff Registered Successfully";
                    header('Location:index3.php?sp=incoming_purchase#&msg=succ');
                }else{
                    echo 'error';
                }

            }
            } else {

                $recieve_item_Data = array(
                    'item_id' => $_POST['item_id'],
                    'manufacturer_id' => $_POST['manufacturer_id'],
                    'supplier_id' => $_POST['supplier_id'],
                    'manufactured_date' => $_POST['manu_date'],
                    'expire_date' => $_POST['expire_date'],
                    'item_type' => $_POST['item_type'],
                    // 'medi_type' => $_POST['medi_type'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price'],
                    'status' => 1,
    
                );

                $staff = $db->getRows('store', array('where' => array('item_id' => $item_id)));
                if (!empty($staff)) {
                    foreach ($staff as $st) {
                        $quantity = $st['store_quantity'];
                    }
                    $toatlQuantity = $quantity + $_POST['quantity'];
                }

                $update_store_data = array(
                    'store_quantity' => $toatlQuantity,
                    'expire_date' => $_POST['expire_date'],
                );



                $insert = $db->insert('recieved_items', $recieve_item_Data);
                if ($insert) {
                    $conditions = array('item_id' => $item_id);
                    $insert = $db->update('store', $update_store_data, $conditions);
                    $boolStatus = true;
                    $_SESSION['msg'] = "Staff Registered Successfully";
                    header('Location:index3.php?sp=incoming_purchase#&msg=succ');
                }
            }
        } else if ($_REQUEST['action_type'] == 'editstaff') {
            //this is comments
        $recieved_items_id = $_POST['recieved_items_id'];




          

            $staff = $db->getRows('store', array('where' => array('item_id' => $item_id)));
            if (!empty($staff)) {
                foreach ($staff as $st) {
                    $quantity = $st['store_quantity'];
                }
                $toatlQuantity = $quantity + $_POST['quantity'];
            }

            // var_dump($update_store_data);

            $update_store_data = array(
                'store_quantity' => $toatlQuantity,
                'expire_date' => $_POST['expire_date'],
            );

            // var_dump($update_store_data);
            $recieve_item_Data = array(
                'item_id' => $_POST['item_id'],
                'manufacturer_id' => $_POST['manufacturer_id'],
                'supplier_id' => $_POST['supplier_id'],
                'manufactured_date' => $_POST['manu_date'],
                'expire_date' => $_POST['expire_date'],
                'item_type' => $_POST['item_type'],
                // 'medi_type' => $_POST['medi_type'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'status' => 1,

            );


            $condition = array('recieved_items_id' => $recieved_items_id);
            $insert = $db->update('recieved_items', $recieve_item_Data, $condition);
            if ($insert) {
                $conditions = array('item_id' => $item_id);
                $insert = $db->update('store', $update_store_data, $conditions);
            }
            $boolStatus = true;
            $_SESSION['msg'] = "Staff Registered Successfully";
            header('Location:index3.php?sp=incoming_purchase#&msg=succ');

       }
    }
} catch (PDOException $ex) {
    $_SESSION['error'] = "OOps Something Occured";
    header( 'Location:index3.php?sp=incoming_purchase&msg=error' );
    //echo $ex;
}
