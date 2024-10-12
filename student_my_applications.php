<?php
require 'db.php'; // Your database connection file
session_start();
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}

$username = $_SESSION['username'];

// First, fetch job_id and company_name from job_applications table
$query1 = "SELECT job_id, company_name,status  FROM job_applications WHERE username = $username";
$result1 = $conn->query($query1);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications </title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-bar-color {
            background-color: #433878;
        }

        .btn-info {
            background-color: #7E60BF;
            border: none;
            color: #f5f5f5;
        }

        .btn-info:hover {
            background-color: #433878;
            color: #f5f5f5;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark nav-bar-color">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#login"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student_profile.php">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="available_jobs.php">Avaialable Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mt-5">
        <h2 class="text-center">My Applications</h2>
        <h2 class="text-center">
        </h2>
        <?php

        if ($result1->num_rows > 0) {

            echo '<div class="container mt-4">';
            echo '<table class="table table-bordered">';
            echo '
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Job Role</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>';
            // Initialize serial number counter
            $sr_no = 1;

            while ($row1 = $result1->fetch_assoc()) {
                $job_id = $row1['job_id'];
                $company_name = $row1['company_name'];
                $status = $row1['status'];

                // Now fetch job_role from all_jobs_list based on job_id
                $query2 = "SELECT job_role FROM all_jobs_list WHERE job_id = ?";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param('i', $job_id);
                $stmt->execute();
                $result2 = $stmt->get_result();
                $row2 = $result2->fetch_assoc();

                $job_role = $row2['job_role'];

                // Display job role and company name in Bootstrap card
                echo '
            <tr>
                <td>' . $sr_no . '</td>
                <td>' . $job_role . '</td>
                <td>' . $company_name . '</td>
                <td>' . $status . '</td>
                <td><a href="apply_job.php?job_id=' . $job_id . '+" class="btn btn-info">View Details</a></td>
            </tr>';
                // Increment serial number
                $sr_no++;
            }
            echo '
            </tbody>
        </table>';
            echo '</div>';
        } else {
            echo "No jobs found.";
        }
        ?>
    </div>




    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>