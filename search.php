<?php
header('Content-Type: application/json');
include "auth.php";
include "config.php";

$search_value = isset($_GET['search']) ? $_GET['search'] : die();
$sql = "SELECT * FROM students WHERE name LIKE '%{$search_value}%'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
}else{
    echo json_encode(array('message'=> 'No Record Found', 'status'=> false));
}
?>
