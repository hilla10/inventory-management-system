<?php
include("../includes/dbcon.php");
session_start();

if (isset($_POST['login'])) {
    $usernameOrEmail = mysqli_real_escape_string($connection, $_POST['username_or_email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $option = mysqli_real_escape_string($connection, $_POST['options']);

    // Check if $usernameOrEmail is a valid email address
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE email = ? AND options = ?";
    } else {
        $query = "SELECT * FROM users WHERE username = ? AND options = ?";
    }

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $usernameOrEmail, $option);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Verify the entered password with the stored hashed password
            $storedHashedPassword = $row['password'];
            if (password_verify($password, $storedHashedPassword)) {
                // Password is correct, proceed with login
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $row['email']; // It can be NULL
                $_SESSION['username'] = $row['username'];
                $_SESSION['options'] = $row['options'];

                // Fetch the current time
                $currentVisitTime = date("Y-m-d H:i:s");

                // Update last visit time in the database
                $identifier = $row['email'] ?? $row['username'];
                $identifierField = $row['email'] ? 'email' : 'username';

                $updateVisitQuery = "UPDATE users SET last_visit = ? WHERE $identifierField = ?";
                $updateVisitStmt = mysqli_prepare($connection, $updateVisitQuery);
                mysqli_stmt_bind_param($updateVisitStmt, "ss", $currentVisitTime, $identifier);
                mysqli_stmt_execute($updateVisitStmt);

                // Redirect the user based on their role
                switch ($row['options']) {
                    case 'admin':
                        header("Location: ../admin/");
                        exit();
                    case 'it head':
                        header("Location: ../it/");
                        exit();
                    case 'business head':
                        header("Location: ../business/");
                        exit();
                    case 'art head':
                        header("Location: ../art/");
                        exit();
                    case 'auto head':
                        header("Location: ../auto/");
                        exit();
                    default:
                        // Redirect to a default page or handle as needed
                        break;
                }
            } else {
                header('Location: ../index.php?error_msg=Sorry, your username/email or password is invalid');
                exit();
            }
        } else {
            header('Location: ../index.php?error_msg=Sorry, your username/email or password is invalid');
            exit();
        }
    }
}
?>
