<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

header('Content-Type: application/json');
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$username = mysqli_real_escape_string($conn, $data['username']);
$password = $data['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        $payload = [
            "iss" => "localhost",
            "iat" => time(),
            "exp" => time() + (60 * 60),
            "user_id" => $user['id']
        ];
        $jwt = JWT::encode($payload, "your_secret_key", 'HS256');
        echo json_encode(["token" => $jwt]);
    } else {
        echo json_encode(["message" => "Invalid credentials."]);
    }
} else {
    echo json_encode(["message" => "User not found."]);
}
?>
