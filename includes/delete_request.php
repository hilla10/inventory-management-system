<?php
// Include the database connection
include('dbcon.php');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the details of the record to be deleted (optional but recommended)
    $query_fetch = "SELECT * FROM `model_20` WHERE `ordinary_number` = ? ";
    $stmt_fetch = mysqli_prepare($connection, $query_fetch);
    mysqli_stmt_bind_param($stmt_fetch, 's', $id);
    mysqli_stmt_execute($stmt_fetch);
    $result_fetch = mysqli_stmt_get_result($stmt_fetch);
    
    // Get the record details
    $deleted_record = '';
    if ($row = mysqli_fetch_assoc($result_fetch)) {
        $deleted_record = ' (Ordinary Number: ' . $row['ordinary_number'].')';
    }

    // Prepare the SQL statement to prevent SQL injection
    $query = "DELETE FROM `model_20` WHERE `ordinary_number` = ?"; 
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, 's', $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Successful deletion
            $delete_msg = 'You have deleted the record' . $deleted_record;
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
