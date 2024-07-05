<?php
// Include database connection
include('../includes/dbcon.php');

// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle action to approve or decline
if(isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    // Validate action to prevent unauthorized actions
    if (!in_array($action, ['approve', 'decline'])) {
        die("Invalid action");
    }

    // Update status based on action using prepared statement
    $query = "UPDATE model_20 SET status = ? WHERE ordinary_number = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'si', ($action == 'approve' ? 'approved' : 'declined'), $id);
    $result = mysqli_stmt_execute($stmt);

    if(!$result) {
        die("Query Failed" . mysqli_error($connection));
    } else {
        // Set notification message in session
        $_SESSION['notification'] = 'Item status updated successfully.';
        // Redirect back to index.php or admin page after updating
        header('Location: ../request/index.php?success_msg=Item status updated successfully.');
        exit();
    }
}

// Close statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
