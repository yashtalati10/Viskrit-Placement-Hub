<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collegeid = $_POST['collegeid'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    // Insert the student data into the database
    $query = "INSERT INTO all_students_list (collegeid, first_name, last_name, mobile, email, username, password, department) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssssssss', $collegeid, $first_name, $last_name, $mobile, $email, $username, $password, $department);


    if ($stmt->execute()) {
        echo "Student added successfully!";
    } else {
        echo "Error adding student.";
    }
}
?>