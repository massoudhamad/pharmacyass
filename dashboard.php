<?php
//session_start();
if($_SESSION['role_session']==7 || $_SESSION['role_session']==5)
{
    include "default.php";
}
else if($_SESSION['role_session']==2)
{
    include "patient_clinic_doctor.php";
}
?>