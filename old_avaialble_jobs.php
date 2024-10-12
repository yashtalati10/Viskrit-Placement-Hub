<?php
session_start();
require 'db.php';
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$query = "SELECT COUNT(*) AS TotalJobs FROM all_jobs_list";
$stmt = $conn->prepare($query);
$stmt->execute();
$job_count_result = $stmt->get_result();
$job_count = $job_count_result->fetch_assoc();

$query = "SELECT COUNT(*) AS TotalApplications FROM job_applications WHERE username=$username";
$stmt = $conn->prepare($query);
$stmt->execute();
$application_count_result = $stmt->get_result();
$application_count = $application_count_result->fetch_assoc();



// Set the number of jobs to display per page
$jobsPerPage = 12;

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
$query = "SELECT * FROM all_jobs_list LIMIT $jobsPerPage OFFSET $offset";
$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $first_name ?>'s Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
  <style>
    body{
      background-color: #f5f5f5;
    }
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
            <a class="nav-link" href="#login"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student_dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student_profile.php">My Profile</a>
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
                    <?php echo $row['no_applicants']; ?></p>
                  <p class="card-text mb-2"><i class="bi bi-currency-dollar"></i> Expected Salary:
                    <?php echo $row['expected_salary']; ?></p>
                  <p class="card-text mb-3"><i class="bi bi-briefcase"></i> Job Type: <?php echo $row['job_type']; ?></p>
                  <form method="GET" action="apply_job.php">
                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                    <button type="submit" class="btn btn-info btn-block">View</button>
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
  <div class="container mt-4">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <!-- Previous Page Link -->
        <?php if ($page > 1): ?>
          <li class="page-item">
            <a class="page-link1" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- Page Number Links -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
            <a class="page-link1" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <!-- Next Page Link -->
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

  <?php
  // Close the database connection
  $conn->close();
  ?>

  <!-- Footer -->
  <!-- <footer class="bg-dark text-white text-center py-3 mt-5">
  <p>&copy; 2024 College Job Portal. All rights reserved.</p>
</footer> -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>