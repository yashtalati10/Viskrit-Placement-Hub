<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Hub - Roadmap</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Varela Round', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #f8f9fa;
            font-weight: 500;
        }

        .bg-dark1 {
            background-color: #1b3f6e;
        }

        .container {
            margin-top: 50px;
        }

        .box {
            background-color: white;
            padding: 30px;
            margin: 20px 0;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .box h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1b3f6e;
        }

        .btn-primary {
            background-color: #1b3f6e;
            border-color: #1b3f6e;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #164569;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark1">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">Viskrit Placement Hub</a>
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
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Roadmap Content -->
    <div class="container">
        <div class="box">
            <h1>Frontend Developer Roadmap</h1>
            <a class="btn btn-primary" href="frontend_roadmap.php">View Roadmap</a>
        </div>
        <div class="box">
            <h1>Backend Developer Roadmap</h1>
            <a class="btn btn-primary" href="backend_roadmap.php">View Roadmap</a>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>