<?php
require 'db.php'; // Include your database connection file
session_start(); // Start a new session or resume the existing one

// Function to retrieve placement officer credentials from the database
function get_placement_officer_credentials($username)
{
    global $conn; // Use the database connection from db.php
    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM all_companies_list WHERE username = ?"); // Prepare the SQL query
    $stmt->bind_param('s', $username); // Bind the username parameter to the prepared statement
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result set from the executed statement

    // If a matching user is found, return their data
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Fetch and return the user data as an associative array
    } else {
        return false; // Return false if no matching user is found
    }
}


// Check if the form data is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Get the username from POST data
    $password = $_POST['password']; // Get the password from POST data
    echo $username; // For debugging: output the username
    echo $password; // For debugging: output the password

    // Fetch placement officer credentials from the database
    $placement_officer = get_placement_officer_credentials($username);
    echo $placement_officer; // For debugging: output the fetched officer data

    if ($placement_officer) {
        // Validate the password (assuming it is stored as plain text or hashed; adjust as needed)
        if ($password == $placement_officer['password']) { 
            // Set session variables for the logged-in placement officer
            $_SESSION['logged_in'] = true; // Set logged_in status
            $_SESSION['username'] = $username; // Store the username in session
            $_SESSION['company_name'] = $placement_officer['company_name']; // Store the company name

            // Redirect to the placement officer dashboard
            header('Location: placement_officer_dashboard.php');
            exit; // Stop script execution after redirection
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
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>
