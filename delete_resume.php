<?php

// Include the database connection file
require 'db.php';

// Check if 'username' is set in the GET request
if (isset($_GET['username'])) {
    $username = $_GET['username']; // Get the username from the GET request

    // Prepare SQL query to select the student's details, including the file path of the resume
    $sql = "SELECT * FROM all_students_list WHERE username='$username'";
    $result = $conn->query($sql); // Execute the query to get the student data
    $file = $result->fetch_assoc(); // Fetch the result as an associative array

    // Attempt to delete the resume file from the server
    if (unlink($file['resume_file_path'])) {
        // If file deletion is successful, update the database to remove file references
        $conn->query("UPDATE all_students_list SET resume_file_name = '', resume_file_path ='' WHERE username = '$username'");
        // Redirect to the student's profile page after successful deletion
        header("Location: student_profile.php");
    } else {
        // If file deletion fails, output an error message
        echo "Failed to delete file.";
    }
}
?>
