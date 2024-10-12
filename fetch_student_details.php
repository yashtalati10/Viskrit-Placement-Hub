<?php
require 'db.php'; // Your database connection file
session_start();
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}

if (isset($_POST['id'])) {
    $studentId = $_POST['id'];
   

    // Query to fetch the full details of the student
    $query = "SELECT * FROM all_students_list WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
   

   
    

    
    
    if ($row = $result->fetch_assoc()) {
        $username = $row['username'];
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




    $query1 = "SELECT job_id, company_name FROM job_applications WHERE username = '$username'";
    $result1 = $conn->query($query1);
    $sr_no = 1;
    while($row1 = $result1->fetch_assoc()) {
        $job_id = $row1["job_id"];
        $query2 = "SELECT job_role FROM all_jobs_list WHERE job_id = $job_id";
        $result2 = $conn->query($query2);
        $job_role = $result2->fetch_assoc();
        echo "<p>".$sr_no.". ".$job_role["job_role"] ." - ".$row1["company_name"]."</p>";
        $sr_no++;
    }
}
?>
