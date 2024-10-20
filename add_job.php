<?php
// Include the database connection file
require 'db.php'; 

// Start the session to access session variables
session_start();

// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve form data
    $job_role = $_POST['job-role'];                   // Job role or title (e.g., Software Developer)
    $job_description = $_POST['job-description'];     // Detailed job description
    $skills_req = $_POST['skills-req'];               // Required skills for the job (e.g., Java, PHP)
    $no_openings = $_POST['no-of-openings'];          // Number of job openings available
    $expected_salary = $_POST['expected-salary'];     // Expected salary for the role
    $job_type = $_POST['job-type'];                   // Type of job (e.g., full-time, part-time, etc.)
    $company_name = $_SESSION['company_name'];        // Company name, retrieved from session
    $company_id = $_SESSION['c_id'];                  // Company ID, retrieved from session
    
    // SQL query to insert the job data into the all_jobs_list table
    $query = "INSERT INTO all_jobs_list (job_role, job_description, skills_req, no_openings, expected_salary, job_type, company_name) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the SQL query to avoid SQL injection
    $stmt = $conn->prepare($query);
    
    // Bind the parameters to the query ('sssssss' indicates seven string parameters)
    $stmt->bind_param('sssssss', $job_role, $job_description, $skills_req, $no_openings, $expected_salary, $job_type, $company_name);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        // If successful, redirect to the company profile page using the company ID
        header("Location: view_company_profile.php?id=$company_id"); 
    } else {
        // If an error occurs, display an error message
        echo "Error adding Job.";
    }
}
?>
