<?php
require 'db.php'; // Your database connection file
session_start();

if (isset($_GET['id'])) {
    $company_id = $_GET['id'];

    // Fetch company details based on the ID
    $query = "SELECT * FROM all_companies_list WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $company_id);
    $stmt->execute();
    $result = $stmt->get_result();




    if ($result->num_rows > 0) {
        $company = $result->fetch_assoc();
        $company_name1 = $company['company_name'];
        $query1 = "SELECT * FROM all_jobs_list WHERE company_name = ?";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param('s', $company_name1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $_SESSION['company_name'] = $company['company_name'];
        $_SESSION['c_id'] = $company['id'];
        
        
    } else {
        echo "Company not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company['company_name']; ?> - Company Profile</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#login"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_student_list.php">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_company_list.php">Company List</a>
                    </li>
                    <li class="nav-item">

                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addJobModal">Post New
                            Job</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-5">
        <h1 class="text-center"><?php echo $company['company_name']; ?> - Profile</h1>
        <div class="card mt-4">
            <div class="card-header">
                Company Details
            </div>
            <div class="card-body">
                <p><strong>Company Name:</strong> <?php echo $company['company_name']; ?></p>
                <p><strong>Address:</strong> <?php echo $company['city'] . ", " . $company['state']; ?></p>
                <p><strong>Number of Students Applied:</strong> <?php echo $company['number_of_students_applied']; ?>
                </p>
                <p><strong>Username:</strong> <?php echo $company['username']; ?></p>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <h1 class="text-center">Posted Jobs</h1>

        <!-- Job Table -->
        <table class="table table-bordered table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. No</th>
                    <th>Job Role</th>
                    <th>Number of Students Applied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result1->num_rows > 0) {
                    $srNo = 1; // Initialize serial number
                    while ($job = $result1->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $srNo++; ?></td> <!-- Increment serial number -->
                            <td><?php echo $job['job_role']; ?></td>
                            <td><?php echo $job['no_applicants']; ?></td>
                            <td>

                                <form method="GET" action="view_job.php">
                                    <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                                    <button type="submit" class="btn btn-info">View</button>
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


    <div class="modal fade" id="addJobModal" tabindex="-1" aria-labelledby="addJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJobModalLabel">Add New Job Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_job.php" method="POST">
                        <!-- <form id="addJobForm"> -->
                        <div class="mb-3">
                            <label for="job-role" class="form-label">Job Role</label>
                            <input type="text" class="form-control" id="job-role" name="job-role" required>
                        </div>

                        <div class="mb-3">
                            <label for="job-description" class="form-label">Job Description</label>
                            <input type="text" class="form-control" id="job-description" name="job-description"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="skills-req" class="form-label">Skills Required</label>
                            <input type="text" class="form-control" id="skills-req" name="skills-req" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="no-of-openings" class="form-label">Number of Openings</label>
                                <input type="text" class="form-control" id="no-of-openings" name="no-of-openings"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expected-salary" class="form-label">Expected Salary</label>
                                <select name="expected-salary" id="expected-salary" class="form-control" required>
                                    <option value="">--Please choose a expected salary--</option>
                                    <option value="0 - 3 LPA">0 - 3 LPA</option>
                                    <option value="3 - 6 LPA">3 - 6 LPA</option>
                                    <option value="6 - 9 LPA">6 - 9 LPA</option>
                                    <option value="9 - 12 LPA">9 - 12 LPA</option>
                                    <option value="12 - 15 LPA">12 - 15 LPA</option>
                                </select>
                                <!-- <input type="text" class="form-control" id="expected-salary" name="expected-salary" required> -->
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="job-type" class="form-label">Job Type</label>
                                <select name="job-type" id="job-type" class="form-control" required>
                                    <option value="">--Please choose a job type--</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Virtual Internship">Virtual Internship</option>
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            // Add student form submission
            $('#addJobForm').submit(function (e) {
                e.preventDefault();


                $.ajax({

                    url: 'add_job.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert(response); // Show success message
                        location.reload(); // Reload the page to show the new student
                    }

                });
            });
        });
    </script>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>