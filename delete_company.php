<?php

// Start session to access session variables
session_start();
// Include the database connection file
include 'db.php'; // Make sure to replace this with your actual database connection file


// Check if the 'id' is set in POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // SQL query to delete the company from the database
    $deleteQuery = "DELETE FROM all_companies_list WHERE id = ?"; // Assuming the table name is 'companies'

    // Prepare and execute the query using prepared statements
    if ($stmt = $conn->prepare($deleteQuery)) {
        $stmt->bind_param("i", $id); // Bind 'id' to the query as an integer

        if ($stmt->execute()) {
            // If delete is successful, redirect with a success message
            $_SESSION['message'] = "Company deleted successfully.";
            $_SESSION['msg_type'] = "success";
        } else {
            // If there was an error, set an error message
            $_SESSION['message'] = "Error deleting company: " . $conn->error;
            $_SESSION['msg_type'] = "danger";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If query preparation fails, set an error message
        $_SESSION['message'] = "Failed to prepare delete query.";
        $_SESSION['msg_type'] = "danger";
    }

    // Close the database connection
    $conn->close();
    
    // Redirect back to the page where the companies are listed
    header("Location: all_company_list.php"); // Replace with the correct page
    exit();
} else {
    // If 'id' is not set, redirect back with an error message
    $_SESSION['message'] = "No company ID provided for deletion.";
    $_SESSION['msg_type'] = "danger";
    header("Location: all_company_list.php"); // Replace with the correct page
    exit();
}
?>
