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
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

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
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">ACET Job Portal</a>
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

  
  <!-- Student Dashboard Section -->
  <section id="student-dashboard" class="my-5">
    <div class="container">
      <h2 class="text-center">Available Jobs</h2>

    </div>
  </section>






 
      <div class="container mt-5">
        <div class="row">
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              ?>
              <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                  <div class="card-body">
                    <!-- Job Role -->
                    <h5 class="card-title fw-bold"><?php echo $row['job_role']; ?></h5>
                    <!-- Company Name -->
                    <p class="card-text mb-2"><?php echo $row['company_name']; ?></p>
                    <!-- No of Applications -->
                    <p class="card-text mb-2"><strong>Total Applications:</strong> <?php echo $row['no_applicants']; ?></p>
                    <!-- Expected Salary -->
                    <p class="card-text mb-2"><strong>Expected Salary:</strong> <?php echo $row['expected_salary']; ?></p>
                    <!-- Job Type -->
                    <p class="card-text mb-3"><strong>Job Type:</strong> <?php echo $row['job_type']; ?></p>
                    <!-- View Button -->
                    <form method="GET" action="apply_job.php">
                      <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                      <button type="submit" class="btn btn-info">View</button>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            echo "<p>No jobs found!</p>";
          }
          ?>
        </div>
      </div>

      <!-- Pagination Links -->
      <div class="container mt-4">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <!-- Previous Page Link -->
            <?php if ($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
            <?php endif; ?>

            <!-- Page Number Links -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>

            <!-- Next Page Link -->
            <?php if ($page < $totalPages): ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
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