<?php
require 'db.php'; // Include your database connection file
session_start(); // Start a new session or resume the existing session

// Check if the user is logged in
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php"); // Redirect to index page if not logged in
    exit; // Exit to ensure no further code is executed after the redirect
}



// Check if 'id' is set in the POST request
if (isset($_POST['id'])) {
    $studentId = $_POST['id']; // Retrieve the student ID from the POST data




    // Query to fetch the full details of the student from the database
    $query = "SELECT * FROM all_students_list WHERE id = ?"; // SQL query to select all columns for the given student ID
    $stmt = $conn->prepare($query); // Prepare the SQL statement to prevent SQL injection
    $stmt->bind_param('i', $studentId); // Bind the student ID to the query as an integer
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result set from the executed statement




    // Check if a matching student record is found
    if ($row = $result->fetch_assoc()) {
        $username = $row['username']; // Store the username for later use

        // Output the student's details in a readable format
        echo "<p><strong>College ID:</strong> " . $row['collegeid'] . "</p>"; // Display the college ID
        echo "<p><strong>First Name:</strong> " . $row['first_name'] . "</p>"; // Display the student's first name
        echo "<p><strong>Last Name:</strong> " . $row['last_name'] . "</p>"; // Display the student's last name
        echo "<p><strong>Department:</strong> " . $row['department'] . "</p>"; // Display the student's department
        echo "<p><strong>Number of Companies Applied:</strong> " . $row['number_of_companies_applied'] . "</p>"; // Display the number of companies applied to
        echo "<p><strong>Mobile Number:</strong> " . $row['mobile'] . "</p>"; // Display the student's mobile number
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>"; // Display the student's email address
        echo "<p><strong>Username:</strong> " . $row['username'] . "</p>"; // Display the student's username
        echo "<p><strong>Companies Applied:</strong> " . $row['companies_applied'] . "</p>"; // Display the companies the student has applied to
    }






    // Query to fetch job applications associated with the student
    $query1 = "SELECT job_id, company_name FROM job_applications WHERE username = '$username'"; // Get job applications for the user
    $result1 = $conn->query($query1); // Execute the query
    $sr_no = 1; // Initialize a serial number for listing the jobs





    // Loop through the job applications and display each one
    while ($row1 = $result1->fetch_assoc()) {
        $job_id = $row1["job_id"]; // Get the job ID from the application

        // Query to fetch the job role from the job list based on the job ID
        $query2 = "SELECT job_role FROM all_jobs_list WHERE job_id = $job_id"; // SQL query to fetch job role
        $result2 = $conn->query($query2); // Execute the job role query
        $job_role = $result2->fetch_assoc(); // Fetch the job role result

        // Display the job role and company name
        echo "<p>" . $sr_no . ". " . $job_role["job_role"] . " - " . $row1["company_name"] . "</p>"; // Display the job and company information

        $sr_no++; // Increment the serial number for the next job
    }
}
