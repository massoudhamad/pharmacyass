<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
try {
include 'DB.php';
$db = new DBHelper();
if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
    if($_REQUEST['action_type'] == 'addshehia')
    {
        $userData = array(
            'shehiaCode'=>$_POST['code'],
            'shehiaName'=>$_POST['name'],
            'districtID'=>$_POST['districtID']
        );
        $insert = $db->insert("shehia",$userData);
        $boolStatus=true;
        header("Location:index3.php?sp=location#shehia&msg=succ");
    }
    else if($_REQUEST['action_type'] == 'editshehia')
    {
        $userData = array(
            'shehiaCode'=>$_POST['code'],
            'shehiaName'=>$_POST['name'],
            'districtID'=>$_POST['districtID']
        );
        $conditions=array('shehiaID'=>$_POST['shehiaID']);
        $update = $db->update("shehia",$userData,$conditions);
        header("Location:index3.php?sp=location#shehia&msg=edited");
    }
    else if($_REQUEST['action_type'] == 'addregion')
    {
        $userData = array(
            'regionCode'=>$_POST['code'],
            'regionName'=>$_POST['name'],
            'zoneCode'=>$_POST['zoneCode']
        );
        $insert = $db->insert("region",$userData);
        header("Location:index3.php?sp=location#region&msg=succ");
    }
    else if($_REQUEST['action_type'] == 'editregion')
    {

        $userData = array(
            'regionCode'=>$_POST['code'],
            'regionName'=>$_POST['name'],
            'zoneCode'=>$_POST['zoneCode']
        );
        $conditions=array("regionCode"=>$_POST['regionCode']);
        $update = $db->update("region",$userData,$conditions);
        header("Location:index3.php?sp=location#region&msg=edited");
    }
    else if($_REQUEST['action_type'] == 'adddistrict')
    {
        $userData = array(
            'districtCode'=>$_POST['code'],
            'districtName'=>$_POST['name'],
            'regionCode'=>$_POST['regionCode']
        );
        $insert = $db->insert("district",$userData);
        header("Location:index3.php?sp=location#district&msg=succ");
    }
    else if($_REQUEST['action_type'] == 'editdistrict')
    {
        $userData = array(
            'districtCode'=>$_POST['code'],
            'districtName'=>$_POST['name'],
            'regionCode'=>$_POST['regionCode']
        );
        $conditions=array("districtID"=>$_POST['districtID']);
        $update = $db->update("district",$userData,$conditions);
        header("Location:index3.php?sp=location#district&msg=edited");
    }
    else if($_REQUEST['action_type'] == 'addzone')
    {
        $userData = array(
            'zoneCode'=>$_POST['code'],
            'zoneName'=>$_POST['name'],

        );
        $insert = $db->insert("zone",$userData);
        header("Location:index3.php?sp=location#zone&msg=succ");
    }
    else if($_REQUEST['action_type'] == 'Updatezone')
    {
        $zoneID = $_POST['zoneID'];
        $userData = array(
            'zoneCode'=>$_POST['code'],
            'zoneName'=>$_POST['name'],

        );
        $condition = array('zoneID'=>$zoneID);
        $update = $db->update("zone",$userData,$condition);
        header("Location:index3.php?sp=location#zone&msg=succ");
    }


}

} catch (PDOException $ex) {
 header("Location:index3.php?sp=location&msg=error");
 }