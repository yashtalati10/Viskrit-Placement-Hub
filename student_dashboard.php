<?php
session_start();
require 'db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
  header("Location: index.php");
  exit;
}

$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];

$query = "SELECT COUNT(*) AS TotalJobs FROM all_jobs_list";
$stmt = $conn->prepare($query);
$stmt->execute();
$job_count_result = $stmt->get_result();
$job_count = $job_count_result->fetch_assoc();

// Fetch application count securely using prepared statement
$query = "SELECT COUNT(*) AS TotalApplications FROM job_applications WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$application_count_result = $stmt->get_result();
$application_count = $application_count_result->fetch_assoc();



// Set the number of jobs to display per page
$jobsPerPage = 4;

// Get the current page number from the query string, default is 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1)
  $page = 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $jobsPerPage;

// Fetch total number of jobs to calculate pagination
$totalJobsQuery = "SELECT COUNT(*) as total FROM all_jobs_list";
$totalResult = $conn->query($totalJobsQuery);
$totalJobsRow = $totalResult->fetch_assoc();
$totalJobs = $totalJobsRow['total'];

// Calculate total pages
$totalPages = ceil($totalJobs / $jobsPerPage);

// Fetch jobs for the current page

$query = "SELECT * FROM all_jobs_list ORDER BY job_id DESC LIMIT ? OFFSET ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $jobsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $first_name ?>'s Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
 
  <style>
    body {
      background-color: #f5f5f5;
    }

    .navbar {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-bar-color {
      background-color: #433878;
    }

    .text-view-job {
      color: orange;
    }

    .btn-view-job {
      color: white;
      background-color: orange;
    }

    .btn-view-job:hover {
      color: white;
      background-color: #FF8C00;
    }

    .card {
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
    }

    .card-title {
      font-size: 1.2rem;
    }

    .stats-card h6 {
      font-size: 0.9rem;
    }

    .stats-card h2 {
      font-size: 2.5rem;
    }

    .pagination {
      margin-top: 20px;
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

    .page-link1 {
      background-color: #7E60BF;
      color: #f5f5f5;
      border: 1px solid #7E60BF;
      border-radius: 12px;
      padding: 12px;
      margin: 1px;
      text-decoration: none;
    }

    .page-link1:hover {
      background-color: #433878;
      border: 1px solid #433878;

    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
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
            <a class="nav-link" href="student_profile.php">My Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="available_jobs.php">Available Jobs</a>
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

  <!-- Dashboard Stats -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card text-center stats-card shadow-sm">
          <div class="card-body">
            <h6>Available Jobs</h6>
            <h2 class="fw-bold text-view-job"><?php echo $job_count['TotalJobs']; ?></h2>
            <a href="available_jobs.php" class="btn btn-sm btn-view-job">
              <i class="bi bi-briefcase-fill"></i> View All Jobs
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card text-center stats-card shadow-sm">
          <div class="card-body">
            <h6>Your Applications</h6>
            <h2 class="fw-bold text-success"><?php echo $application_count['TotalApplications']; ?></h2>
            <a href="student_my_applications.php" class="btn btn-sm btn-success">
              <i class="bi bi-file-earmark-text-fill"></i> View All Applications
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Available Jobs Section -->
  <section id="student-dashboard" class="my-5">
    <div class="container">
      <h2 class="text-center mb-5">Available Jobs</h2>
      <div class="row">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-3 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <h5 class="card-title fw-bold"><?php echo $row['job_role']; ?></h5>
                  <p class="card-text mb-2"><i class="bi bi-building"></i> <?php echo $row['company_name']; ?></p>
                  <p class="card-text mb-2"><i class="bi bi-person-lines-fill"></i> Total Applications:
                    <?php echo $row['no_applicants']; ?>
                  </p>
                  <p class="card-text mb-2"><i class="bi bi-currency-dollar"></i> Expected Salary:
                    <?php echo $row['expected_salary']; ?>
                  </p>
                  <p class="card-text mb-3"><i class="bi bi-briefcase"></i> Job Type: <?php echo $row['job_type']; ?></p>
                  <form method="GET" action="apply_job.php">
                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                    <button type="submit" class="btn btn-info btn-block ">View</button>
                  </form>
                </div>
              </div>
            </div>
            <?php
          }
        } else {
          echo "<p class='text-center'>No jobs found!</p>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Pagination Links -->
  <div class="container">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
          <li class="page-item">
            <a class="page-link1" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
            <a class="page-link1" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
          <li class="page-item">
            <a class="page-link1" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>