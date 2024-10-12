<?php
session_start();
require 'db.php'; // Make sure to include your database connection file

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit;
}

// Initialize error and success messages
$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
        $username = $_SESSION['username']; // Assuming username is stored in session
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // Fetch the current password from the database
        $query = "SELECT password FROM all_students_list WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verify the old password
        // if (password_verify($old_password, $user['password'])) {
        if ($old_password == $user['password']) {
            // Hash the new password
            // $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the new password in the database
            $update_query = "UPDATE all_students_list SET password = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ss", $new_password, $username);

            if ($update_stmt->execute()) {
                $success = "Password changed successfully! <a href='student_profile.php'>Redirect to My Profile</a>";
            } else {
                $error = "Failed to update the password. Please try again.";
            }
        } else {
            $error = "The old password is incorrect!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
            <script>
                // Redirect to the profile page after 3 seconds
                setTimeout(function() {
                    window.location.href = 'student_profile.php';
                }, 1500);
            </script>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
            <script>
                // Redirect to the profile page after 3 seconds
                setTimeout(function() {
                    window.location.href = 'student_profile.php';
                }, 1500);
            </script>
        </div>
    <?php endif; ?>
    
    <form action="change_password.php" method="POST">
        <div class="form-group mb-3">
            <label for="old_password">Old Password:</label>
            <input type="password" class="form-control" name="old_password" id="old_password" required placeholder="Enter your old password">
        </div>

        <div class="form-group mb-3">
            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" name="new_password" id="new_password" required placeholder="Enter your new password">
        </div>
        
        <button type="submit" class="btn btn-danger w-100"><i class="fas fa-key"></i> Change Password</button>
    </form>
</div>
</body>
</html>
