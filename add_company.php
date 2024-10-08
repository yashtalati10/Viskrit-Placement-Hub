<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $username = $_POST['email'];
    $password = $_POST['mobile'];

    // Insert the student data into the database
    $query = "INSERT INTO all_companies_list (company_name, mobile, email, city, state, username, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('sssssss', $company_name, $mobile, $email, $city, $state, $username, $password);


    if ($stmt->execute()) {
        echo "Company added successfully!";
    } else {
        echo "Error adding student.";
    }
}
?>