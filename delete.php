<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include "config.php";
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

if (empty($authHeader)) {
    echo json_encode(['message' => 'Authorization required']);
    exit;
}

$token = str_replace('Bearer ', '', $authHeader);

try {
    $key = new Key("your_secret_key", 'HS256');
    $decoded = JWT::decode($token, $key);

    // Get the input data
    $data = json_decode(file_get_contents("php://input"));
    $sid = $data->sid;

    // Delete query
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $sid);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Student deleted successfully']);
    } else {
        echo json_encode(['message' => 'Failed to delete student']);
    }

} catch (Exception $e) {
    echo json_encode(['message' => 'Unauthorized', 'status' => false]);
}
?>
