<?php

include("../includes/dbcon.php");
session_start();

if (isset($_POST['login'])) {
    $usernameOrEmail = mysqli_real_escape_string($connection, $_POST['username_or_email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $option = mysqli_real_escape_string($connection, $_POST['options']);

    $query = "SELECT * FROM `user` WHERE (`user_name` = ? OR `email` = ?) AND `option` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sss", $usernameOrEmail, $usernameOrEmail, $option);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_num_rows($result);

        if ($row === 1) {
            // Fetch the stored hashed password from the database
            $row = mysqli_fetch_assoc($result);
            $storedHashedPassword = $row['password'];

            // Verify the entered password with the stored hashed password
            if (password_verify($password, $storedHashedPassword)) {
                // Password is correct, proceed with login
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $row['email'];
                $_SESSION['options'] = $row['option'];

                // Fetch the current time
                $currentVisitTime = date("Y-m-d H:i:s");

                // Retrieve and store the last visit time from the database
                $lastVisitQuery = "SELECT last_visit FROM `user` WHERE email = ?";
                $lastVisitStmt = mysqli_prepare($connection, $lastVisitQuery);
                mysqli_stmt_bind_param($lastVisitStmt, "s", $row['email']);
                mysqli_stmt_execute($lastVisitStmt);
                $lastVisitResult = mysqli_stmt_get_result($lastVisitStmt);

                if ($lastVisitResult) {
                    $lastVisitRow = mysqli_fetch_assoc($lastVisitResult);
                    $_SESSION['lastVisitTime'] = $lastVisitRow['last_visit'];
                } else {
                    $_SESSION['lastVisitTime'] = null;
                }

                // Update the last visit time in the database
                $updateVisitQuery = "UPDATE `user` SET last_visit = ? WHERE email = ?";
                $updateVisitStmt = mysqli_prepare($connection, $updateVisitQuery);
                mysqli_stmt_bind_param($updateVisitStmt, "ss", $currentVisitTime, $row['email']);
                mysqli_stmt_execute($updateVisitStmt);

                // Redirect the user based on their role
                $options = $row['option'];

                echo "Options: " . $options;
                if ($options === 'admin') {
                    header("Location: ../admin/");
                    exit();
                } elseif ($options === 'it head') {
                    header("Location: ../it/");
                    exit();
                } elseif ($options === 'business head') {
                    header("Location: ../business/");
                    exit();
                } elseif ($options === 'art head') {
                    header("Location: ../art/");
                    exit();
                } elseif ($options === 'auto head') {
                    header("Location: ../auto/");
                    exit();
                }
            } else {
                header('location:../index.php?error_msg=Sorry, your username/email, roll or password is invalid');
            }
        } else {
            header('location:../index.php?error_msg=Sorry, your username/email, roll or password is invalid');
        }
    }
}
?>
