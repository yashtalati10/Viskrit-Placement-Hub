<?php
$servername = "localhost"; // Your database server (e.g., localhost)
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "anjuman_project"; // The name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
