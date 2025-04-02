<?php
// Database configuration for macOS
$host = "127.0.0.1"; // Use IP instead of "localhost"
$port = 3306;        // Default MySQL port
$db_name = "elite-orders";
$username = "root";  // Default MySQL username
$password = "";      // Default MySQL password (blank)

// Create connection with port specification
$conn = new mysqli($host, $username, $password, $db_name, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set proper CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Just exit with 200 OK status
    http_response_code(200);
    exit;
}
?>