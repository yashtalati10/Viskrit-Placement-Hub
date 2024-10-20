<?php
// Include the database connection file
require 'db.php';

// Use PHPMailer classes to send emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files for sending emails
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if the form was submitted using POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $collegeid = $_POST['collegeid'];            // College ID
    $first_name = $_POST['first_name'];          // Student's first name
    $last_name = $_POST['last_name'];            // Student's last name
    $username = $_POST['collegeid'];             // Username (same as College ID)
    $password = $_POST['mobile'];                // Password (same as mobile number)
    $mobile = $_POST['mobile'];                  // Mobile number
    $email = $_POST['email'];                    // Email address
    $department = $_POST['department'];          // Department name

    // SQL query to insert the student data into the 'all_students_list' table
    $query = "INSERT INTO all_students_list (collegeid, first_name, last_name, mobile, email, username, password, department) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare($query);

    // Bind the parameters to the query ('ssssssss' means 8 string parameters)
    $stmt->bind_param('ssssssss', $collegeid, $first_name, $last_name, $mobile, $email, $username, $password, $department);

    // Execute the query
    if ($stmt->execute()) {
        // If the student is successfully added, display a success message
        echo "Student added successfully!";
        
        // Set up PHPMailer to send an email with login credentials
        $mail = new PHPMailer(true);

        // Configure the mail server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';           // SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'yashtalati07@gmail.com'; // Your email username
        $mail->Password = 'lwym wcoy atxv lijf';       // Your email password (use an app-specific password if needed)
        $mail->SMTPSecure = 'ssl';                // Enable SSL encryption
        $mail->Port = 465;                        // Port for SSL

        // Set the sender's email and name
        $mail->setFrom('yashtalati07@gmail.com', 'Yash Talati');

        // Add the recipient's email (student's email)
        $mail->addAddress($email);

        // Set the email format to HTML
        $mail->isHTML(true);

        // Set the email subject
        $mail->Subject = "Login Credentials";

        // Construct the email body with the student's login details
        $msg = 'Dear '.strtoupper($first_name). '<p>Following are your login credentials for Placement Hub:</p>' .
               '<p>Username: '.$collegeid.'</p>' .
               '<p>Password: '.$password.'</p>';

        // Set the email message content
        $mail->Body = $msg;

        // Send the email
        $mail->send();

    } else {
        // If there is an error during insertion, check if it's due to duplicate entry of 'collegeid'
        if ($stmt->errno == 1062) {  // 1062 is the MySQL error code for duplicate entries
            echo "Error: A student with this College ID already exists.";
        } else {
            // Display any other error that occurred during the query execution
            echo "Error adding student: " . $stmt->error;
        }
    }
}
?>
