<?php
require 'db.php'; // Your database connection file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $username = $_POST['email'];
    $password = $_POST['mobile'];

    // Insert the student data into the database
    $query = "INSERT INTO all_companies_list (company_name, mobile, email, city, state, username, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssss', $company_name, $mobile, $email, $city, $state, $username, $password);


    if ($stmt->execute()) {
        echo "Company added successfully!";

        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yashtalati07@gmail.com';
        $mail->Password = 'lwym wcoy atxv lijf'; // SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        //Recipients
        $mail->setFrom('yashtalati07@gmail.com', 'Yash Talati');
        $mail->addAddress($email);  // Add a recipient email

        //Content
        $mail->isHTML(true);
        $mail->Subject = "Login Credentials"; // Email subject

        // Construct the email body
        $msg = 'Dear '.strtoupper($company_name)."'s".' Officer'. '<p>Following is the login credentials for Placement Hub</p>' . 
               '<p>Username: '.$email.'</p>' . 
               '<p>Password: '.$password.'</p>';

        $mail->Body = $msg; // Email message

        // Send the email
        $mail->send();

    } else {
        echo "Error adding Company.";
    }
}
