<?php
require 'db.php'; // Include the database connection file
session_start(); // Start a new session or resume the existing one

// Check if the user is logged in; if not, redirect to the login page
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}

// Fetch all students data from the department_details table
$query = "SELECT * FROM department_details"; // Query to select all department details
$result = $conn->query($query); // Execute the query and store the result

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Viskrit Placement Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-5">
        <h2 class="text-center">Admin Department List </h2>
        <div class="d-flex justify-content-between mb-3">
            <div></div> <!-- Placeholder for alignment -->
            <!-- <a href="add_company.php" class="btn btn-success">Add New Company</a> -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Department Admin</button>
        </div>
        <h2 class="text-center"></h2>

        <table class="table table-bordered">
            <thead>
            <tr>
                    <th>Sr. No</th> <!-- Serial number -->
                    <th>First Name</th> <!-- First name of the department admin -->
                    <th>Last Name</th> <!-- Last name of the department admin -->
                    <th>Department</th> <!-- Department name -->
                    <th>Actions</th> <!-- Action buttons -->
                </tr>
            </thead>
            <tbody>
                <?php
                $srNo = 1; // Initialize serial number
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $srNo++; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td>
                            <button class="btn btn-primary view-details-btn" data-id="<?php echo $row['id']; ?>">View Details</button>
                        </td>
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
                    <button type="button" class="btn btn-danger" id="delete-btn">Delete Department Admin</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal to Add Student -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div> -->

                        <div class="mb-3">
                            <label for="department" class="form-label">Department:</label>
                            <select name="department" id="department" class="form-control" required>
                                <option value="">--Please choose an department--</option>
                                <option value="Science & Humanities">Science & Humanities</option>
                                <option value="Artificial Intelligence & Data science">Artificial Intelligence & Data science</option>
                                <option value="Civil Engineering(CE)">Civil Engineering(CE)</option>
                                <option value="Computer Science & Engineering(CS)">Computer Science & Engineering(CS)</option>
                                <option value="Electrical Engineering(EE)">Electrical Engineering(EE)</option>
                                <option value="Electronics and Telecommunication Engineering(ET)">Electronics and Telecommunication Engineering(ET)</option>
                                <option value="Mechanical Engineering(ME)">Mechanical Engineering(ME)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Department Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Add Bootstrap and jQuery for handling modal -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 College Job Portal. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // When 'View Details' button is clicked
            $('.view-details-btn').click(function() {
                var studentId = $(this).data('id'); // Get student ID from button data attribute

                // Make an AJAX request to fetch additional student details
                $.ajax({
                    url: 'fetch_department_details.php',
                    type: 'POST',
                    data: {
                        id: studentId
                    },
                    success: function(data) {
                        // Insert student details into the modal
                        $('#student-details').html(data);

                        // Show the modal
                        $('#studentModal').modal('show');
                    }
                });

                // Set the delete button with the student ID
                $('#delete-btn').data('id', studentId);
            });

            // When 'Delete Student' button is clicked
            $('#delete-btn').click(function() {
                var studentId = $(this).data('id'); // Get student ID

                if (confirm('Are you sure you want to delete this Department Admin?')) {
                    // Make an AJAX request to delete the student
                    $.ajax({
                        url: 'delete_admin_department.php',
                        type: 'POST',
                        data: {
                            id: studentId
                        },
                        success: function(response) {
                            alert(response); // Show delete message
                            location.reload(); // Reload the page to reflect changes
                        }
                    });
                }
            });
            // Add student form submission
            $('#addStudentForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'add_admin_department.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response); // Show success message
                        location.reload(); // Reload the page to show the new student
                    }
                });
            });
        });
    </script>
</body>

</html>