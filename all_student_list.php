<?php
// Start the session to check if the user is logged in
session_start();
require 'db.php'; // Your database connection file

// Redirect user to login page if not logged in
if ($_SESSION['logged_in'] == false) {
    header("Location: index.php");
}

// Fetch all students data from the `all_students_list` table
$query = "SELECT id, collegeid, first_name, last_name, number_of_companies_applied, department FROM all_students_list";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th {
            cursor: pointer;
        }

        .search-bar {
            border-radius: 12px;
            border: 1px solid gray;
            /* margin: 2rem;  */
            padding: 0.5rem;
        }

        @media (max-width: 767.98px) {
            .hide-mobile {
                display: none;
            }
        }
    </style>
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
                        <a class="nav-link" href="all_company_list.php">Company List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="department_list.php">Depatment List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-5">
        <h2 class="text-center ">All Students List </h2>
        <!-- Search bar and Add Student button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input class="me-2 search-bar" id="tableSearch" type="text" placeholder="Search...">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
        </div>
        <h2 class="text-center"></h2>
        <!-- Table displaying student data -->
        <table class="table table-bordered">
            <thead>
                <tr class="bg-secondary">
                    <th>Sr. No</th>
                    <th>College ID</th>
                    <th>First Name</th>
                    <th class="hide-mobile">Last Name</th>
                    <th class="hide-mobile">Number of Companies Applied</th>
                    <th class="hide-mobile">Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the result set and display each student's data
                $srNo = 1;
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $srNo++; ?></td>
                        <td><?php echo $row['collegeid']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td class="hide-mobile"><?php echo $row['last_name']; ?></td>
                        <td class="hide-mobile"><?php echo $row['number_of_companies_applied']; ?></td>
                        <td class="hide-mobile"><?php echo $row['department']; ?></td>
                        <td>
                            <!-- Button to trigger View Details modal -->
                            <button class="btn btn-primary view-details-btn" data-id="<?php echo $row['id']; ?>">View
                                Details</button>
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
                    <button type="button" class="btn btn-danger" id="delete-btn">Delete Student</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal to Add Student -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="mb-3">
                            <label for="collegeid" class="form-label">College ID</label>
                            <input type="text" class="form-control" id="collegeid" name="collegeid" required>
                        </div>
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
                                <option value="Artificial Intelligence & Data science">Artificial Intelligence & Data
                                    science</option>
                                <option value="Civil Engineering(CE)">Civil Engineering(CE)</option>
                                <option value="Computer Science & Engineering(CS)">Computer Science & Engineering(CS)
                                </option>
                                <option value="Electrical Engineering(EE)">Electrical Engineering(EE)</option>
                                <option value="Electronics and Telecommunication Engineering(ET)">Electronics and
                                    Telecommunication Engineering(ET)</option>
                                <option value="Mechanical Engineering(ME)">Mechanical Engineering(ME)</option>
                            </select>
                        </div>
                        <button type="submit" id-="add-student" class="btn btn-primary w-100">Add Student</button>
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
                    url: 'fetch_student_details.php',
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

                if (confirm('Are you sure you want to delete this student?')) {
                    // Make an AJAX request to delete the student
                    $.ajax({
                        url: 'delete_student.php',
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
                // Disable the submit button
                var submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);
                $.ajax({
                    url: 'add_student.php',
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
    <script>
        $(document).ready(function() {
            // Sort functionality for the table columns
            $('th').click(function() {
                var table = $(this).parents('table').eq(0); // Get the table element
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index())); // Sort rows based on the clicked column
                this.asc = !this.asc; // Toggle sorting order (ascending/descending)
                if (!this.asc) {
                    rows = rows.reverse(); // Reverse rows if descending
                }
                for (var i = 0; i < rows.length; i++) {
                    table.append(rows[i]); // Append sorted rows back to the table
                }
            });

            // Function to compare two table rows based on column value
            function comparer(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index), // Get value of the clicked column for row 'a'
                        valB = getCellValue(b, index); // Get value of the clicked column for row 'b'
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB); // Numeric or alphabetic comparison
                }
            }


            // Function to get the cell value of a row at a specific column index
            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text(); // Get the text content of the cell
            }
            
            
            // Search functionality to filter rows based on input
            $("#tableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase(); // Get the value entered in the search bar
                $("table tbody tr").filter(function() {
                    // Toggle visibility of rows based on whether the row text matches the search value
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
            
        });
    </script>
</body>

</html>