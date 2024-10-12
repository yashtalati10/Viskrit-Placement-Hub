<?php
require 'db.php';
session_start();
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}
if (isset($_GET['username']) && isset($_GET['job_id'])) {
    $username = $_GET['username'];
    $job_id = $_GET['job_id'];
    $status = $_GET['status'];
    $result1 = mysqli_query($conn, "SELECT * FROM all_jobs_list where job_id='$job_id'");
    $job_role = $result1->fetch_assoc();
} else {
    echo "Invalid request!";
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM all_students_list where username='$username'");
if (mysqli_num_rows($result) > 0) {
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
                                    <p><strong>Status:</strong> <?php echo $status; ?></p>
                                    <hr>


                                    <div class="d-grid gap-2">
                                        <a href="<?php echo $row['resume_file_path']; ?>" target="_blank"
                                            class="btn btn-secondary">
                                            View Resume
                                        </a>
                                    </div>
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