
<?php include('../includes/dbcon.php'); ?>

    <?php

    if(isset($_GET['ordinary-number'])) {
        $ordinaryNumber = $_GET['ordinary-number'];

        $query = "DELETE FROM `model_19` WHERE `ordinary-number` = '$ordinaryNumber'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } 

        else {
            header('location:index.php?delete_msg=You have deleted the record');
        }
    }


?>