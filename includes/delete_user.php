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
    $sqlFetchUser = "SELECT `email`, `password` FROM `user` WHERE email = ?";
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
                $sqlRegister = "DELETE FROM `register` WHERE email = ?";
                $sqlUser = "DELETE FROM `user` WHERE email = ?";

                // Use prepared statements to prevent SQL injection
                $stmtRegister = mysqli_prepare($connection, $sqlRegister);
                $stmtUser = mysqli_prepare($connection, $sqlUser);

                if ($stmtRegister && $stmtUser) {
                    // Bind parameters and execute the statements
                    mysqli_stmt_bind_param($stmtRegister, 's', $emailToDelete);
                    mysqli_stmt_bind_param($stmtUser, 's', $emailToDelete);

                    // Execute delete statements
                    $resultRegister = mysqli_stmt_execute($stmtRegister);
                    $resultUser = mysqli_stmt_execute($stmtUser);

                    // Check deletion results
                    if ($resultRegister && $resultUser) {
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
        // Fetch user query preparation failed, handle error
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


