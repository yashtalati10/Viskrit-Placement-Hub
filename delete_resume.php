<?php

require 'db.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Get file path to delete
    $sql = "SELECT * FROM all_students_list WHERE username='$username'";
    $result = $conn->query($sql);
    $file = $result->fetch_assoc();

    if (unlink($file['resume_file_path'])) {
        // Delete from database
        $conn->query("UPDATE all_students_list SET resume_file_name = '', resume_file_path ='' WHERE username = '$username'");
        header("Location: student_profile.php");
    } else {
        echo "Failed to delete file.";
    }
}
?>
