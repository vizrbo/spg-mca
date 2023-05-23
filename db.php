<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "vishwalinux";
$dbname = "spg-mca";

// Create a new mysqli object
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>