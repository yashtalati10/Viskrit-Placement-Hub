<?php
// Include the database connection file
require 'db.php';

// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $first_name = $_POST['first_name']; // First name of the department admin
    $last_name = $_POST['last_name'];   // Last name of the department admin
    $username = $_POST['email'];        // Username (set as email)
    $password = $_POST['mobile'];       // Password (set as mobile number, though this seems unusual)
    $mobile = $_POST['mobile'];         // Mobile number of the admin
    $email = $_POST['email'];           // Email address of the admin
    $department = $_POST['department']; // Department name or ID

    // SQL query to insert the data into the department_details table
    $query = "INSERT INTO department_details (first_name, last_name, mobile, email, username, password, department) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL query to prevent SQL injection
    $stmt = $conn->prepare($query);

    // Bind the parameters to the query ('sssssss' indicates seven string parameters)
    $stmt->bind_param('sssssss', $first_name, $last_name, $mobile, $email, $username, $password, $department);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "Department Admin added successfully!"; // Success message
    } else {
        echo "Error adding Department Admin."; // Error message if query fails
    }
}
?>