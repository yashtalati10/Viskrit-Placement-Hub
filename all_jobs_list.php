<?php
// Start the session
session_start();

// Include the database connection file
require 'db.php';

// Redirect to the login page if the user is not logged in
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}

// Query to count the total number of jobs in the database
$query = "SELECT COUNT(*) AS TotalJobs FROM all_jobs_list";
$stmt = $conn->prepare($query);
$stmt->execute();
$job_count_result = $stmt->get_result();
$job_count = $job_count_result->fetch_assoc(); // Fetch the job count as an associative array

// Fetch total number of jobs to calculate pagination
$totalJobsQuery = "SELECT COUNT(*) as total FROM all_jobs_list";
$totalResult = $conn->query($totalJobsQuery);
$totalJobsRow = $totalResult->fetch_assoc();
$totalJobs = $totalJobsRow['total']; // Store the total job count

// Calculate total pages (this part is incomplete in the provided code)

// Fetch all jobs from the database
$query = "SELECT * FROM all_jobs_list";
$result = $conn->query($query); // Execute the query to fetch jobs

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $first_name ?>'s Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

    
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                  <form method="GET" action="admin_view_job.php">
                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                    <button type="submit" class="btn btn-secondary btn-block">View</button>
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