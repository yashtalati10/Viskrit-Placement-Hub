<?php
require 'db.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM all_students_list where username='$username'");
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Student Profile</title>
            <!-- Bootstrap CSS -->
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    background-color: #f4f4f4;
                }

                .profile-container {
                    background-color: #fff;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    margin-top: 50px;
                }

                .profile-container h1 {
                    color: #333;
                }

                .profile-info {
                    margin-top: 20px;
                }

                .profile-info p {
                    font-size: 18px;
                    color: #555;
                }

                .profile-info span {
                    font-weight: bold;
                    color: #333;
                }
            </style>
        </head>

        <body>

            <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">ACET Job Portal</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav ms-auto ">
                            <li class="nav-item">
                                <a class="nav-link" href="#login"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="student_dashboard.php">Home</a>
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

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <div class="profile-container text-center">
                            <h1>Student Profile</h1>
                            <div class="profile-info text-left">
                                <p><span>First Name:</span> <?php echo $row['first_name']; ?></p>
                                <p><span>Last Name:</span>
                                    <?php echo $row['last_name']; ?>
                                </p>
                                <p><span>Department:</span>
                                    <?php echo $row['department']; ?>
                                </p>
                                <!-- <p><span>Jobs Applied For:</span> <php echo $row['']; ?></p> -->
                                <p><span>Username:</span>
                                    <?php echo $row['username']; ?></p>
                                
                                    <form class="upload-form" action="upload_resume.php" method="POST" enctype="multipart/form-data">
                                        <input type="file" name="resume" required />
                                        <button type="submit" class="upload-btn">Upload Resume</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
    }
}
    ?>

        </body>

        </html>