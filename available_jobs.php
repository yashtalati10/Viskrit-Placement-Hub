<?php
session_start(); // Start the session to maintain user state
require 'db.php'; // Include the database connection file

// Check if the user is logged in, if not, redirect to the login page
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}

// Get the current user's username and first name from session variables
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];

// Query to count the total number of jobs available
$query = "SELECT COUNT(*) AS TotalJobs FROM all_jobs_list";
$stmt = $conn->prepare($query);
$stmt->execute();
$job_count_result = $stmt->get_result();
$job_count = $job_count_result->fetch_assoc(); // Fetch the total number of jobs

// Query to count the total number of job applications by the current user
$query = "SELECT COUNT(*) AS TotalApplications FROM job_applications WHERE username=$username";
$stmt = $conn->prepare($query);
$stmt->execute();
$application_count_result = $stmt->get_result();
$application_count = $application_count_result->fetch_assoc(); // Fetch the total number of applications submitted by the user


// Check if a search query is provided
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Modify the SQL query to filter based on the search query
if ($searchQuery) {
  $query = "SELECT * FROM all_jobs_list WHERE job_role LIKE ? OR company_name LIKE ?";
  $stmt = $conn->prepare($query);
  $searchTerm = '%' . $searchQuery . '%';
  $stmt->bind_param("ss", $searchTerm, $searchTerm);
} else {
  // Default query to show all jobs
  $query = "SELECT * FROM all_jobs_list";
  $stmt = $conn->prepare($query);
}

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
  <style>
    body {
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
  </style>
</head>

<body>
  <!-- Navigation Bar -->
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

  <!-- Search Bar -->
  <div class="container mt-5">
    <form class="d-flex" method="GET" action="">
      <input class="form-control me-2" type="search" placeholder="Search jobs" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>">
      <button class="btn btn-info" type="submit">Search</button>
    </form>
  </div>

  <!-- Available Jobs Section -->
  <section id="student-dashboard" class="my-5">
    <div class="container">
      <h2 class="text-center mb-5">Available Jobs</h2>
      <div class="row">
        <?php
        // Check if there are jobs available, then display them in a card format
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) { // Fetch each job row
        ?> 
            <div class="col-md-3 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body">
                  <!-- Job Role -->
                  <h5 class="card-title fw-bold"><?php echo $row['job_role']; ?></h5>
                  <!-- Company Name -->
                  <p class="card-text mb-2"><i class="bi bi-building"></i> <?php echo $row['company_name']; ?></p>
                  <!-- No of Applications -->
                  <p class="card-text mb-2"><i class="bi bi-person-lines-fill"></i> Total Applications:
                    <?php echo $row['no_applicants']; ?></p>
                  <!-- Expected Salary -->
                    <p class="card-text mb-2"><i class="bi bi-currency-dollar"></i> Expected Salary:
                    <?php echo $row['expected_salary']; ?></p>
                  <!-- Job Type -->
                    <p class="card-text mb-3"><i class="bi bi-briefcase"></i> Job Type: <?php echo $row['job_type']; ?></p>
                  <!-- View Button to see job details -->
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
          echo "<p class='text-center'>No jobs found!</p>"; // Message if no jobs are available
        }
        ?>
      </div>
    </div>
  </section>

  <?php
  // Close the database connection
  $conn->close();
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>