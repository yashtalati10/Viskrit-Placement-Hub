<?php

session_start();
if ($_SESSION['logged_in'] == false) {
  header("Location: index.php");
}
// if($_SESSION['logged_in'] == false) {
//   header("Location: index.php");
// }
?>

<?php
require 'db.php'; // Your database connection file

// Fetch all students data from the all_students_list table
$query = "SELECT a.id, a.collegeid, a.first_name, a.last_name, a.number_of_companies_applied, a.department FROM all_students_list as a join department_details as d on a.department = d.department";
$result = $conn->query($query);
$result1 = $conn->query($query);
$row1 = $result1->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th{
            cursor: pointer;
        }
        .search-bar{
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
            <a class="navbar-brand" href="index.php">ACET Job Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h2 class="text-center">All Students List</h2>
        <h3 class="text-center"><?php echo $row1['department']; ?></h3>
        <input class="me-2 search-bar" id="tableSearch" type="text" placeholder="Search...">

            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>College ID</th>
                        <th>First Name</th>
                        <th class="hide-mobile">Last Name</th>
                        <th class="hide-mobile">Number of Companies Applied</th>
                        <!-- <th>Department</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

        <?php
        $srNo = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $srNo++; ?></td>
                        <td><?php echo $row['collegeid']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td class="hide-mobile"><?php echo $row['last_name']; ?></td>
                        <td class="hide-mobile"><?php echo $row['number_of_companies_applied']; ?></td>
                        <!-- <td></td> -->
                        <td>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 College Job Portal. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            // When 'View Details' button is clicked
            $('.view-details-btn').click(function () {
                var studentId = $(this).data('id'); // Get student ID from button data attribute

                // Make an AJAX request to fetch additional student details
                $.ajax({
                    url: 'fetch_student_details.php',
                    type: 'POST',
                    data: {
                        id: studentId
                    },
                    success: function (data) {
                        // Insert student details into the modal
                        $('#student-details').html(data);

                        // Show the modal
                        $('#studentModal').modal('show');
                    }
                });
            });
        });
    </script>
<script>
        $(document).ready(function () {
            // Sort functionality
            $('th').click(function () {
                var table = $(this).parents('table').eq(0)
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
                this.asc = !this.asc
                if (!this.asc) { rows = rows.reverse() }
                for (var i = 0; i < rows.length; i++) { table.append(rows[i]) }
            })

            function comparer(index) {
                return function (a, b) {
                    var valA = getCellValue(a, index), valB = getCellValue(b, index)
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
                }
            }

            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text()
            }

            // Search functionality
            $("#tableSearch").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>