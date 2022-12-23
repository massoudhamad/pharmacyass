
<?php 
$hospitallevel = $_POST['hospitallevelID'];
if (!empty($hospitallevel)) {
    $hosplevelID =urlencode($_POST['hospitallevelID']);
    $hospital_url = ("http://localhost/ehr-server/data/get_hospitals.php?hospitalLevelID=".$hosplevelID) or die("failed");
    //$contents =$db->curl_get_contents($service_url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $hospital_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PORT, 80);
    $body = curl_exec($ch);
    $error = curl_error($ch);
    $hospital_array = json_decode($body);
}

if(!empty($hospital_array)){ ?>
    <select name='serviceID' class='form-control'>
    <option value=''>Select Here</option>
    <?php
    foreach($hospital_array as $hospi){ 
        $hospitalName = $hospi[0];
        $hospitalID = $hospi[1];
        $district = $hospi[2];
        ?>
        <option value="<?php echo $hospitalID;?>"><?php echo $hospitalName;?></option>
        <?php
    }
}else{?>
    No Hospital(s) Found
    <?php
    //echo "No service(s) Found";
    // var_dump($error);
}
?>


   
    </select>


 



