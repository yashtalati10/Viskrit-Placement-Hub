<?php

require 'db.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $job_id = $_POST['job_id'];
    echo $username;
    echo $job_id;

    $query = "UPDATE job_applications SET status = 'Accepted' WHERE job_id = ? AND username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $job_id, $username);
    $stmt->execute();
    
    $query = "SELECT * FROM all_students_list WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $email = $student['email'];
    $first_name = $student['first_name'];
    
    $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $job_id);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $job = $result1->fetch_assoc();
    $job_role = $job['job_role'];
    $job_id = $job['job_id'];


    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'abdulrahim74264@gmail.com';
    $mail->Password = 'jity znsz ynbq gntq'; // SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //Recipients
    $mail->setFrom('abdulrahim74264@gmail.com', 'Abdul Rahim');
    $mail->addAddress($email);  // Add a recipient email

    //Content
    $mail->isHTML(true);
    $mail->Subject = "Your Application is Accepted"; // Email subject

    // Construct the email body
    $msg = 'Dear '.strtoupper($first_name). '<p>Congratulations You are selected for '.$job_role.'</p>'. 
    '<p>We will inform you for further proceedings</p>' ;

    $mail->Body = $msg; // Email message

    // Send the email
    $mail->send();

    header('Location: company_view_job.php?job_id='.$job_id);


}

?>