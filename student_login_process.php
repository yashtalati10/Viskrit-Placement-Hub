<?php
session_start();
require 'db.php'; // Include your DB connection file

// Function to get admin details from the database
function get_student_credentials($username)
{
    global $conn; // Use the database connection from db_connection.php

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username, password,first_name FROM all_students_list WHERE username = ?");
    $stmt->bind_param('s', $username); // Bind the username to the query
    $stmt->execute();
    $result = $stmt->get_result();


    // If a matching user is found, return their data
    if ($result->num_rows > 0) {

        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $otp = $_POST['otp'];

    // Fetch admin credentials from the database
    $student = get_student_credentials($username);

    if ($student) {
        // Validate password (hashed in the database)
        if ($password == $student['password']) {
            // Check if OTP matches the one stored in the session
            // if (isset($_SESSION['otp']) && $otp === $_SESSION['otp']) {
            // Credentials and OTP are correct, proceed to the dashboard
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username; // Set session for admin login // Set session for admin login
            $_SESSION['first_name'] = $student['first_name']; // Set session for admin login // Set session for admin login
            header('Location: student_dashboard.php'); // Redirect to dashboard
            exit;
            // } else {
            // OTP doesn't match
            // echo "<script>alert('Invalid OTP. Please try again.'); window.history.back();</script>";
            // }
        } else {
            // Invalid password
            echo "<script>alert('Invalid password. Please try again.'); window.history.back();</script>";
        }
    } else {
        // Invalid username
        echo "<script>alert('Invalid username. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}