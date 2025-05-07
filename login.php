<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Method Not Allowed. Please use POST."]);
    exit;
}

include "config.php";
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

$input = json_decode(file_get_contents("php://input"), true);

$username = $input['username'];
$password = $input['password'];

// Check username and password in your database
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Generate JWT token
    $payload = [
        "iss" => "localhost",
        "iat" => time(),
        "exp" => time() + (60*60),
        "data" => [ "username" => $username ]
    ];
    $jwt = JWT::encode($payload, "your_secret_key", 'HS256');
    echo json_encode(["token" => $jwt]);
} else {
    echo json_encode(["message" => "Invalid username or password"]);
}
?>
