<?php
require 'db.php'; // Your database connection file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collegeid = $_POST['collegeid'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['collegeid'];
    $password = $_POST['mobile'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    // Prepare and execute the SQL query
    $query = "INSERT INTO all_students_list (collegeid, first_name, last_name, mobile, email, username, password, department) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssss', $collegeid, $first_name, $last_name, $mobile, $email, $username, $password, $department);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Student added successfully!";
        
        // Send email to the student with username and password
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
        $msg = 'Dear '.strtoupper($first_name). '<p>Following is the login credentials for Placement Hub</p>' . 
               '<p>Username: '.$collegeid.'</p>' . 
               '<p>Password: '.$password.'</p>';

        $mail->Body = $msg; // Email message

        // Send the email
        $mail->send();

    } else {
        // Check if the error is due to a duplicate entry for 'collegeid'
        if ($stmt->errno == 1062) {  // 1062 is the error code for duplicate entry in MySQL
            echo "Error: A student with this College ID already exists.";
        } else {
            echo "Error adding student: " . $stmt->error;
        }
    }
}
?>
