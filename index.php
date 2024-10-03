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
      <a class="navbar-brand" href="#">ACET Job Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#login">About Us</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#company-dashboard">Company Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#student-dashboard">Student Dashboard</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#admin-dashboard">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- About College Section -->

  <div class="row justify-content-center m-3">
    <img src="./image/College Front Image.jpeg" alt="College Image">
  </div>
  
  <!-- End About College Section -->

  <!-- Login Cards -->
  <div class="container mt-5">
  <div class="row">
    <!-- Student Card -->
    <div class="col-md-3">
      <a href="student_login.php" class="text-decoration-none">
        <div class="card">
          <img src="./image/student_logo.png" class="card-img-top" alt="Student Image">
          <div class="card-body text-center">
            <h5 class="card-title">Student</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Admin Card -->
    <div class="col-md-3">
      <a href="admin_login.php" class="text-decoration-none">
        <div class="card">
          <img src="./image/admin_logo.png" class="card-img-top" alt="Admin Image">
          <div class="card-body text-center">
            <h5 class="card-title">Admin</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Company Card -->
    <div class="col-md-3">
      <a href="placement_officer_login.php" class="text-decoration-none">
        <div class="card">
          <img src="./image/company_logo.png" class="card-img-top" alt="Company Image">
          <div class="card-body text-center">
            <h5 class="card-title">Placement Officer</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Department Card -->
    <div class="col-md-3">
      <a href="" class="text-decoration-none">
        <div class="card">
          <img src="./image/department_logo.png" class="card-img-top" alt="Department Image">
          <div class="card-body text-center">
            <h5 class="card-title">Department</h5>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
  
  <!-- End Login Cards -->


 

  

  
  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-2">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
