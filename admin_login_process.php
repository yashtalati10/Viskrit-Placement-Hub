<?php
session_start();
require 'db.php'; // Include your DB connection file

// Function to get admin details from the database
function get_admin_credentials($username)
{
    global $conn; // Use the database connection from db.php

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username, password FROM admin_details WHERE username = ?");
    $stmt->bind_param('s', $username); // Bind the username to the query to avoid SQL injection
    $stmt->execute();
    $result = $stmt->get_result();

    // If a matching user is found, return their data
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Return username and password from the database
    } else {
        return false; // Return false if no user is found
    }
}

// Check if form data is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Get the submitted username from the form
    $password = $_POST['password']; // Get the submitted password from the form
    // $otp = $_POST['otp']; // Uncomment if using OTP in the future

    // Fetch admin credentials from the database using the provided username
    $admin = get_admin_credentials($username);

    // If admin data is found, proceed with password validation
    if ($admin) {
        // Validate password (you can hash it in the future for better security)
        if ($password == $admin['password']) {

            // Set session for admin login and redirect to the dashboard
            $_SESSION['logged_in'] = true;
            header('Location: admin_dashboard.php'); // Redirect to the admin dashboard
            exit; // Ensure no further code is executed after the redirect

            // } else {
            // OTP doesn't match
            // echo "<script>alert('Invalid OTP. Please try again.'); window.history.back();</script>";
            // }
        } else {
            // Invalid password, alert the user and go back to the login form
            echo "<script>alert('Invalid password. Please try again.'); window.history.back();</script>";
        }
    } else {
        // Invalid username, alert the user and go back to the login form
        echo "<script>alert('Invalid username. Please try again.'); window.history.back();</script>";
    }
} else {
    // Invalid request method, redirect to the previous page
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>