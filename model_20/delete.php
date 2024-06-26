
<?php include('../includes/dbcon.php'); ?>

    <?php

    if(isset($_GET['ordinary_number'])) {
        $ordinaryNumber = $_GET['ordinary_number'];

        $query = "DELETE FROM `model_20` WHERE `ordinary_number` = '$ordinaryNumber'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } 

        else {
            header('location:index.php?delete_msg=You have deleted the record');
        }
    }


?>