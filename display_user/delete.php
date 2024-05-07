
<?php include('../includes/dbcon.php'); ?>

    <?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $queryRegister = "DELETE FROM `register` WHERE `id` = '$id'";

        $queryUser = "DELETE FROM `user` WHERE `id` = '$id'";

        $resultRegister = mysqli_query($connection, $queryRegister);

        $resultUser = mysqli_query($connection, $queryUser);

        if(!$resultRegister && !$resultUser) {
            die("Query Failed" . mysqli_error($connection));
        } 

        else {
            header('location:index.php?delete_msg=You have deleted the record');
        }
    }


?>