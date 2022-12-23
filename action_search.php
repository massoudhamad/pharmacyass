<?php

/**
 * Created by PhpStorm.
 * User: massoudhamad
 * Date: 28/12/18
 * Time: 8:08 PM
 */
// Get search term
$searchTerm = $_GET['submit'];

// Get matched data from skills table
$query = $db->query("SELECT * FROM patient WHERE skill LIKE '%".$searchTerm."%' AND status = '1' ORDER BY skill ASC");

// Generate skills data array
$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['value'] = $row['skill'];
        array_push($skillData, $data);
    }
}

// Return results as json encoded array
echo json_encode($skillData);

?>