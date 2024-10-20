<?php
// Include the database connection file
require 'db.php';

// Start the session
session_start();

// Redirect to login page if not logged in
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}

// Check if username and job_id are set in the URL
if (isset($_GET['username']) && isset($_GET['job_id'])) {
    $username = $_GET['username'];
    $job_id = $_GET['job_id'];

    // Fetch job details based on job_id
    $result1 = mysqli_query($conn, "SELECT * FROM all_jobs_list where job_id='$job_id'");
    $job_role = $result1->fetch_assoc();
} else {
    // Display error and exit if parameters are missing
    echo "Invalid request!";
    exit;
}

// Fetch student details based on username
$result = mysqli_query($conn, "SELECT * FROM all_students_list where username='$username'");

// Check if there are any matching records
if (mysqli_num_rows($result) > 0) {
    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $row['first_name'] ?>'s Application</title>
            <!-- Add Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                /* Custom CSS */
                .navbar-custom {
                    background-color: #007bff;
                    /* Customize the navbar background color */
                }

                .navbar-custom .navbar-brand,
                .navbar-custom .nav-link {
                    color: white;
                    /* White text in navbar */
                }

                .navbar-custom .nav-link:hover {
                    color: #ffdd57;
                    /* Hover effect for navbar links */
                }

                .btn-primary {
                    background-color: #007bff;
                    border: none;
                }

                .btn-primary:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>

        <body class="d-flex flex-column min-vh-100">
            <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container">
                    <a class="navbar-brand" href="#">Company Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="placement_officer_dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="company_view_applications.php">Applications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="company_all_jobs.php">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <!-- <h1></h1> -->
                                <h1 class="card-title text-center mb-4"><?php echo $job_role['job_role']; ?> Applicant</h1>
                                <div class="profile-info">
                                    <p><strong>First Name:</strong> <?php echo strtoupper($row['first_name']); ?></p>
                                    <p><strong>Last Name:</strong> <?php echo strtoupper($row['last_name']); ?></p>
                                    <p><strong>Mobile:</strong> <?php echo strtoupper($row['mobile']); ?></p>
                                    <p><strong>Email:</strong> <?php echo ($row['email']); ?></p>
                                    <p><strong>Department:</strong> <?php echo $row['department']; ?></p>

                                    <hr>


                                    <div class="d-grid gap-2">
                                        <a href="<?php echo $row['resume_file_path']; ?>" target="_blank"
                                            class="btn btn-secondary">
                                            View Resume
                                        </a>
                                    </div>

                                    <!-- New form for Accept/Reject buttons -->
                                    <form action="reject_application.php" method="POST" class="mt-2">
                                        <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                                        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                        <button type="submit" name="action" value="reject"
                                            class="btn btn-danger">Reject</button>
                                    </form>
                                    <form action="accept_application.php" method="POST" class="mt-2">
                                        <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                                        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                        <button type="submit" name="action" value="accept"
                                            class="btn btn-success me-md-2">Accept</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
    }
}
    ?>
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>