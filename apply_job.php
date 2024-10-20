<?php
require 'db.php'; // Include the database connection file
session_start(); // Start the session

// Check if the user is logged in by verifying the session variable
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php"); // Redirect to the login page if not logged in
}

// Check if a job ID is passed in the URL using a GET request
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id']; // Get the job ID from the URL
    $username = $_SESSION['username']; // Get the logged-in username from session

    // Check if the user has already applied to this job and fetch the status
    $query = "SELECT status FROM job_applications WHERE job_id = ? AND username = ?";
    $stmt = $conn->prepare($query); // Prepare the SQL query
    $stmt->bind_param('is', $job_id, $username); // Bind job ID and username parameters
    $stmt->execute(); // Execute the query
    $status_result = $stmt->get_result(); // Get the result set

    // Check if there is a record of the user applying for this job
    if ($status_result->num_rows > 0) {
        $status = $status_result->fetch_assoc(); // Fetch the status record

        // Determine button states based on the application status
        if ($status['status'] == 'Applied' || $status['status'] == 'Rejected') {
            $buttonDisabled = true; // Disable the button if the status is Applied or Rejected
        }
        if ($status['status'] == "Accepted") {
            $buttonSuccess = true; // Show success if the application is Accepted
        }
    }

    // Fetch job details using the job ID
    $query = "SELECT * FROM all_jobs_list WHERE job_id = ?";
    $stmt = $conn->prepare($query); // Prepare the SQL query
    $stmt->bind_param('i', $job_id); // Bind the job ID parameter
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result set

    // Check if job details are found
    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc(); // Fetch the job details
        // Store the company name and job ID in session variables for later use
        $_SESSION['company_name'] = $job['company_name'];
        $_SESSION['job_id'] = $job['job_id'];
    } else {
        // Display an error message if the job is not found
        echo "Job not found!";
        exit; // Exit the script
    }
} else {
    // Display an error message if the request is invalid (no job ID provided)
    echo "Invalid request!";
    exit; // Exit the script
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
        .nav-bar-color {
            /* background-color: #32213A; */
            background-color: #433878;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            /* background-color: #007bff; */
            background-color: #433878;
            color: white;
            font-weight: bold;
        }

        .btn-success,
        .btn-danger {
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

    <nav class="navbar navbar-expand-lg navbar-dark nav-bar-color">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Viskrit Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="student_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="available_jobs.php">View Jobs</a>
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
            <div class="card-header" style="background-color: #433878;">
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
        <!-- Application Button Section -->
        <div class="mt-4">
            <?php if (isset($buttonSuccess)): ?>
                <button class="btn btn-success" disabled>Application Accepted</button>

            <?php elseif (isset($buttonDisabled)): ?>
                <!-- Show different buttons based on the application status -->
                <?php if ($status['status'] == 'Applied'): ?>
                    <button class="btn btn-primary" disabled><?php echo $status['status']; ?></button>
                <?php else: ?>
                    <button class="btn btn-danger" disabled><?php echo $status['status']; ?></button>
                <?php endif; ?>

            <?php else: ?>
                <!-- Show the Easy Apply button if the user has not applied before -->
                <form action="apply_job_process.php" method="POST" onsubmit="return confirmApplication();">
                    <input type="hidden" name="job_id" value="<?= $job['job_id'] ?>">
                    <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                    <button type="submit" class="btn btn-primary w-100">Easy Apply</button>
                </form>
            <?php endif; ?>

        </div>
    </div>

    <script>
        // Confirm before applying for the job
        function confirmApplication() {
            return confirm("Are you sure you want to apply for this job?");
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>