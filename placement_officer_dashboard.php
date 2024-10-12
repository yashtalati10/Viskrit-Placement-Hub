<?php
require 'db.php'; // Your database connection file
session_start();
if ($_SESSION['logged_in']) {

  $company_name = $_SESSION['company_name'];

  $query = "SELECT * FROM all_jobs_list WHERE company_name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $company_name);
  $stmt->execute();
  $result = $stmt->get_result();
  
  
  $query = "SELECT * FROM job_applications WHERE company_name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $company_name);
  $stmt->execute();
  $result1 = $stmt->get_result();
  
  // $query = "SELECT COUNT(*) AS TotalRows FROM all_companies_list";
  // $stmt = $conn->prepare($query);
  // $stmt->execute();
  // $company_count_result = $stmt->get_result();
  // $company_count = $company_count_result->fetch_assoc();

  $query = "SELECT COUNT(*) AS TotalJobs FROM all_jobs_list WHERE company_name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $company_name);
  $stmt->execute();
  $job_count_result = $stmt->get_result();
  $job_count = $job_count_result->fetch_assoc();
  
  $query = "SELECT COUNT(*) AS TotalStudents FROM job_applications WHERE company_name = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $company_name);
  $stmt->execute();
  $student_count_result = $stmt->get_result();
  $student_count = $student_count_result->fetch_assoc();


} else {
  echo $_SESSION['logged_in'];
  header('location:placement_officer_login.php');
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

<body>

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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="company_view_applications.php">Applications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Jobs</a>
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
      <!-- <div class="col-md-4">
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
            </div> -->

      <!-- Card 2: Total Jobs Posted -->
      <div class="col-md-4">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h6 class="card-title">Total Jobs Posted</h6>
            <h2 class="fw-bold text-primary"><?php echo $job_count['TotalJobs']; ?></h2>
            <a href="company_all_jobs.php" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
              View All Jobs
              <i class="bi bi-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Card 3: Total Applications -->
      <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Total Students Applied</h6>
                        <h2 class="fw-bold text-danger"><?php echo $student_count['TotalStudents']; ?></h2>
                        <a href="company_view_applications.php" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                            View Applications
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
    </div>
  </div>


   <!-- Company Dashboard Section -->
  <section id="company-dashboard" class="my-5">
    <div class="container">
      <h2 class="text-center"></h2>
      <div class="row">
        
        <div class="col-md-6">
          
          <h4>Posted Jobs</h4>
          <table class="table table-bordered table-striped mt-4">
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
                        <input type="hidden" name="job_id" value="<?php echo $job_list['job_id']; ?>">
                        <button type="submit" class="btn btn-info">View</button>
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




        <!-- View Applications -->
        <!-- <div class="col-md-6">
          <h4>View Applications</h4>
          <table class="table table-bordered table-striped mt-4">
            <thead class="thead-dark">
              <tr>
                <th>Sr. No</th>
                <th>Student Full Name</th>
                <th>Job Role</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody> -->
              <?php
              // if ($result1->num_rows > 0) {
                // $srNo = 1; // Initialize serial number
                // while ($job1 = $result1->fetch_assoc()) {
                  ?>
                  <?php
                  // $job_id = $job1['job_id'];
                  // $query = "SELECT job_role FROM all_jobs_list WHERE job_id = $job_id";
                  // $stmt = $conn->prepare($query);
                  // $stmt->execute();
                  // $result2 = $stmt->get_result();
                  // $job_role = $result2->fetch_assoc()
                    ?>
                  <!-- <tr> -->
                    <!-- <td><?php //echo $srNo++; ?></td> Increment serial number -->
                    <!-- <td><?php //echo $job1['first_name'] . " " . $job1['last_name']; ?></td> -->
                    <!-- <td><?php //echo $job_role['job_role']; ?></td> -->
                    <!-- <td><?php //echo $job1['status']; ?></td> -->
                    <!-- <td> -->
                      <!-- <form action="view_job.php">
                        <button class="btn btn-info">View</button>
                      </form>
                    </td>
                  </tr> -->
                  <?php
            //    }
             // } else {
                ?>
                <!-- <tr>
                  <td colspan="4" class="text-center">No jobs posted yet</td>
                </tr> -->
                <?php
              //}
              ?>
            <!-- </tbody>
          </table>
        </div>
      </div>
    </div>
  </section> -->

  <!-- Bootstrap JS (Optional if needed for interactivity like collapse) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>