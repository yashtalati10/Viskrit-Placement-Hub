<?php

require 'db.php'; // Include the database connection file
session_start(); // Start a new session or resume the existing session

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the username and job ID from the POST request
    $username = $_POST['username'];
    $job_id = $_POST['job_id'];
    
    // Debugging: Output the username and job ID (can be removed in production)
    echo $username;
    echo $job_id;

    // Prepare the SQL query to update the status of the job application to 'Rejected'
    $query = "UPDATE job_applications SET status = 'Rejected' WHERE job_id = ? AND username = ?";
    $stmt = $conn->prepare($query); // Prepare the SQL statement to prevent SQL injection
    
    // Bind the parameters to the prepared statement
    $stmt->bind_param('is', $job_id, $username);
    
    // Execute the prepared statement
    $stmt->execute();

    // Redirect back to the job view page with the job ID as a query parameter
    header('Location: company_view_job.php?job_id=' . $job_id);
}
?>
