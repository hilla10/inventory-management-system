<?php
// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php?error_msg=Please login to access this page");
    exit();
}

// Define session timeout duration in seconds (3 hours)
$sessionTimeoutSeconds = 7200; // 3 hours = 3 * 60 * 60

// Check if last activity time is set in session
if (isset($_SESSION['last_activity'])) {
    // Calculate time difference since last activity
    $currentTime = time();
    $lastActivityTime = $_SESSION['last_activity'];
    $timeSinceLastActivity = $currentTime - $lastActivityTime;

    // Check if timeout duration has passed
    if ($timeSinceLastActivity > $sessionTimeoutSeconds) {
        // Session expired, destroy session and redirect to login page
        session_unset();
        session_destroy();
        header('Location: ../index.php?error_msg=Session expired due to inactivity. Please login again.');
        exit();
    }
}

// Update last activity time in session to current time
$_SESSION['last_activity'] = time();

// Continue with your existing code for processing authenticated actions
// Include database connection and other required includes
include("dbcon.php");

// Example of updating last visit time in the database
// Note: You should sanitize and validate user inputs before using them in queries
if (isset($_SESSION['email']) || isset($_SESSION['username'])) {
    $identifier = isset($_SESSION['email']) ? $_SESSION['email'] : $_SESSION['username'];
    $updateVisitQuery = "UPDATE users SET last_visit = NOW() WHERE email = ? OR username = ?";
    $updateVisitStmt = mysqli_prepare($connection, $updateVisitQuery);
    mysqli_stmt_bind_param($updateVisitStmt, "ss", $identifier, $identifier);
    mysqli_stmt_execute($updateVisitStmt);
}


?>
