<?php
// Include the database connection
include('dbcon.php');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

if (isset($_GET['ordinary-number']) && isset($_GET['department'])) {
    $ordinary_number = $_GET['ordinary-number'];
    $department = $_GET['department'];

    // Prepare the SQL statement to prevent SQL injection
    $query = "DELETE FROM `inventory` WHERE `ordinary-number` = ? AND `department` = ?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, 'ss', $ordinary_number, $department);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Successful deletion
            $delete_msg = 'You have deleted the record';
            $redirectUrl = '../' . $currentPage . '?delete_msg=' . urlencode($delete_msg);
            header('Location: ' . $redirectUrl);
            exit;
        } else {
            // Deletion failed, handle error
            $error_msg = 'Deletion failed: ' . mysqli_stmt_error($stmt);
            $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($error_msg);
            header('Location: ' . $redirectUrl);
            exit;
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Query preparation failed, handle error
        $error_msg = 'Query preparation failed: ' . mysqli_error($connection);
        $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($error_msg);
        header('Location: ' . $redirectUrl);
        exit;
    }
} else {
    // Required parameters are missing
    $error_msg = 'Required parameters are missing.';
    $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($error_msg);
    header('Location: ' . $redirectUrl);
    exit;
}

// Close the database connection
mysqli_close($connection);
exit;
?>
