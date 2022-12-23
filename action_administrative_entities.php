<?php

ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);

try {
    
include 'DB.php';
$db = new DBHelper();

        $zone_url = ("http://localhost/ehr-server/data/get_zone_api.php") or die("failed");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $zone_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PORT, 80);
        $body = curl_exec($ch);
        $error = curl_error($ch);
        $zone_array = json_decode($body);
        
        if(!empty($zone_array)){
            foreach($zone_array as $zone){ 
                $userData = array(
                    'zoneCode'=>$zone[0],
                    'zoneName'=>$zone[1],
                );
                $insert = $db->insert2("zone",$userData);
            }
        }
        

        $region_url = ("http://localhost/ehr-server/data/get_region_api.php") or die("failed");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $region_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PORT, 80);
        $body = curl_exec($ch);
        $error = curl_error($ch);
        $region_array = json_decode($body);

        if(!empty($region_array)){
            foreach($region_array as $region){ 
                $userData = array(
                    'regionCode'=> $region[0],
                    'zoneCode'=> $region[1],
                    'regionName'=> $region[2],
                );



        $insert = $db->insert2("region",$userData);

        }
    }


    $service_json = ("http://localhost/ehr-server/data/get_district_apii.php") or die("failed");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $service_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PORT, 80);
    $body = curl_exec($ch);
    $error = curl_error($ch);
    $service_json_array = json_decode($body);

    if(!empty($service_json_array)){
        foreach($service_json_array as $service){ 
            $userData = array(
                'districtCode'=> $service[0],
                'districtName'=> $service[1],
                'regionCode'=> $service[2],
            );



    $insert = $db->insert2("district",$userData);
    }
}



$shehia_url = ("http://localhost/ehr-server/data/get_shehia_apii.php") or die("failed");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $shehia_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PORT, 80);
    $body = curl_exec($ch);
    $error = curl_error($ch);
    $shehia_array = json_decode($body);

    if(!empty($shehia_array)){
        foreach($shehia_array as $shehia){ 
            $userData = array(
                'shehiaCode'=> $shehia[0],
                'shehiaName'=> $shehia[1],
                'districtID'=> $shehia[2],
            );



    $insert = $db->insert2("shehia",$userData);
    $boolStatus=true;
    $_SESSION['msg'] = 'Services Have been Downloaded successfully';
    header("Location:activate-administrative-entities.php");

    }
}
    
  
   
    
    
        
   


} catch (PDOException $ex) {
    echo $ex;
 //header("Location:index3.php?sp=manageHospital&msg=error");
 }