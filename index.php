<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Job Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  <style>
    body{

  font-family: "Varela Round", sans-serif;
  font-weight: 400;
  font-style: normal;

    }
    .hero {
      background-color: #f8f9fa;
      padding: 80px 0;
    }
    .hero-title {
      font-size: 3.5rem;
      font-weight: bold;
    }
    .hero-subtitle {
      font-size: 1.5rem;
      color: #6c757d;
      margin: 20px 0;
    }
    .cta-button {
      padding: 15px 30px;
      font-size: 18px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .cta-button:hover {
      background-color: #0056b3;
    }
    .hero-image img {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./">Placement Hub</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About Us</a>
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

  <section class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1 class="hero-title">Your Gateway to Career Opportunities</h1>
        <p class="hero-subtitle">A one-stop platform for students to find internships, placements, and career guidance with top recruiters.</p>
        <a href="student_login.php" class="cta-button">Get Started</a>
      </div>
      <div class="col-md-6 hero-image">
        <img src="./image/search-hiring-job-online.png" alt="Job Search Illustration" class="img-fluid">
      </div>
    </div>
  </div>
</section>


  <!-- About College Section -->

  <div class="row justify-content-center m-1">
    <img src="./image/Anjuman-new.jpg" alt="College Image">
  </div>
  
  <!-- End About College Section -->

  <!-- Login Cards -->
  <div class="container mt-5 ">
  <div class="row justify-content-center">
    <!-- Student Card -->
    <div class="col-md-2">
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
    <div class="col-md-2">
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
    <div class="col-md-2">
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
    <div class="col-md-2">
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
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
