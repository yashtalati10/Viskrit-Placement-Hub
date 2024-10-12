<?php
require 'db.php'; // Your database connection file
session_start();
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];




    // Fetch company details based on the ID
    $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
    } else {
        echo "Job not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $job['job_role'] . " - " . $job['company_name']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_student_list.php">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_company_list.php">Company List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="department_list.php">Department List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center"><?php echo $job['job_role'] . ": " . $job['company_name']; ?></h1>
        <div class="card mt-4">
            <div class="card-header">
                Job Details
            </div>
            <div class="card-body">
                <p><strong>Job Description: </strong> <?php echo $job['job_description']; ?></p>
                <p><strong>Skills Required: </strong> <?php echo $job['skills_req']; ?></p>
                <p><strong>Number of Applicants: </strong> <?php echo $job['no_applicants']; ?></p>
                <p><strong>Job Type: </strong> <?php echo $job['job_type']; ?></p>
                <p><strong>Expected Salary: </strong> <?php echo $job['expected_salary']; ?></p>

            </div>
        </div>


    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>