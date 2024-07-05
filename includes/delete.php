<?php
// Include the database connection
include('dbcon.php');

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Check if 'ordinary_number' and 'department' parameters are set in the URL
if (isset($_GET['ordinary_number']) && isset($_GET['department'])) {
    $ordinary_number = $_GET['ordinary_number'];
    $department = $_GET['department'];

    // Fetch the details of the record to be deleted (optional but recommended)
    $query_fetch = "SELECT * FROM `inventory` WHERE `ordinary_number` = ? AND `department` = ?";
    $stmt_fetch = mysqli_prepare($connection, $query_fetch);
    
    if ($stmt_fetch) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt_fetch, 'ss', $ordinary_number, $department);
        mysqli_stmt_execute($stmt_fetch);
        
        // Get result set
        $result_fetch = mysqli_stmt_get_result($stmt_fetch);
        
        // Get the record details
        $deleted_record = '';
        if ($row = mysqli_fetch_assoc($result_fetch)) {
            $deleted_record = ' (Ordinary Number: ' . $row['ordinary_number'] . ', Inventory List: ' . $row['inventory_list'] . ')';
        }
        
        // Close the statement
        mysqli_stmt_close($stmt_fetch);
    } else {
        // Query preparation failed, handle error
        $error_msg = 'Query preparation failed: ' . mysqli_error($connection);
        redirectWithError($error_msg);
    }

    // Prepare the SQL statement for deletion
    $query = "DELETE FROM `inventory` WHERE `ordinary_number` = ? AND `department` = ?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, 'ss', $ordinary_number, $department);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Successful deletion
            $delete_msg = 'You have deleted the record' . $deleted_record;
            redirectWithMessage($delete_msg, 'delete_msg');
        } else {
            // Deletion failed, handle error
            $error_msg = 'Deletion failed: ' . mysqli_stmt_error($stmt);
            redirectWithError($error_msg);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Query preparation failed, handle error
        $error_msg = 'Query preparation failed: ' . mysqli_error($connection);
        redirectWithError($error_msg);
    }
} else {
    // Required parameters are missing
    $error_msg = 'Required parameters are missing.';
    redirectWithError($error_msg);
}

// Function to redirect with error message
function redirectWithError($error_msg) {
    global $currentPage;
    $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($error_msg);
    header('Location: ' . $redirectUrl);
    exit;
}

// Function to redirect with success message
function redirectWithMessage($message, $messageType) {
    global $currentPage;
    $redirectUrl = '../' . $currentPage . '?' . $messageType . '=' . urlencode($message);
    header('Location: ' . $redirectUrl);
    exit;
}

// Close the database connection
mysqli_close($connection);
exit;
?>
