<?php include('../includes/dbcon.php') ?>
<?php



if (isset($_POST['delete_user'])) {
    $usernameToDelete = $_POST['username'];

        $sqlRegister = "DELETE FROM `register` WHERE username  = '$usernameToDelete'";

    $sqlUser =  "DELETE FROM `user` WHERE user_name  = '$usernameToDelete'";

    $resultRegister = mysqli_query($connection, $sqlRegister);
    $resultUser = mysqli_query($connection, $sqlUser);

    if(!$resultRegister && !$resultUser) {
            die("Query Failed" . mysqli_error($connection));
        } 

        else {
            header('location:index.php?delete_msg=You have deleted the record');
        header('location: ../display_user/');
        }
}

?>


<?php include('../includes/header.php') ?>