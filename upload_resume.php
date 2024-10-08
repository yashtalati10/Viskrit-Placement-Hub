<?php
require 'db.php';

session_start();
$username = $_SESSION['username'];
  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileName = $_FILES['pdf']['name'];
    $fileTmpName = $_FILES['pdf']['tmp_name'];
    $fileDestination = 'uploads/' . $fileName;

    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        // $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES ('$fileName', '$fileDestination')";
        $sql = "UPDATE all_students_list SET resume_file_name = '$fileName', resume_file_path ='$fileDestination' WHERE username = '$username'";
        if ($conn->query($sql) === TRUE) {
            header("Location: student_profile.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload file.";
    }
}


