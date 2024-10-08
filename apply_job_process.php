<?php
require 'db.php'; // Your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get job ID and user ID from the POST request
    $job_id = $_POST['job_id'];
    $username = $_POST['username'];

    $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $job = $result->fetch_assoc();

    $company_name = $job['company_name'];

    $query2 = "SELECT number_of_students_applied FROM all_companies_list WHERE company_name = ?";
    $stmt = $conn->prepare($query2);
    $stmt->bind_param('s', $company_name);
    $stmt->execute();
    $company_result = $stmt->get_result();
    $company = $company_result->fetch_assoc();


    $query = "SELECT * FROM all_students_list WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    $first_name = $student['first_name'];
    $last_name = $student['last_name'];
    $email = $student['email'];
    $department = $student['department'];



    // Prepare an SQL statement to insert the application into the database
    $query = "INSERT INTO job_applications (job_id, first_name, last_name, username, email, company_name, department, status) VALUES (?, ?, ?, ?, ?,  ?, ?, 'Applied')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssss', $job_id, $first_name, $last_name, $username, $email, $company_name, $department);



    if ($stmt->execute()) {
        // Redirect to student_my_applications.php with a success message
        $query = "SELECT COUNT(job_id) AS application_count FROM job_applications WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id); // Bind the job ID
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        // Now you can access the count like this
        $application_count = $row['application_count'];

        $query = "UPDATE all_jobs_list SET no_applicants = $application_count WHERE job_id = ?";
        $stmt = $conn->prepare($query);// Bind the job ID
        $stmt->bind_param('i', $job_id); // Bind the job ID
        $stmt->execute();
        
        // All Student Count 
        $query = "SELECT COUNT(company_name) AS student_count FROM job_applications WHERE company_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $company_name); // Bind the job ID
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        // Now you can access the count like this
        $student_count = $row['student_count'];
        
        $query = "SELECT COUNT(company_name) AS company_count FROM job_applications WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username); // Bind the job ID
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        // Now you can access the count like this
        $company_count = $row['company_count'];

        $query = "UPDATE all_companies_list SET number_of_students_applied = $student_count WHERE company_name = ?" ;
        $stmt = $conn->prepare($query);// Bind the job ID
        $stmt->bind_param('s', $company_name); // Bind the job ID
        $stmt->execute();

        $query = "UPDATE all_students_list SET number_of_companies_applied = $company_count WHERE username = ?" ;
        $stmt = $conn->prepare($query);// Bind the job ID
        $stmt->bind_param('s', $username); // Bind the job ID
        $stmt->execute();



        echo "<script>alert('Application submitted successfully!'); window.location.href = 'student_my_applications.php';</script>";
    } else {
        echo "<script>alert('Error submitting application. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request!'); window.history.back();</script>";
}
?>