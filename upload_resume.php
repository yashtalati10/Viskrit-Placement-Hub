<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory to upload files
    $targetDir = "resume/";

    // Getting the file information
    $fileName = basename($_FILES["resume"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Define allowed file types (e.g., PDF, DOC, DOCX)
    $allowedTypes = array('pdf', 'doc', 'docx');

    // Check if the file is valid
    if (in_array($fileType, $allowedTypes)) {
        // Upload the file to the server
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)) {
            // Redirect with success message
            header("Location: student_profile.php?success=1");
            exit();
        } else {
            echo "Error: Could not upload the file.";
        }
    } else {
        echo "Error: Only PDF, DOC, and DOCX files are allowed.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
