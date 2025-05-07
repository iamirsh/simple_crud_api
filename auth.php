<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$headers = apache_request_headers();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(["message" => "Token not found."]);
    exit;
}

list(, $jwt) = explode(" ", $headers['Authorization']);

try {
    $decoded = JWT::decode($jwt, new Key("your_secret_key", 'HS256'));
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode(["message" => "Access denied.", "error" => $e->getMessage()]);
    exit;
}
?>