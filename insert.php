<?php
header('Content-Type: application/json');
include "auth.php";
include "config.php";

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['sname'];
$age = $data['sage'];
$city = $data['scity'];

$sql = "INSERT INTO students(name,age,city) VALUES ('{$name}',{$age},'{$city}')";

if(mysqli_query($conn,$sql)){
    echo json_encode(array('message'=> 'Student record inserted', 'status'=> true));
}else{
    echo json_encode(array('message'=> 'Student record not inserted', 'status'=> false));
}
?>