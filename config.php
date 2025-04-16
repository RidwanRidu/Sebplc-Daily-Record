<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'outlet_user');
define('DB_PASS', 'securepassword123');
define('DB_NAME', 'outlet_system');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>