<?php include("dbcon.php");?>
<?php session_start();?>
<?php 

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
                $_SESSION['options'] = $options;
              
            // Redirect the user based on their role
            if ($options === 'it head') {
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
               
                 header('location:../index.php?message=Sorry, your username or password is invalid');
            }
        } else {
           header('location:../index.php?message=Sorry, your username or password is invalid');
        }
    }
}
?>