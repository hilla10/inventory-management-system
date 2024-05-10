<?php 
include("dbcon.php");
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $options = mysqli_real_escape_string($connection, $_POST['options']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM `user` WHERE `user_name` = ? AND `option` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $options);
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
                $_SESSION['username'] = $username;
                if ($options === 'it head') {
                    echo '<script>window.location.href="../it/";</script>';
                } elseif ($options === 'business head') {
                    echo '<script>window.location.href="../business/";</script>';
                } elseif ($options === 'art head') {
                    echo '<script>window.location.href="../art/";</script>';
                } elseif ($options === 'auto head') {
                    echo '<script>window.location.href="../auto/";</script>';
                }
            } else {
                // Debugging statement
                echo "Entered password: " . $password . "<br>";
            echo "Entered password: " . $hashedPassword . "<br>";
                echo "Stored hashed password: " . $storedHashedPassword . "<br>";
                echo "Password verification result: " . (password_verify($password, $storedHashedPassword) ? 'true' : 'false') . "<br>";

                // echo '<script>window.location.href="../index.php?message=Sorry, your username or password is invalid";</script>';
            }
        } else {
            // Debugging statement
            echo "Entered password: " . $password . "<br>";
            echo "Entered password: " . $hashedPassword . "<br>";
            echo "Stored hashed password: " . $storedHashedPassword . "<br>";
            echo "Password verification result: " . (password_verify($password, $storedHashedPassword) ? 'true' : 'false') . "<br>";
            
            echo '<script>window.location.href="../index.php?message=Sorry, your username or password is invalid";</script>';
        }
    }
}
?>