<?php
	//session_start();
	require_once 'DB.php';
	$session = new DBHelper();
	
	if(!$session->is_loggedin())
	{
            header("Location:index.php");
	}
?>