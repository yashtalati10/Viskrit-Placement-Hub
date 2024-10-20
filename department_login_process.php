<?php
session_start(); // Start the session to manage user sessions
require 'db.php'; // Include the database connection file

// Function to get department admin credentials from the database
function get_department_admin_credentials($username) {
    global $conn; // Use the global database connection

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM department_details WHERE username = ?");
    $stmt->bind_param('s', $username); // Bind the username parameter to the query
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result of the query

    // If a matching user is found, return their data
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Fetch the user's data as an associative array
    } else {
        return false; // No matching user found
    }
}

// Check if form data is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Get the username from the form
    $password = $_POST['password']; // Get the password from the form
    // $otp = $_POST['otp']; // Uncomment if OTP validation is needed

    // Fetch admin credentials from the database using the username
    $admin = get_department_admin_credentials($username);
    if ($admin) {
        // Validate the entered password (assuming it is hashed in the database)
        if ($password == $admin['password']) {
            // Check if OTP matches the one stored in the session (if implemented)
            // if (isset($_SESSION['otp']) && $otp === $_SESSION['otp']) {
                // Credentials and OTP are correct, proceed to the dashboard
                $_SESSION['logged_in'] = true; // Set session variable to indicate the user is logged in
                header('Location: department_dashboard.php'); // Redirect to the department dashboard
                exit; // Exit the script to prevent further execution
            // } else {
                // OTP doesn't match
                // echo "<script>alert('Invalid OTP. Please try again.'); window.history.back();</script>";
            // }
        } else {
            // Invalid password case
            echo "<script>alert('Invalid password. Please try again.'); window.history.back();</script>";
        }
    } else {
        // Invalid username case
        echo "<script>alert('Invalid username. Please try again.'); window.history.back();</script>";
    }
} else {
    // Handle invalid request method
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>