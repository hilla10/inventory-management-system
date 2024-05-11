<?php include ("dbcon.php"); ?>
<?php session_start();?>

<?php

if(isset($_POST['login'])) {
    $username = $_POST['uname'];
    $email = $_POST['email'];
   
}

$query = "SELECT * FROM `users` WHERE `username` = '$username' AND `email` = '$email'";

$result = mysqli_query($con, $query);

if(!$result) {
    die("Query Failed" . mysqli_error($con));
} else {
    $row = mysqli_num_rows($result);
    
    if($row === 1) {
        $_SESSION['uname'] = $username;
        header('location:../home.php');
    } else {
        
        header('location:../index.php?message=Sorry your username or email is invalid');
    }
}

?>