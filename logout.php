<?php
// Start the session
session_start();

// Unset all session variables
// $_SESSION = [];

// If it's desired to kill the session, also delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Destroy the session
// $_SESSION['admin_logged_in'] = false; // Set session for admin login
$_SESSION['logged_in'] = false;
// $_SESSION['username'] = "x"; // Set session for admin login
session_destroy();
// Redirect to the login page or home page
header("Location: index.php"); // Change to your desired page
exit();
?>
