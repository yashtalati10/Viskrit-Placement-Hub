<?php
require 'db.php'; // Your database connection file

if (isset($_POST['id'])) {
    $studentId = $_POST['id'];

    // Query to fetch the full details of the student
    $query = "SELECT * FROM all_students_list WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<p><strong>College ID:</strong> " . $row['collegeid'] . "</p>";
        echo "<p><strong>First Name:</strong> " . $row['first_name'] . "</p>";
        echo "<p><strong>Last Name:</strong> " . $row['last_name'] . "</p>";
        echo "<p><strong>Department:</strong> " . $row['department'] . "</p>";
        echo "<p><strong>Number of Companies Applied:</strong> " . $row['number_of_companies_applied'] . "</p>";
        echo "<p><strong>Mobile Number:</strong> " . $row['mobile'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        echo "<p><strong>Username:</strong> " . $row['username'] . "</p>";
        echo "<p><strong>Companies Applied:</strong> " . $row['companies_applied'] . "</p>";
    }
}
?>
