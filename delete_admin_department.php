<?php
require 'db.php'; // Include the database connection file

// Check if the form has been submitted and 'id' is set
if (isset($_POST['id'])) {
    $studentId = $_POST['id']; // Get the student ID from the POST request

    // Prepare the delete query to remove the department admin based on the provided ID
    $query = "DELETE FROM department_details WHERE id = ?"; // SQL query to delete a record
    $stmt = $conn->prepare($query); // Prepare the SQL statement
    $stmt->bind_param('i', $studentId); // Bind the student ID as an integer parameter

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Department Admin deleted successfully!"; // Success message
    } else {
        echo "Error deleting Department Admin."; // Error message in case of failure
    }
}
?>
