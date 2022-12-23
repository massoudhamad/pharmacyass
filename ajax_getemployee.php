
<?php
include("DB.php");
$db=new DBHelper();
$doctor=$_POST['employeeID'];
if($doctor)
{

    $docname = $db->getDoc($doctor);
   
     if(!empty($docname))
    {
      
           
            foreach ($docname as $dn)
            {
               
                $firstname=$dn["firstname"];
                $middlename=$dn['middlename'];
                $lastname=$dn["lastname"];
                $employeeId=$dn["employeeId"];
                $fulname = $dn["firstname"]." ".$dn["middlename"]." ".$dn["lastname"];
               echo 'Dr.' .$fulname;
               
            }
                
          
    }else{
        echo 'bado';
    }
}else{
   
}
?>