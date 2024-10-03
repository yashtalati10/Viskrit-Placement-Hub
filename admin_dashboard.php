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
  <body class="d-flex flex-column min-vh-100">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Placement Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
  <!-- Admin Dashboard Section -->
  <section id="admin-dashboard" class="my-5">
    <div class="container">
      <h2 class="text-center">Admin Dashboard</h2>
      <h4>All Activities</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Company Name</th>
            <th>Job Title</th>
            <th>Application Status</th>
          </tr>
        </thead>
        <tbody>
          <!-- Example row -->
          <tr>
            <td>John Doe</td>
            <td>TechCorp</td>
            <td>Software Developer</td>
            <td>Applied</td>
          </tr>
          <!-- Loop through all applications here -->
        </tbody>
      </table>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  
</body>
</html>

