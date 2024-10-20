<?php
require 'db.php'; // Include your database connection file

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data from the POST request
    $company_name = $_POST['company_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    
    // Prepare an SQL statement to insert the placement officer data into the database
    $query = "INSERT INTO all_companies_list (company_name, username, password, mobile, email, city, state) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare($query);
    
    // Bind parameters to the prepared statement
    $stmt->bind_param('sssssss', $company_name, $username, $password, $mobile, $email, $city, $state);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // Redirect to the index page if the insertion is successful
        header("Location: index.php");
    } else {
        // Display an error message if there was an issue adding the placement officer
        echo "Error adding Placement Officer.";
    }
}
?>
