<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM  `register` WHERE `id` = '$id'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php 

    if(isset($_POST['update_user'])) {

        if(isset($_GET['id_new'])) {
            $new_number = $_GET['id_new'];
        }

    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $options = $_POST['options'];

        $queryRegister = "UPDATE `register` SET `username` = '$username', `gender` = '$gender', `email` = '$email', `age` = '$age', `phone` = '$phone', `phone` = '$phone', `options` = '$options' WHERE `id` = '$new_number'";

        $queryUser = "UPDATE `user` SET `user_name` = '$username',`option` = '$options' WHERE `id` = '$new_number'";

          $resultRegister = mysqli_query($connection, $queryRegister);
          $resultUser = mysqli_query($connection, $queryUser);

            if (!$resultRegister && !$queryUser) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>

  <?php include('update_user.php'); ?>

  <?php include('../includes/footer.php'); ?>