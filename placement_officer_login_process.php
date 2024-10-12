<?php
require 'db.php'; // Include your DB connection file
session_start();

// Function to get placement officer credentials from the database
function get_placement_officer_credentials($username)
{
    global $conn; // Use the database connection from db.php
    // Prepare a SQL statement to prevent SQL injection
    // echo "inside()";
    $stmt = $conn->prepare("SELECT * FROM all_companies_list WHERE username = ?");
    $stmt->bind_param('s', $username); // Bind the username parameter
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
    echo $username;
    echo $password;
    // Fetch placement officer credentials from the database
    $placement_officer = get_placement_officer_credentials($username);
    echo $placement_officer;
    if ($placement_officer) {
        // Validate password (assuming the password is stored as plain text or hashed, adjust accordingly)
        if ($password == $placement_officer['password']) { 
            // Set session for logged-in placement officer
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['company_name'] = $placement_officer['company_name'];
            
            // Redirect to the dashboard
            header('Location: placement_officer_dashboard.php');
           
            exit;
        } else {
            // Invalid password
            echo "<script>alert('Invalid password. Please try again.'); window.history.back();</script>";
        }
    } else {
        // Invalid username
        echo "<script>alert('Invalid username. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>
