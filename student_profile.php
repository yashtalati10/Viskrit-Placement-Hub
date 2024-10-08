<?php
require 'db.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM all_students_list where username='$username'");
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if ($row['resume_file_path'] == '') {
        $buttonDisabled = true;
    }
    if ($row['resume_file_path'] != '') {
        $buttonDisabled = false;
    }
}
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="student_my_applications.php">My Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="available_jobs.php">Available Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="profile-container bg-light p-4 rounded shadow-lg">
                <h1 class="text-center mb-4">Student Profile</h1>

                <!-- Profile Information -->
                <div class="profile-info card p-3 shadow-sm mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-user"></i> <strong>Username:</strong> <?php echo $row['username']; ?></p>
                            <p><i class="fas fa-id-badge"></i> <strong>First Name:</strong> <?php echo strtoupper($row['first_name']); ?></p>
                            <p><i class="fas fa-id-badge"></i> <strong>Last Name:</strong> <?php echo strtoupper($row['last_name']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-building"></i> <strong>Department:</strong> <?php echo $row['department']; ?></p>
                            <p><i class="fas fa-phone"></i> <strong>Mobile:</strong> <?php echo $row['mobile']; ?></p>
                            <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <?php echo $row['email']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Update Mobile and Email Form -->
                <div class="card p-3 shadow-sm mb-4">
                    <h3><i class="fas fa-edit"></i> Update Contact Info</h3>
                    <form action="update_profile.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="mobile">Mobile:</label>
                            <input type="text" class="form-control" name="mobile" id="mobile"
                                value="<?php echo $row['mobile']; ?>" required placeholder="Enter your new mobile number">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="<?php echo $row['email']; ?>" required placeholder="Enter your new email">
                        </div>
                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-save"></i> Update Info</button>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div class="card p-3 shadow-sm mb-4">
                    <h3><i class="fas fa-lock"></i> Change Password</h3>
                    <form action="change_password.php" method="POST">
                        <button type="submit" class="btn btn-danger w-100"><i class="fas fa-key"></i> Change Password</button>
                    </form>
                </div>

                <!-- Upload Resume Form -->
                <?php if ($row['resume_file_path'] == '') : ?>
                <div class="card p-3 shadow-sm mb-4">
                    <h3><i class="fas fa-upload"></i> Upload Resume</h3>
                    <form action="upload_resume.php" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="pdf">Upload Resume (PDF):</label>
                            <input type="file" name="pdf" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-file-upload"></i> Upload Resume</button>
                    </form>
                </div>
                <?php endif; ?>

                <!-- Show Resume Section -->
                <?php if ($row['resume_file_path'] != '') : ?>
                <div class="card p-3 shadow-sm mb-4">
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo $row['resume_file_path']; ?>" target="_blank" class="btn btn-info w-45">
                            <i class="fas fa-file-alt"></i> View Resume
                        </a>
                        <a href="delete_resume.php?username=<?php echo $row['username']; ?>" class="btn btn-danger w-45"
                            onclick="return confirm('Are you sure you want to delete your resume?')">
                            <i class="fas fa-trash-alt"></i> Delete Resume
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .w-45 {
        width: 48%;
    }
    .profile-container {
        max-width: 800px;
        margin: auto;
        background: #f8f9fa;
    }
    .card {
        border-radius: 15px;
    }
    .btn {
        border-radius: 50px;
        transition: background 0.3s ease;
    }
    .btn:hover {
        opacity: 0.9;
    }
    .btn-info:hover {
        background-color: #117a8b;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
</style>


    

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Pass the PHP variable directly as a JavaScript boolean
        var buttonDisabled = <?php echo $buttonDisabled ? 'true' : 'false'; ?>;

        if (buttonDisabled) {
            document.getElementById('open_btn').style.display = 'none';
            document.getElementById('update_btn').style.display = 'none';
            document.getElementById('delete_btn').style.display = 'none';
        } else {
            document.getElementById('upload_form').style.display = 'none';
            document.getElementById('open_btn').style.display = 'block';
            document.getElementById('update_btn').style.display = 'block';
            document.getElementById('delete_btn').style.display = 'block';
        }

        document.getElementById('update_btn').addEventListener('click', () => {
            document.getElementById('upload_form').style.display = 'block';
            document.getElementById('open_btn').style.display = 'none';
            document.getElementById('update_btn').style.display = 'none';
            document.getElementById('delete_btn').style.display = 'none';

        })


    </script>


</body>

</html>