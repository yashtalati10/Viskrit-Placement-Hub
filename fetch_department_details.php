<?php
require 'db.php'; // Include your database connection file

// Check if the 'id' is set in the POST request
if (isset($_POST['id'])) {
    $studentId = $_POST['id']; // Retrieve the student ID from the POST data

    // Prepare a SQL query to fetch the full details of the student by ID
    $query = "SELECT * FROM department_details WHERE id = ?"; // Query to select all columns for the given student ID
    $stmt = $conn->prepare($query); // Prepare the SQL statement to prevent SQL injection
    $stmt->bind_param('i', $studentId); // Bind the student ID to the query as an integer
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result set from the executed statement

    // Fetch the student details if a matching record is found
    if ($row = $result->fetch_assoc()) { // Check if a row is returned
        // Output the student's details in a readable format
        echo "<p><strong>First Name:</strong> " . $row['first_name'] . "</p>"; // Display the student's first name
        echo "<p><strong>Last Name:</strong> " . $row['last_name'] . "</p>"; // Display the student's last name
        echo "<p><strong>Department:</strong> " . $row['department'] . "</p>"; // Display the student's department
        echo "<p><strong>Mobile Number:</strong> " . $row['mobile'] . "</p>"; // Display the student's mobile number
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>"; // Display the student's email address
        echo "<p><strong>Username:</strong> " . $row['username'] . "</p>"; // Display the student's username
    }
}
?>