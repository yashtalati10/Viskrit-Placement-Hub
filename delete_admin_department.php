<?php
require 'db.php'; // Your database connection file

if (isset($_POST['id'])) {
    $studentId = $_POST['id'];

    // Prepare delete query
    $query = "DELETE FROM department_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $studentId);

    if ($stmt->execute()) {
        echo "Department Admin deleted successfully!";
    } else {
        echo "Error deleting Department Admin.";
    }
}
?>