<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include "config.php";
require 'vendor/autoload.php';  // Make sure you're using the correct version of Firebase JWT
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;  // Import the Key class

// Get the authorization header
$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

if (empty($authHeader)) {
    echo json_encode(['message' => 'Authorization required']);
    exit;
}

$token = str_replace('Bearer ', '', $authHeader);

try {
    // Decode JWT token with the correct Key object
    $key = new Key("your_secret_key", 'HS256');  // Replace "your_secret_key" with your actual secret
    $decoded = JWT::decode($token, $key);  // Pass the Key object here
    
    // Query to fetch students
    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);  // Return students data as JSON
    } else {
        echo json_encode(['message' => 'No records found']);
    }
} catch (Exception $e) {
    echo json_encode(['message' => 'Unauthorized', 'status' => false]);
}
?>
