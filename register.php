<?php
header('Content-Type: application/json');
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$username = mysqli_real_escape_string($conn, $data['username']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users(username, password) VALUES('$username', '$password')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(["message" => "User registered.", "status" => true]);
} else {
    echo json_encode(["message" => "Registration failed.", "status" => false]);
}
?>