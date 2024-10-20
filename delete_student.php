<?php
// Include the database connection file
require 'db.php'; // Your database connection file

// Check if 'id' is set in the POST request
if (isset($_POST['id'])) {
    $studentId = $_POST['id']; // Get the student ID from the POST request

    // Prepare the SQL query to delete a student record based on the provided ID
    $query = "DELETE FROM all_students_list WHERE id = ?";
    $stmt = $conn->prepare($query); // Prepare the SQL statement to prevent SQL injection
    $stmt->bind_param('i', $studentId); // Bind the student ID as an integer parameter

    // Execute the prepared statement
    if ($stmt->execute()) {
        // If the execution is successful, output a success message
        echo "Student deleted successfully!";
    } else {
        // If there is an error during execution, output an error message
        echo "Error deleting student.";
    }
}
?>
