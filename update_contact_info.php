<?php
session_start();
require 'db.php'; // Assuming this file contains the connection to the database

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
    header("Location: index.php");
    exit;
}

// Define an empty error variable
$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the new mobile number from the form
    $new_mobile = trim($_POST['mobile']);
    $username = $_SESSION['username']; // Assuming the username is stored in session

    // Validate the mobile number (example: checking if it's numeric and length of 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $new_mobile)) {
        $error = 'Invalid mobile number. Please enter a valid 10-digit number.';
    } else {
        // Update query using prepared statement to prevent SQL injection
        $query = "UPDATE all_students_list SET mobile = ? WHERE username = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param('ss', $new_mobile, $username);

            // Execute the query
            if ($stmt->execute()) {
                // Check if the update was successful
                if ($stmt->affected_rows > 0) {
                    $success = 'Your mobile number has been successfully updated.';
                } else {
                    $error = 'No changes were made to your mobile number.';
                }
            } else {
                $error = 'An error occurred while updating your information. Please try again.';
            }

            // Close the statement
            $stmt->close();
        } else {
            $error = 'Failed to prepare the database query.';
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Update Contact Information</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>

            <script>
                // Automatically redirect to student_profile.php after 3 seconds (3000 milliseconds)
                setTimeout(function () {
                    window.location.href = 'student_profile.php';
                }, 2000);
            </script>
        <?php endif; ?>

        <form action="update_contact_info.php" method="POST">
            <div class="form-group mb-3">
                <label for="mobile">Mobile:</label>
                <input type="text" class="form-control" name="mobile" id="mobile"
                    value="<?php echo isset($new_mobile) ? htmlspecialchars($new_mobile) : ''; ?>" required
                    placeholder="Enter your new mobile number">
            </div>

            <button type="submit" class="btn btn-success w-100"><i class="fas fa-save"></i> Update Info</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>