<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: POST');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods,Acess-Control-Allow-Methods,Authorization,X-Requested-Width');

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['sname'];
$age = $data['sage'];
$city = $data['scity'];

include "config.php";

$sql = "INSERT INTO students(name,age,city) VALUES ('{$name}',{$age},'{$city}')";

if(mysqli_query($conn,$sql)){
    echo json_encode(array('message'=> 'Student record inserted', 'status'=> true));
}else{
    echo json_encode(array('message'=> 'Student record not inserted', 'status'=> false));
}
