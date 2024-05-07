<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['ordinary-number'])) {
        $ordinary_number = $_GET['ordinary-number'];

        $query = "SELECT * FROM  `model_20` WHERE `ordinary-number` = '$ordinary_number'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php 

    if(isset($_POST['update_model'])) {

        if(isset($_GET['id_new'])) {
            $new_number = $_GET['id_new'];
        }

    $quantity = $_POST['quantity'];
    $itemType = $_POST['item-type'];
    $model = $_POST['model'];
    $update = $_POST['update'];

        $query = "UPDATE `model_20` set `quantity` = '$quantity', `item-type` = '$itemType', `model` = '$model', `update` = '$update' WHERE `ordinary-number` = '$new_number'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>
  <?php include('update_model.php'); ?>

  <?php include('../includes/footer.php'); ?>