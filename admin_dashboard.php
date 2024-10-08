<?php
session_start();
require 'db.php';
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}

$query = "SELECT COUNT(*) AS TotalRows FROM all_companies_list";
$stmt = $conn->prepare($query);
$stmt->execute();
$company_count_result = $stmt->get_result();
$company_count = $company_count_result->fetch_assoc(); 

$query = "SELECT COUNT(*) AS TotalJobs FROM all_jobs_list";
$stmt = $conn->prepare($query);
$stmt->execute();
$job_count_result = $stmt->get_result();
$job_count = $job_count_result->fetch_assoc(); 

$query = "SELECT COUNT(*) AS TotalStudents FROM job_applications";
$stmt = $conn->prepare($query);
$stmt->execute();
$student_count_result = $stmt->get_result();
$student_count = $student_count_result->fetch_assoc(); 




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Job Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a class="nav-link" href="#login"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all_student_list.php">Student List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all_company_list.php">Company List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 

  <div class="container mt-5">
        <div class="row">
            <!-- Card 1: Total Companies -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Total Companies Registered</h6>
                        <h2 class="fw-bold text-success"><?php echo $company_count['TotalRows']; ?></h2>
                        <a href="all_company_list.php" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                            View All Companies
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Jobs Posted -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Total Jobs Posted</h6>
                        <h2 class="fw-bold text-primary"><?php echo $job_count['TotalJobs']; ?></h2>
                        <a href="all_jobs_list.php" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                            View All Jobs
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Students Applied -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Total Students Applied</h6>
                        <h2 class="fw-bold text-danger"><?php echo $student_count['TotalStudents']; ?></h2>
                        <a href="all_company_list.php" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                            View Student List
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>