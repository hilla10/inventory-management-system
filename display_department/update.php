<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM  `department_registration` WHERE `id` = '$id'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php 

    if(isset($_POST['update_department'])) {

        if(isset($_GET['id_new'])) {
            $new_number = $_GET['id_new'];
        }

    $inventoryList = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];

        $query = "UPDATE `department_registration` set `username` = '$inventoryList', `email` = '$email', `age` = '$age', `gender` = '$gender', `phone` = '$phone', `phone` = '$phone', `position` = '$position' WHERE `id` = '$new_number'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>

  <?php include('update_department.php'); ?>



  <?php include('../includes/footer.php'); ?>