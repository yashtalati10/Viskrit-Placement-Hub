
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
            <a class="nav-link" href="#login">Login</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#company-dashboard">Company Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#student-dashboard">Student Dashboard</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#admin-dashboard">Student Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <!-- Login Section -->
    <section id="login" class="my-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <h3 class="text-center mb-3">Student Login</h3>
          <form method="POST" action="student_login_process.php">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </section>

 

  

  
  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-2">
    <p>&copy; 2024 College Job Portal. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
