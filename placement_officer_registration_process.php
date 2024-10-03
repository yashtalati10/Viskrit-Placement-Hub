<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    

    // Insert the student data into the database
    $query = "INSERT INTO placement_officer_list (company_name, username, password, mobile, email, city, state) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('sssssss', $company_name, $username, $password, $mobile, $email, $city, $state);


    if ($stmt->execute()) {
        // echo "Placement Officer added successfully!";
        header("Location: index.php");
    } else {
        echo "Error adding Placement Officer.";
    }
}
?>