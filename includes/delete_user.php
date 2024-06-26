<?php


session_start();

// Include database connection and authentication check
include('dbcon.php');
include("auth.php");

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Set the desired current page URL
$_SESSION['currentPage'] = 'admin/index.php'; // Update this to the desired URL

if (isset($_POST['delete_user'])) {
    $emailToDelete = $_POST['email'];
    $passwordToDelete = $_POST['password'];

    // Query to fetch hashed password from database based on email
    $sqlFetchUser = "SELECT `email`, `password` FROM users WHERE email = ?";
    $stmtFetchUser = mysqli_prepare($connection, $sqlFetchUser);

    if ($stmtFetchUser) {
        // Bind parameter and execute statement
        mysqli_stmt_bind_param($stmtFetchUser, 's', $emailToDelete);
        mysqli_stmt_execute($stmtFetchUser);
        
        // Bind result variables
        mysqli_stmt_bind_result($stmtFetchUser, $fetchedEmail, $hashedPassword);
        
        // Fetch the result
        mysqli_stmt_fetch($stmtFetchUser);
        
        // Close statement and free result set
        mysqli_stmt_close($stmtFetchUser);
        
        // Check if email exists
        if (!empty($fetchedEmail)) {
            // Verify password
            if (password_verify($passwordToDelete, $hashedPassword)) {
                // Passwords match, proceed with deletion
                $sqlUsers = "DELETE FROM users WHERE email = ?";
                // Use prepared statements to prevent SQL injection
                $stmtUsers = mysqli_prepare($connection, $sqlUsers);

                if ($stmtUsers) {
                    // Bind parameters and execute the statements
                    mysqli_stmt_bind_param($stmtUsers, 's', $emailToDelete);

                    // Execute delete statements
                    $resultUsers = mysqli_stmt_execute($stmtUsers);
                    // Check deletion results
                    if ($resultUsers) {
                        // Successful deletion
                        $delete_msg = 'You have deleted the record with email: ' . $emailToDelete;
                        $redirectUrl = '../' . $_SESSION['currentPage'] . '?delete_msg=' . urlencode($delete_msg);
                        header('Location: ' . $redirectUrl);
                        exit;
                    } else {
                        // Deletion failed, handle error
                        $error_msg = 'Deletion failed: ' . mysqli_error($connection);
                        $redirectUrl = '../' . $_SESSION['currentPage'] . '?error_msg=' . urlencode($error_msg);
                        header('Location: ' . $redirectUrl);
                        exit;
                    }
                } else {
                    // Query preparation failed, handle error
                    $error_msg = 'Query preparation failed: ' . mysqli_error($connection);
                    $redirectUrl = '../' . $_SESSION['currentPage'] . '?error_msg=' . urlencode($error_msg);
                    header('Location: ' . $redirectUrl);
                    exit;
                }
            } else {
                // Passwords do not match, redirect back with error message
                $redirectUrl = '../' . $_SESSION['currentPage'] . '?error_msg=Incorrect email or password.';
                header('Location: ' . $redirectUrl);
                exit;
            }
        } else {
            // Email not found, redirect back with error message
            $redirectUrl = '../' . $_SESSION['currentPage'] . '?error_msg=Incorrect email or password.' ;
            header('Location: ' . $redirectUrl);
            exit;
        }
    } else {
        // Fetch users query preparation failed, handle error
        $error_msg = 'User fetch query preparation failed: ' . mysqli_error($connection);
        $redirectUrl = '../' . $_SESSION['currentPage'] . '?error_msg=' . urlencode($error_msg);
        header('Location: ' . $redirectUrl);
        exit;
    }
} else {
    // Delete confirmation not set, redirect back
    $redirectUrl = '../' . $_SESSION['currentPage'] . '?error_msg=Delete confirmation not set.';
    header('Location: ' . $redirectUrl);
    exit;
}
?>


