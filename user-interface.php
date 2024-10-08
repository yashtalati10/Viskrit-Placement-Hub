<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- Ensures the page is responsive and adapts to the screen size -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Job Portal</title>
  
  <!-- Links to Bootstrap CSS from CDN for styling and layout -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Fonts link to use "Varela Round" font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  
  <!-- Custom styles for the page -->
  <style>
    body {
      font-family: "Varela Round", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    /* Styling for a section with white background and rounded corners */
    .new-home-style {
      background-color: white;
      border-radius: 12px;
      border: 1px solid white 15%;
    }

    /* Background image for the hero section */
    .clg-background {
      background-image: url('Anjuman-new.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    /* Hero section (top part of the page) styling */
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

    /* Call-to-action button styling */
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

    /* Styling for the image in the hero section */
    .hero-image img {
      max-width: 100%;
      height: auto;
    }

    /* Dark blue background color used in the navbar */
    .bg-dark1 {
      background-color: #1b3f6e;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark1">
    <div class="container-fluid">
      <!-- Website name or logo on the left side of the navbar -->
      <a class="navbar-brand" href="./">Placement Hub</a>

      <!-- Toggler for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible navigation menu items -->
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

  <!-- Hero section -->
  <section class="hero clg-background">
    <div class="container">
      <!-- Row with two columns: text on the left and image on the right -->
      <div class="row align-items-center new-home-style">
        <div class="col-md-6">
          <!-- Main title and subtitle of the page -->
          <h1 class="hero-title">Your Gateway to Career Opportunities</h1>
          <p class="hero-subtitle">A one-stop platform for students to find internships, placements, and career
            guidance with top recruiters.</p>
          <!-- Button linking to student login page -->
          <a href="student_login.php" class="cta-button">Get Started</a>
        </div>
        <!-- Image on the right side of the hero section -->
        <div class="col-md-6 hero-image">
          <img src="./image/search-hiring-job-online.png" alt="Job Search Illustration" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <!-- Login Cards Section -->
  <div class="container mt-5">
    <div class="row justify-content-evenly">
      <!-- Student Login Card -->
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

      <!-- Admin Login Card -->
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

      <!-- Recruiter Login Card -->
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

      <!-- Department Login Card -->
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

  <!-- Bootstrap Carousel -->
  <div id="myCarousel" class="container carousel slide mt-5" data-bs-ride="carousel">
    <!-- Carousel indicators to switch between slides -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Carousel items (images) -->
    <div class="carousel-inner">
      <!-- First Slide -->
      <div class="carousel-item active">
        <img src="./image/image1.jpg" class="d-block w-100" alt="Slide 1">
      </div>
      <!-- Second Slide -->
      <div class="carousel-item">
        <img src="./image/image2.jpg" class="d-block w-100" alt="Slide 2">
      </div>
      <!-- Third Slide -->
      <div class="carousel-item">
        <img src="./image/image3.jpg" class="d-block w-100" alt="Slide 3">
      </div>
    </div>

    <!-- Carousel controls (previous and next buttons) -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Footer Section -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <!-- JavaScript files for Bootstrap and jQuery functionality -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
