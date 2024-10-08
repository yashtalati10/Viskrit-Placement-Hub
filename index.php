<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Job Portal</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  <style>
    body {

      font-family: "Varela Round", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .new-home-style {
      background-color: white;
      border-radius: 12px;
      border: 1px sold white 15%;
    }

    .clg-background {
      background-image: url('Anjuman-new.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
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
      background-color: #1b3f6e;
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

    .bg-dark1 {
      background-color: #1b3f6e;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark1">
    <div class="container-fluid">
      <a class="navbar-brand" href="./">Placement Hub</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="roadmap.php">Roadmap</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notifications.php">Notifications</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#admin-dashboard">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="hero clg-background">
    <div class="container">
      <div class="row align-items-center new-home-style">
        <div class="col-md-6 ">
          <h1 class="hero-title ">Your Gateway to Career Opportunities</h1>
          <p class="hero-subtitle ">A one-stop platform for students to find internships, placements, and career
            guidance
            with top recruiters.</p>
          <a href="student_login.php" class="cta-button">Get Started</a>
        </div>
        <div class="col-md-6 hero-image">
          <img src="./image/search-hiring-job-online.png" alt="Job Search Illustration" class="img-fluid">
        </div>
      </div>
    </div>
  </section>


  <!-- About College Section -->

  <!-- <div class="row justify-content-center m-1">
    <img src="./image/Anjuman-new.jpg" alt="College Image">
  </div> -->

  <!-- End About College Section -->

  <!-- Login Cards -->
  <div class="container mt-5 ">
    <div class="row justify-content-evenly">
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
              <h5 class="card-title">Recruiter</h5>
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


  <!-- Carousel -->
  <div id="myCarousel" class="container carousel slide mt-5" data-bs-ride="carousel">
    <!-- Indicators -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
        aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Carousel items -->
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="./image/image1.jpg" class="d-block w-100" alt="Slide 1">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="./image/image2.jpg" class="d-block w-100" alt="Slide 2">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="./image/image3.jpg" class="d-block w-100" alt="Slide 3">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>





  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>

</html>