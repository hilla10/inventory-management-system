<?php
// Include database connection
include('../includes/dbcon.php');

// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle action to approve or decline
if (isset($_GET['action'], $_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    // Validate action to prevent unintended modifications
    if (!in_array($action, ['approve', 'decline'])) {
        die("Invalid action.");
    }

    // Prepare the query using parameterized statement to prevent SQL injection
    $query = "UPDATE model_19 SET `status` = ? WHERE `ordinary_number` = ?";
    $stmt = mysqli_prepare($connection, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'si', $action === 'approve' ? 'approved' : 'declined', $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check for errors
    if (mysqli_stmt_errno($stmt)) {
        die("Query Failed: " . mysqli_stmt_error($stmt));
    }

    // Set notification message in session
    $_SESSION['notification'] = 'Item status updated successfully.';

    // Redirect back to index.php or admin page after updating
    header('Location: index.php');
    exit();
}

// Close statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
