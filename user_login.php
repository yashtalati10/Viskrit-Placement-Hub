<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags for character encoding and viewport settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Title of the page -->
  <title>College Job Portal</title>
  
  <!-- Bootstrap CSS for styling and responsiveness -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100"> <!-- Flexbox layout for the body to make footer stick to bottom -->
  
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Dark theme Bootstrap navbar -->
    <div class="container-fluid">
      <!-- Brand name/logo linked to index page -->
      <a class="navbar-brand" href="index.php">ACET Job Portal</a>
      
      <!-- Button for mobile navigation toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Collapsible section for nav items -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto"> <!-- Aligns navigation links to the right -->
          <!-- Navigation items for different dashboard links (currently commented out) -->
          <!-- 
          <li class="nav-item">
            <a class="nav-link" href="#login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#company-dashboard">Company Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#student-dashboard">Student Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#admin-dashboard">Student Login</a>
          </li>
          -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Section -->
  <section id="login" class="my-5"> <!-- Section for student login, with margin at the top and bottom -->
    <div class="container"> <!-- Bootstrap container to keep content centered and responsive -->
      <div class="row justify-content-center"> <!-- Centering the login form using Bootstrap grid -->
        <div class="col-md-4 shadow-lg p-4 border rounded"> <!-- Login form with shadow, padding, border, and rounded corners -->
          
          <!-- Heading for the login form -->
          <h3 class="text-center mb-3">Student Login</h3>
          
          <!-- Login form submission using POST method -->
          <form method="POST" action="student_login_process.php">
            
            <!-- Username input field -->
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required> <!-- Input field with validation -->
            </div>
            
            <!-- Password input field -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password"> <!-- Input type password to hide characters -->
            </div>
            
            <!-- Login button -->
            <button type="submit" class="btn btn-primary w-100">Login</button> <!-- Button with full width -->
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto"> <!-- Footer at the bottom with dark background and centered text -->
    <p>&copy; 2024 College Job Portal. All rights reserved.</p> <!-- Copyright information -->
  </footer>

  <!-- Bootstrap JavaScript bundle for enabling responsive features like dropdowns and toggler -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
