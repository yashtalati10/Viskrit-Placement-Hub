<?php
require 'db.php'; // Your database connection file
session_start();

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $username = $_SESSION['username'];

    $query = "SELECT status FROM job_applications WHERE job_id = ? AND username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $job_id, $username);
    $stmt->execute();
    $status_result = $stmt->get_result();
    if ($status_result->num_rows > 0) {
        $status = $status_result->fetch_assoc();
        
        if ($status['status'] == 'Applied' || $status['status'] == 'Rejected') {
            $buttonDisabled = true;
        }
        if ($status['status'] == "Accepted") {
            $buttonSuccess = true;
        }
    }

    // Fetch company details based on the ID
    $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
        $_SESSION['company_name'] = $job['company_name'];
        $_SESSION['job_id'] = $job['job_id'];
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
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .btn-success, .btn-danger {
            width: 100%;
            margin-top: 20px;
        }
        .status {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="student_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_available_jobs.php">View Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student_my_applications.php">My Applications</a>
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
                <?php if (isset($status['status'])): ?>
                    <p class="status">Application Status: <?php echo $status['status']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4">
            <?php if (isset($buttonSuccess)): ?>
                <button class="btn btn-success" disabled>Application Accepted</button>
            <?php elseif (isset($buttonDisabled)): ?>
                <button class="btn btn-danger" disabled><?php echo $status['status']; ?></button>
            <?php else: ?>
                <form action="apply_job_process.php" method="POST" onsubmit="return confirmApplication();">
                    <input type="hidden" name="job_id" value="<?= $job['job_id'] ?>">
                    <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                    <button type="submit" class="btn btn-primary w-100">Easy Apply</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function confirmApplication() {
            return confirm("Are you sure you want to apply for this job?");
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
