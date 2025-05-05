<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: PUT');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods,Acess-Control-Allow-Methods,Authorization,X-Requested-Width');

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['sid'];
$name = $data['sname'];
$age = $data['sage'];
$city = $data['scity'];

include "config.php";



$sql = "UPDATE students SET name = '{$name}',age = {$age},city = '{$city}' WHERE id = {$id}";


if(mysqli_query($conn,$sql)){
    echo json_encode(array('message'=> 'Student record updated', 'status'=> true));
}else{
    echo json_encode(array('message'=> 'Student record not updated', 'status'=> false));
}


?>