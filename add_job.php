<?php
require 'db.php'; // Your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_role = $_POST['job-role'];
    $job_description = $_POST['job-description'];
    $skills_req = $_POST['skills-req'];
    $no_openings = $_POST['no-of-openings'];
    $expected_salary = $_POST['expected-salary'];
    $job_type = $_POST['job-type'];
    $company_name = $_SESSION['company_name'];
    $company_id = $_SESSION['c_id'];
    
    // Insert the student data into the database
    $query = "INSERT INTO all_jobs_list (job_role, job_description, skills_req, no_openings, expected_salary, job_type, company_name) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssss', $job_role, $job_description, $skills_req, $no_openings, $expected_salary, $job_type, $company_name);


    if ($stmt->execute()) {
        header("Location: view_company_profile.php?id=$company_id"); 

    } else {
        echo "Error adding Job.";
    }
}
?>