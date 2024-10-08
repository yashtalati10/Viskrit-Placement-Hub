<?php

require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $job_id = $_POST['job_id'];
    echo $username;
    echo $job_id;

    $query = "UPDATE job_applications SET status = 'Rejected' WHERE job_id = ? AND username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $job_id, $username);
    $stmt->execute();

    header('Location: company_view_job.php?job_id=' . $job_id);


}

?>