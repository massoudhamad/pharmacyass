<?php
$year=$_POST['year'];
if($year)
{

     if(!empty($year))
        $dob= $year;
     else
        $dob=$date.'0'.$month.'empty'.$year;

     /*$dateOfBirth = "17-10-1985";*/
    $dateOfBirth = $dob;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');
    echo "<input type='text' name='age' value='$age' class='form-control' readonly>";
    

    // public function reverse_birthday($years){
    //     return date('Y-m-d', strtotime($years . ' years ago'));
    // }
}

?>