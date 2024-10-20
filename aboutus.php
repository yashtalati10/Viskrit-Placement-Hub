<!DOCTYPE html>
<html lang="en">
<!-- Head Section containing metadata and style definitions -->

<head>
  <!-- Setting character encoding to UTF-8 for proper text rendering -->

  <meta charset="UTF-8">
  <!-- Ensures proper scaling on mobile devices -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Page title that appears in the browser tab -->

  <title>About Us - Placement Hub</title>
  <!-- Linking to Bootstrap CSS from a CDN for responsive design -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Internal CSS styles for the page -->
  <style>
    body {
      font-family: "Varela Round", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .new-home-style {
      background-color: white;
      border-radius: 12px;
      border: 1px solid white;
      margin-top: 20px;
    }

    .bg-dark1 {
      background-color: #1b3f6e;
    }

    .about-header {
      background-color: #007bff;
      color: white;
      padding: 30px 0;
      text-align: center;
    }

    .about-header h1 {
      font-size: 3rem;
    }

    .about-header p {
      font-size: 1.2rem;
      margin-top: 10px;
    }

    /* Styling for the About Us content section */
    .about-section {
      padding: 60px 0;
    }

    /* Heading styling for the subsections */
    .about-section h2 {
      font-size: 2.5rem;
      margin-bottom: 30px;
      text-align: center;
    }

    /* Margin for individual sections like mission, vision, and team */
    .about-mission,
    .about-vision,
    .about-team {
      margin-bottom: 40px;
    }

    /* Responsive image styling for section images */
    .about-mission img,
    .about-vision img,
    .about-team img {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>

<body>

  <!-- Navigation Bar -->
  <nav class=" navbar navbar-expand-lg navbar-dark bg-dark1">
    <div class="container-fluid">
      <!-- Branding for the navigation bar -->
      <a class="navbar-brand" href="./">Viskrit Placement Hub</a>
      <!-- Button to toggle the navbar in Mobile screens -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar content collapse (empty in this case) -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <!-- link to current page -->
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About Us</a>
          </li>
          <!-- link to roadmap -->
          <li class="nav-item">
            <a class="nav-link" href="roadmap.php">Roadmap</a>
          </li>
          <!-- link to contact us form -->
          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- About Us Header Section -->
  <section class="about-header">
    <div class="container">
      <!-- Main heading for the About Us page -->
      <h1>About Placement Hub</h1>
      <!-- Short description under the heading -->
      <p>You are finding the perfect job or internship, and helping companies discover top talent.</p>
    </div>
  </section>

  <!-- About Us Content Section -->
  <section class="about-section">
    <div class="container">
      <div class="row about-mission">
        <div class="col-md-6">
          <h2>Our Mission</h2>
          <!-- Mission description -->
          <p>
            At Placement Hub, our mission is to bridge the gap between job seekers and employers by providing a platform
            that streamlines the recruitment process.
            We aim to empower candidates with the best opportunities and tools to succeed in their career journeys.
          </p>
        </div>
        <!-- Image representing the mission -->
        <div class="col-md-6">
          <img src="https://via.placeholder.com/500x400" alt="Mission Image" class="img-fluid">
        </div>
      </div>

      <!-- Vision description -->
      <div class="row about-vision">
        <!-- Image representing the vision -->
        <div class="col-md-6">
          <img src="https://via.placeholder.com/500x400" alt="Vision Image" class="img-fluid">
        </div>
        <div class="col-md-6">
          <h2>Our Vision</h2>
          <p>
            Our vision is to become the leading global platform for connecting talent with opportunities, offering a
            seamless, effective, and inclusive placement process.
            We strive to continuously innovate and stay ahead of industry trends to deliver outstanding services.
          </p>
        </div>
      </div>
      <!-- Meet Our Team Section -->

      <div class="row about-team">
        <div class="col-md-6">
          <h2>Meet Our Team</h2>
          <p>
            Behind Placement Hub is a passionate team of professionals dedicated to making the hiring process easier and
            more accessible for everyone.
            With years of experience in recruitment, career counseling, and tech development, our team is driven to help
            you achieve your career goals.
          </p>
        </div>
        <!-- Image representing the team -->

        <div class="col-md-6">
          <img src="https://via.placeholder.com/500x400" alt="Team Image" class="img-fluid">
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <!-- Copyright notice -->

    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>


  <!-- Bootstrap JS for interactive components -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>