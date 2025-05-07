<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Method Not Allowed. Please use POST."]);
    exit;
}

include "config.php";

$input = json_decode(file_get_contents("php://input"), true);

$username = $input['username'];
$password = $input['password'];

// Check if the username already exists
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["message" => "Username already exists"]);
} else {
    // Insert the new user
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["message" => "Registration successful"]);
    } else {
        echo json_encode(["message" => "Registration failed"]);
    }
}
?>
