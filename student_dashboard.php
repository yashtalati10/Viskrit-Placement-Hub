<?php
session_start();
if($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Job Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">ACET Job Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#login"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student_profile.php">My Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">My Applications</a>
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
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Job Title</th>
            <th>Company Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Example row -->
          <tr>
            <td>Software Developer</td>
            <td>TechCorp</td>
            <td>
              <a href="apply_job.php?job_id=1" class="btn btn-success">Apply</a>
            </td>
          </tr>
          <!-- Loop through available jobs here -->
        </tbody>
      </table>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-2">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>