<?php
require 'db.php'; // Your database connection file
session_start();
if ($_SESSION['logged_in']) {
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
            $_SESSION['company_name'] = $job['company_name'];
            $_SESSION['job_id'] = $job['job_id'];
        } else {
            echo "Job not found!";
            exit;
        }

        $query = "SELECT * FROM job_applications WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $result1 = $stmt->get_result();

        $query = "SELECT * FROM job_applications WHERE job_id = ? AND status = 'Accepted'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $result2 = $stmt->get_result();

        $query = "SELECT * FROM job_applications WHERE job_id = ? AND status = 'Rejected'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $result3 = $stmt->get_result();

        $query = "SELECT COUNT(*) AS TotalRows FROM job_applications WHERE job_id = ? AND status = 'Accepted'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $selected_students_result = $stmt->get_result();
        $selected_students = $selected_students_result->fetch_assoc();

        $query = "SELECT COUNT(*) AS TotalRows FROM job_applications WHERE job_id = ? AND status = 'Rejected'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);
        $stmt->execute();
        $rejected_students_result = $stmt->get_result();
        $rejected_students = $rejected_students_result->fetch_assoc();

    } else {
        echo "Invalid request!";
        exit;
    }
} else {
    header('location:placement_officer_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <style>
        /* Custom CSS */
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

        .card-custom {
            border-radius: 10px;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .icon-custom {
            font-size: 1.2em;
        }

        .text-muted {
            color: #6c757d !important;
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
                        <a class="nav-link" href="#company-dashboard">Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4"><?php echo $job['job_role']; ?></h1>
        <div class="card card-custom shadow-sm">
            <div class="card-header bg-primary text-white">
                Job Details
            </div>
            <div class="card-body">
                <p><strong>Job Description: </strong> <?php echo $job['job_description']; ?></p>
                <p><strong>Skills Required: </strong> <?php echo $job['skills_req']; ?></p>
                <p><strong>Number of Students Applied: </strong> <?php echo $job['no_applicants']; ?></p>
                <p><strong>Job Type: </strong> <?php echo $job['job_type']; ?></p>
                <p><strong>Expected Salary: </strong> <?php echo $job['expected_salary']; ?></p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Card 1: Selected Students -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card text-center shadow-sm card-custom">
                    <div class="card-body">
                        <h6 class="card-title">Selected Students</h6>
                        <h2 class="fw-bold text-success"><?php echo $selected_students['TotalRows']; ?></h2>
                        <a href="#accepted-students" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                            View List <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Rejected Students -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card text-center shadow-sm card-custom">
                    <div class="card-body">
                        <h6 class="card-title">Rejected Students</h6>
                        <h2 class="fw-bold text-danger"><?php echo $rejected_students['TotalRows']; ?></h2>
                        <a href="#rejected-students" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                            View List <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Applied -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Students Who Applied for This Role</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. No</th>
                    <th>Student Full Name</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result1->num_rows > 0) {
                    $srNo = 1; 
                    while ($job1 = $result1->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $srNo++; ?></td>
                            <td><?php echo $job1['first_name'] . " " . $job1['last_name']; ?></td>
                            <td><?php echo $job1['department']; ?></td>
                            <td><?php echo $job1['status']; ?></td>
                            <td>
                                <form action="view_student_profile.php" method="GET">
                                    <input type="hidden" name="username" value="<?php echo $job1['username']; ?>">
                                    <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                                    <button class="btn btn-info"><i class="bi bi-eye icon-custom"></i> View</button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } else { ?>
                    <tr>
                        <td colspan="5" class="text-center">No students applied yet!</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Accepted Students -->
    <div class="container mt-5" id="accepted-students">
        <h2 class="text-center mb-4">Accepted Students</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. No</th>
                    <th>Student Full Name</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result2->num_rows > 0) {
                    $srNo = 1;
                    while ($job2 = $result2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $srNo++; ?></td>
                            <td><?php echo $job2['first_name'] . " " . $job2['last_name']; ?></td>
                            <td><?php echo $job2['department']; ?></td>
                            <td>
                                <form action="view_student_profile.php" method="GET">
                                    <input type="hidden" name="username" value="<?php echo $job2['username']; ?>">
                                    <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                                    <button class="btn btn-info"><i class="bi bi-eye icon-custom"></i> View</button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center">No students accepted yet!</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Rejected Students -->
    <div class="container mt-5" id="rejected-students">
        <h2 class="text-center mb-4">Rejected Students</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. No</th>
                    <th>Student Full Name</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result3->num_rows > 0) {
                    $srNo = 1;
                    while ($job3 = $result3->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $srNo++; ?></td>
                            <td><?php echo $job3['first_name'] . " " . $job3['last_name']; ?></td>
                            <td><?php echo $job3['department']; ?></td>
                            <td>
                                <form action="view_student_profile.php" method="GET">
                                    <input type="hidden" name="username" value="<?php echo $job3['username']; ?>">
                                    <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                                    <button class="btn btn-info"><i class="bi bi-eye icon-custom"></i> View</button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center">No students rejected yet!</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
