<?php
require 'db.php'; // Database connection
session_start();

// Check if user is logged in
if ($_SESSION['logged_in']) {
    $company_name = $_SESSION['company_name'];

    // Fetch all jobs posted by the company
    $query = "SELECT * FROM all_jobs_list WHERE company_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $company_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch job application count for the company
    $query = "SELECT COUNT(*) AS TotalStudents FROM job_applications WHERE company_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $company_name);
    $stmt->execute();
    $student_count_result = $stmt->get_result();
    $student_count = $student_count_result->fetch_assoc();

} else {
    header('location:placement_officer_login.php'); // Redirect if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .navbar-custom {
            background-color: #007bff;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
        }

        .navbar-custom .nav-link:hover {
            color: #ffdd57;
        }

        /* Dashboard Section */
        #company-dashboard {
            margin-top: 30px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            /* Match with navbar */
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Match navbar link hover color */
        }

        


        @media (max-width: 768px) {
            .table-responsive {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="placement_officer_dashboard.php">Company Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="placement_officer_dashboard.php">Home</a>
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

    <!-- Company Dashboard Section -->
    <section id="company-dashboard" class="my-5">
        <div class="container">
            <h2 class="text-center mb-4">Jobs Posted by <?php echo $company_name; ?></h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Job Role</th>
                                    <th>No of Students Applied</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $srNo = 1; // Initialize serial number
                                    while ($job_list = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $srNo++; ?></td> <!-- Increment serial number -->
                                            <td><?php echo $job_list['job_role']; ?></td>
                                            <td><?php echo $job_list['no_applicants']; ?></td>
                                            <td>
                                                <form method="GET" action="company_view_job.php">
                                                    <input type="hidden" name="job_id"
                                                        value="<?php echo $job_list['job_id']; ?>">
                                                    <button type="submit" class="btn btn-primary">View</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No jobs posted yet</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>