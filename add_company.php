<?php
// Include the database connection file
require 'db.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $company_name = $_POST['company_name']; // The name of the company
    $mobile = $_POST['mobile'];             // Company's contact mobile number
    $email = $_POST['email'];               // Company's contact email
    $city = $_POST['city'];                 // The city where the company is located
    $state = $_POST['state'];               // The state where the company is located
    $username = $_POST['email'];            // Username for company (using email as username)
    $password = $_POST['mobile'];           // Password for company (using mobile as password, which may not be secure)

    // SQL query to insert the company data into the all_companies_list table
    $query = "INSERT INTO all_companies_list (company_name, mobile, email, city, state, username, password) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the SQL query to prevent SQL injection
    $stmt = $conn->prepare($query);
    
    // Bind the parameters to the query ('sssssss' indicates seven string parameters)
    $stmt->bind_param('sssssss', $company_name, $mobile, $email, $city, $state, $username, $password);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "Company added successfully!"; // Success message

        // Code to send MAIL --->

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
        echo "Error adding company."; // Error message if query fails
    }
}
?>
