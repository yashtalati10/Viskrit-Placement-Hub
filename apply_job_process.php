<?php
require 'db.php'; // Include the database connection file
session_start(); // Start the session to use session variables

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the job ID and username from the POST request
    $job_id = $_POST['job_id'];
    $username = $_POST['username'];

    // Fetch the details of the job using the job ID
    $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $job_id); // Bind the job ID parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $job = $result->fetch_assoc(); // Fetch the job details
    $company_name = $job['company_name']; // Extract the company name from job details

    // Fetch the number of students applied for the company
    $query2 = "SELECT number_of_students_applied FROM all_companies_list WHERE company_name = ?";
    $stmt = $conn->prepare($query2);
    $stmt->bind_param('s', $company_name); // Bind the company name parameter
    $stmt->execute();
    $company_result = $stmt->get_result();
    $company = $company_result->fetch_assoc(); // Fetch the company details

    // Fetch the student details using the username
    $query = "SELECT * FROM all_students_list WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username); // Bind the username parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc(); // Fetch the student details
    $first_name = $student['first_name'];
    $last_name = $student['last_name'];
    $email = $student['email'];
    $department = $student['department'];

    // Insert the job application into the 'job_applications' table
    $query = "INSERT INTO job_applications (job_id, first_name, last_name, username, email, company_name, department, status) VALUES (?, ?, ?, ?, ?,  ?, ?, 'Applied')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssss', $job_id, $first_name, $last_name, $username, $email, $company_name, $department); // Bind the parameters

    // If the application is successfully submitted
    if ($stmt->execute()) {
        // Count the total number of applications for the job
        $query = "SELECT COUNT(job_id) AS application_count FROM job_applications WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id); // Bind the job ID parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $application_count = $row['application_count']; // Get the count of applications

        // Update the 'no_applicants' field in the 'all_jobs_list' table
        $query = "UPDATE all_jobs_list SET no_applicants = $application_count WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id); // Bind the job ID parameter
        $stmt->execute();

        // Count the total number of students applied for the company
        $query = "SELECT COUNT(company_name) AS student_count FROM job_applications WHERE company_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $company_name); // Bind the company name parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $student_count = $row['student_count']; // Get the count of students applied to the company

        // Count the total number of companies the student has applied to
        $query = "SELECT COUNT(company_name) AS company_count FROM job_applications WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username); // Bind the username parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $company_count = $row['company_count']; // Get the count of companies the student has applied to

        // Update the 'number_of_students_applied' field in the 'all_companies_list' table
        $query = "UPDATE all_companies_list SET number_of_students_applied = $student_count WHERE company_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $company_name); // Bind the company name parameter
        $stmt->execute();

        // Update the 'number_of_companies_applied' field in the 'all_students_list' table
        $query = "UPDATE all_students_list SET number_of_companies_applied = $company_count WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username); // Bind the username parameter
        $stmt->execute();

        // Show success message and redirect the user
        echo "<script>alert('Application submitted successfully!'); window.location.href = 'student_my_applications.php';</script>";
    } else {
        // Show error message if the application submission fails
        echo "<script>alert('Error submitting application. Please try again.'); window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, show an invalid request message
    echo "<script>alert('Invalid request!'); window.history.back();</script>";
}
?>