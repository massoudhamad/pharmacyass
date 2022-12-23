<?php
// ini_set ('display_errors', 1);
// error_reporting (E_ALL | E_STRICT);
try {
    include 'DB.php';
    $db = new DBHelper();
    $tblName = 'patienttest';
    $visitNo = $_POST['visitNo'];
    if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type']))
    if(isset($_POST['action_type']) == 'add')
    {
        $result=$_POST['Description'];
        $testNo=$_POST['testNo'];
        $patientNo=$_POST['patientNo'];

        $servicesID=$_POST['serviceID'];
       
        
       
        $today=date('Y-m-d');
        
        if($_FILES['fileToUpload']['name']){
            
        $imgFile = $_FILES['fileToUpload']['name'];
        $tmp_dir = $_FILES['fileToUpload']['tmp_name'];
        $imgSize = $_FILES['fileToUpload']['size'];
        $upload_dir = 'profile_img/'; // upload directory
        $target_file=$upload_dir.basename($_FILES["fileToUpload"]["name"]);

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $Doc =rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$Doc);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
}else{
    $Doc = '';  
}
  
   $userData=array(
                   
      'result'=>$result,
      'testStatus'=>1,
      'labDetails'=>$_POST['description'],
      'fileurl'=>$Doc,
      'remarks'=>$_POST['description']
      
          
      );

      $test=array(
      'progressStatus'=>2,    
      );

                }
                $condition=array('patientNo'=>$patientNo, 'testNo'=>$testNo,'visitNo'=>$visitNo);
                $conditions=array('patientNo'=>$patientNo,'visitNo'=>$visitNo);
                $insert=$db->update($tblName,$userData,$condition);
                 $insert=$db->update('patienttest',$test,$conditions);
               
                header("Location:index3.php?patientNo=$patientNo&msg=succ");
                
            }
  

catch (PDOException $ex) {
    Header("Location: index3.php?patientNo=$patientNo&msg=error");
    echo $ex;
}