<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: DELETE');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods,Acess-Control-Allow-Methods,Authorization,X-Requested-Width');

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['sid'];

include "config.php";



$sql = "DELETE FROM  students WHERE id = {$id}";


if(mysqli_query($conn,$sql)){
    echo json_encode(array('message'=> 'Student record deleted', 'status'=> true));
}else{
    echo json_encode(array('message'=> 'Student record not deleted', 'status'=> false));
}


?>