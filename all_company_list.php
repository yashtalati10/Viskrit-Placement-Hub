<?php
require 'db.php'; // Include the database connection file
session_start(); // Start the session to access session variables

// Check if the user is logged in; if not, redirect to the login page
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}

// Fetch all companies data from the `all_companies_list` table
$query = "SELECT id, company_name, number_of_students_applied, city, username FROM all_companies_list";
$result = $conn->query($query); // Execute the query and get the result set

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Viskrit Placement Hub</a>
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
                        <a class="nav-link" href="department_list.php">Department List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-5">
        <h2 class="text-center">Company List </h2>
        <div class="d-flex justify-content-between mb-3">
            <div></div> <!-- Placeholder for alignment -->
            <a href="add_company.php" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCompanyModal">Add New Company</a>
        </div>
        <h2 class="text-center">
        </h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Company Name</th>
                    <th>Number of Students Applied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $srNo = 1; // Initialize serial number for each company
                while ($row = $result->fetch_assoc()) { // Loop through each row of the result
                    ?>
                    <tr>
                        <td><?php echo $srNo++; ?></td> <!-- Display the serial number -->
                        <td><?php echo $row['company_name']; ?></td> <!-- Display the company name -->
                        <td><?php echo $row['number_of_students_applied']; ?></td> <!-- Display number of students applied -->
                        <td>
                            <form method="GET" action="view_company_profile.php"> <!-- Form to view company profile -->
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- Hidden input to store company ID -->
                                <button type="submit" class="btn btn-primary" data-id="<?php echo $row['id']; ?>">View</button>
                            </form>
                        </td>
                        <!-- <td>
                            <form method="POST" action="delete_company.php" onsubmit="return confirmDelete()">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </td> -->
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal to show student details -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Student details will be shown here -->
                    <div id="student-details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-danger" id="delete-btn">Delete Student</button> -->
                </div>
            </div>
        </div>
    </div>

<!-- Modal for adding a new company -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add New Job Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCompanyForm">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City</label>
                                <select name="city" id="city" class="form-control" required>
                                    <option value="">--Please choose a city--</option>
                                    <option value="Nagpur">Nagpur</option>
                                    <option value="Pune">Pune</option>
                                    <option value="Mumbai">Mumbai</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Chennai">Chennai</option>
                                    <option value="Bengaluru">Bengaluru</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label">State</label>
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">--Please choose a state--</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Telangana">Telangana</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        // Function to confirm deletion
        function confirmDelete() {
            return confirm("Are you sure you want to delete this company?");
        }
    </script>
    <!-- Add Bootstrap and jQuery for handling modal -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 College Job Portal. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // When 'View Details' button is clicked
            $('.view-details-btn').click(function () {
                var companyId = $(this).data('id'); // Get student ID from button data attribute


                // Make an AJAX request to fetch additional student details
                $.ajax({
                    url: 'fetch_company_details.php',
                    type: 'POST',
                    data: {
                        id: companyId
                    },
                    success: function (data) {
                        // Insert student details into the modal
                        $('#student-details').html(data);

                        // Show the modal
                        $('#studentModal').modal('show');
                    }
                });

                // Set the delete button with the student ID
                $('#delete-btn').data('id', companyId);
            });

            // When 'Delete Company' button is clicked
            // $('#delete-btn').click(function () {
            //     var companyId = $(this).data('id'); // Get student ID

            //     if (confirm('Are you sure you want to delete this student?')) {
            //         // Make an AJAX request to delete the student
            //         $.ajax({
            //             url: 'delete_company.php',
            //             type: 'POST',
            //             data: {
            //                 id: companyId
            //             },
            //             success: function (response) {
            //                 alert(response); // Show delete message
            //                 location.reload(); // Reload the page to reflect changes
            //             }
            //         });
            //     }
            // });
            // Add student form submission
            $('#addCompanyForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: 'add_company.php',
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
</body>

</html>