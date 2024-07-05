<?php
session_start();

// Include database connection and authentication check
include('dbcon.php');
include('auth.php'); // Assuming this file handles authentication

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Set the desired current page URL (adjust as needed)
$_SESSION['currentPage'] = 'admin/index.php';

if (isset($_POST['delete_user'])) {
    $emailOrUsername = $_POST['email_or_username'];
    $passwordToDelete = $_POST['password'];

    // Determine if the input is an email or username
    if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
        $identifierField = 'email';
    } else {
        $identifierField = 'username';
    }

    // Query to fetch hashed password from database based on email or username
    $sqlFetchUser = "SELECT `email`, `password` FROM users WHERE $identifierField = ?";
    $stmtFetchUser = mysqli_prepare($connection, $sqlFetchUser);

    if ($stmtFetchUser) {
        // Bind parameter and execute statement
        mysqli_stmt_bind_param($stmtFetchUser, 's', $emailOrUsername);
        mysqli_stmt_execute($stmtFetchUser);

        // Bind result variables
        mysqli_stmt_bind_result($stmtFetchUser, $fetchedEmail, $hashedPassword);

        // Fetch the result
        mysqli_stmt_fetch($stmtFetchUser);

        // Close statement after fetching results
        mysqli_stmt_close($stmtFetchUser);

        // Check if email or username exists
        if (!empty($fetchedEmail)) {
            // Verify password
            if (password_verify($passwordToDelete, $hashedPassword)) {
                // Passwords match, proceed with deletion
                $sqlDeleteUser = "DELETE FROM users WHERE $identifierField = ?";
                $stmtDeleteUser = mysqli_prepare($connection, $sqlDeleteUser);

                if ($stmtDeleteUser) {
                    // Bind parameters and execute the statement
                    mysqli_stmt_bind_param($stmtDeleteUser, 's', $emailOrUsername);
                    $resultDeleteUser = mysqli_stmt_execute($stmtDeleteUser);

                    if ($resultDeleteUser) {
                        // Successful deletion
                        $delete_msg = 'You have deleted the record with ' . $identifierField . ': ' . $emailOrUsername;
                        redirectWithMessage($delete_msg, 'delete_msg');
                    } else {
                        // Deletion failed, handle error
                        $error_msg = 'Deletion failed: ' . mysqli_error($connection);
                        redirectWithMessage($error_msg, 'error_msg');
                    }

                    // Close statement
                    mysqli_stmt_close($stmtDeleteUser);
                } else {
                    // Query preparation failed, handle error
                    $error_msg = 'Query preparation failed: ' . mysqli_error($connection);
                    redirectWithMessage($error_msg, 'error_msg');
                }
            } else {
                // Passwords do not match, redirect back with error message
                redirectWithMessage('Incorrect password for ' . $identifierField, 'error_msg');
            }
        } else {
            // Email or username not found, redirect back with error message
            redirectWithMessage('User with ' . $identifierField . ' not found', 'error_msg');
        }
    } else {
        // Fetch users query preparation failed, handle error
        $error_msg = 'User fetch query preparation failed: ' . mysqli_error($connection);
        redirectWithMessage($error_msg, 'error_msg');
    }
} else {
    // Delete confirmation not set, redirect back with error message
    redirectWithMessage('Delete confirmation not set.', 'error_msg');
}

// Function to redirect with message
function redirectWithMessage($message, $messageType) {
    global $currentPage;
    $redirectUrl = '../' . $currentPage . '?' . $messageType . '=' . urlencode($message);
    header('Location: ' . $redirectUrl);
    exit;
}
?>
