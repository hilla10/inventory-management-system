<?php include("dbcon.php");?>
<?php session_start();?>

<?php 
if (isset($_POST['login'])) {
    $usernameOrEmail = mysqli_real_escape_string($connection, $_POST['username_or_email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM `user` WHERE `user_name` = ? OR `email` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $usernameOrEmail, $usernameOrEmail);
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
                $_SESSION['email'] = $row['email'];
                $_SESSION['options'] = $row['option'];
              
                // Redirect the user based on their role
                $options = $row['option'];
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
                header('location:../index.php?message=Sorry, your username/email or password is invalid');
            }
        } else {
            header('location:../index.php?message=Sorry, your username/email or password is invalid');
        }
    }
}
?>