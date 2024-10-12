<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['email'];
    $password = $_POST['mobile'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    // Insert the student data into the database
    $query = "INSERT INTO department_details (first_name, last_name, mobile, email, username, password, department) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('sssssss', $first_name, $last_name, $mobile, $email, $username, $password, $department);


    if ($stmt->execute()) {
        echo "Department Admin added successfully!";
    } else {
        echo "Error adding Department Admin.";
    }
}
?>