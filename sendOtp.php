<?php
 


if (isset($_POST["send"])) {
   
  $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';       
    $mail->SMTPAuth   = true;             
    $mail->Username   = 'abdulrahim74264@gmail.com';
    $mail->Password   = 'taxxjjaumgvfjmzi';      
    $mail->SMTPSecure = 'ssl';            
    $mail->Port       = 465;                                    
 
    //Recipients
    $mail->setFrom( $_POST["email"], $_POST["name"]); // Sender Email and name
    // $mail->setFrom( 'abdulrahim74264@gmail.com', 'Abdul Rahim'); // Sender Email and name
    $mail->addAddress('abdulrahim74264@gmail.com');     //Add a recipient email  
    // $mail->addAddress($_POST["email"]);     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = "New Subscriber";   // email subject headings


    $msg = $_POST["message"]."<br>".$_POST["dob"]."<br>".$_POST["duration"];
    // $mail->Body    = $_POST["message"]; //email message
    $mail->Body    = $msg; //email message
      
    // Success sent message alert
    $mail->send();
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = './task1.html';
    </script>
    ";
}
?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];

    // You would typically check the admin credentials here
    // For example:
    // if (validate_admin_credentials($email, $password)) { ... }

    if ($username && $password) {
        // Generate a random OTP
        $otp = rand(100000, 999999);

        // Store OTP in session or database for verification later
        session_start();
        $_SESSION['otp'] = $otp;

        // Send OTP to email
        $subject = "Your OTP Code";
        $message = "Your OTP code is: " . $otp;
        $headers = "From: no-reply@yourdomain.com\r\n";

        if (mail($email, $subject, $message, $headers)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Unable to send email.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    }
}
?>
