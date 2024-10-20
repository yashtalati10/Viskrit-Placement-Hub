<?php

// Include the database connection file
require 'db.php';

// Start the session to track user data
session_start();

// Check if the user is logged in, if not redirect to login page
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}

// Use PHPMailer classes for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for email functionality
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Retrieve the username and job ID from the form
  $username = $_POST['username'];
  $job_id = $_POST['job_id'];

  // Display the username and job ID (useful for debugging)
  echo $username;
  echo $job_id;

  // Update the job application status to 'Accepted' in the database
  $query = "UPDATE job_applications SET status = 'Accepted' WHERE job_id = ? AND username = ?";
  $stmt = $conn->prepare($query); // Prepare the SQL query
  $stmt->bind_param('is', $job_id, $username); // Bind job_id (integer) and username (string) to the query
  $stmt->execute(); // Execute the query

  // Fetch the student's details based on the username
  $query = "SELECT * FROM all_students_list WHERE username = ?";
  $stmt = $conn->prepare($query); // Prepare the query
  $stmt->bind_param('s', $username); // Bind the username
  $stmt->execute(); // Execute the query
  $result = $stmt->get_result(); // Get the result set
  $student = $result->fetch_assoc(); // Fetch the student's details

  // Retrieve student's email and first name
  $email = $student['email'];
  $first_name = $student['first_name'];

  // Fetch the job details based on the job ID
  $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
  $stmt = $conn->prepare($query); // Prepare the query
  $stmt->bind_param('i', $job_id); // Bind the job_id
  $stmt->execute(); // Execute the query
  $result1 = $stmt->get_result(); // Get the result set
  $job = $result1->fetch_assoc(); // Fetch the job details

  // Retrieve job role and job ID from the job details
  $job_role = $job['job_role'];
  $job_id = $job['job_id'];

  // Create a new PHPMailer instance
  $mail = new PHPMailer(true);

  // Server settings for sending the email
  $mail->isSMTP();                        // Use SMTP protocol
  $mail->Host = 'smtp.gmail.com';         // Specify SMTP server
  $mail->SMTPAuth = true;                 // Enable SMTP authentication
  $mail->Username = 'yashtalati07@gmail.com';  // SMTP username
  $mail->Password = 'lwym wcoy atxv lijf'; // SMTP password
  $mail->SMTPSecure = 'ssl';              // Enable SSL encryption
  $mail->Port = 465;                      // Port number for SSL

  // Email recipients settings
  $mail->setFrom('yashtalati07@gmail.com', 'Yash Talati'); // Sender's email and name
  $mail->addAddress($email);  // Add recipient's email

  // Email content settings
  $mail->isHTML(true);                       // Set email format to HTML
  $mail->Subject = "Your Application is Accepted"; // Email subject

  // Construct the email body with a message for the student
  $msg = 'Dear ' . strtoupper($first_name) .
    '<p>Congratulations! You are selected for ' . $job_role . '.</p>' .
    '<p>We will inform you of further proceedings.</p>';

  $mail->Body = $msg; // Set the email body content

  // Send the email
  $mail->send();

  // Redirect the user to the job view page with the job ID as a query parameter
  header('Location: company_view_job.php?job_id=' . $job_id);
}

?>