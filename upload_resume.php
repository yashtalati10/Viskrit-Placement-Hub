<?php
require 'db.php'; // Include the database connection file

session_start(); // Start the session
$username = $_SESSION['username']; // Get the username of the logged-in user

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the name and temporary name of the uploaded file
    $fileName = $_FILES['pdf']['name'];
    $fileTmpName = $_FILES['pdf']['tmp_name'];
    
    // Define the destination path for the uploaded file
    $fileDestination = 'uploads/' . $fileName;

    // Move the uploaded file to the specified destination
    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        // SQL query to update the student's resume information in the database
        $sql = "UPDATE all_students_list SET resume_file_name = '$fileName', resume_file_path ='$fileDestination' WHERE username = '$username'";
        
        // Execute the query and check for success
        if ($conn->query($sql) === TRUE) {
            // Redirect to the student's profile page upon success
            header("Location: student_profile.php");
            exit; // Ensure no further code is executed after redirect
        } else {
            // Output an error message if the query fails
            echo "Error: " . $conn->error;
        }
    } else {
        // Output an error message if file upload fails
        echo "Failed to upload file.";
    }
}
?>