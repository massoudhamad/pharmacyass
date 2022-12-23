<?php
$year=$_POST['year'];
//echo $year;
if($year)

{
    $month=$_POST['month'];
    $date=$_POST['date'];
    if(!empty($month) && (!empty($date)))
        $dob=$date.'-'.$month.'-'.$year;
    else
        $dob='01-01-'.$year;

    /*$dateOfBirth = "17-10-1985";*/
    $dateOfBirth = $dob;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');
    echo "<input type='text' name='age' value='$age' class='form-control' readonly>";
}

?>