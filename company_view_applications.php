<?php
require 'db.php'; // Your database connection file
session_start();
if ($_SESSION['logged_in']) {

    $company_name = $_SESSION['company_name'];

    $query = "SELECT * FROM all_jobs_list WHERE company_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $company_name);
    $stmt->execute();
    $result = $stmt->get_result();


    $query = "SELECT * FROM job_applications WHERE company_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $company_name);
    $stmt->execute();
    $result1 = $stmt->get_result();

} else {
    echo $_SESSION['logged_in'];
    header('location:placement_officer_login.php');
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .navbar-custom {
            background-color: #007bff;
            /* Customize the navbar background color */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
            /* White text in navbar */
        }

        .navbar-custom .nav-link:hover {
            color: #ffdd57;
            /* Hover effect for navbar links */
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Company Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="placement_officer_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="company_view_applications.php">Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Company Dashboard Section -->
    <section id="company-dashboard" class="my-5">
        <div class="container">
            <h2 class="text-center mb-4">Company Dashboard</h2>
            <div class="row justify-content-center">
                <!-- Post Job Form -->
                <div class="col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Applications Received</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Job Role</th>
                                        <th>No. of Students Applied</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        $srNo = 1; // Initialize serial number
                                        while ($job_list = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $srNo++; ?></td> <!-- Increment serial number -->
                                                <td><?php echo $job_list['job_role']; ?></td>
                                                <td><?php echo $job_list['no_applicants']; ?></td>
                                                <td>
                                                    <form method="GET" action="company_view_job.php">
                                                        <input type="hidden" name="job_id"
                                                            value="<?php echo $job_list['job_id']; ?>">
                                                        <button type="submit" class="btn btn-outline-info btn-sm">View</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No jobs posted yet</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!-- Bootstrap JS (Optional if needed for interactivity like collapse) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>