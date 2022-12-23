<?php
//  ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
 try {
 include 'DB.php';
 $db = new DBHelper();
 $patientNo=$_POST['patientNo'];
 $visitNo=$_POST['visitNo'];
 $id=$_POST['drugID'];
 if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    
     if($_REQUEST['action_type'] == 'addDispencing')
     {
        foreach( $id as $key=>$value)
        {
            $drugID = $_POST['drugID'][$key];
            $prediscribed_quantity = $_POST['prediscribed_quantity'][$key];
            $quantity_type = $_POST['quantityType'][$key];
                
        $userData = array(
            'despencingType'=>0,
            'sales_reference'=>$patientNo,
           'drugID'=>$drugID,
           'despencingStatus'=>1,
           'prediscribed_quantity'=>$prediscribed_quantity,
           'quantity_type'=>$quantity_type,

        );
        
        $insert = $db->insert("despencing",$userData);
        $visitData = array(
            'visitStatus'=>1,

        );
        $dispensing = array(
            'dispensing_status'=>1,
            'drugID'=>$drugID,
        );

        $condition = array('patientNo'=>$patientNo,'visitNo'=>$visitNo);
        $insert = $db->update("patientvisit",$visitData,$condition);


        $conditions = array('patientNo'=>$patientNo,'visitNo'=>$visitNo);
        $insert = $db->update("patient_medication",$dispensing,$conditions);
        $boolStatus=true;
         header("Location:index3.php?sp=internalDespency&msg=succ");
     }
 }
 }
  } catch (PDOException $ex) {
     header("Location:index3.php?sp=internalDespency&msg=error");
      //echo $ex;
   }
?>