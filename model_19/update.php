<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['ordinary-number'])) {
        $ordinary_number = $_GET['ordinary-number'];

        $query = "SELECT * FROM  `model_19` WHERE `ordinary-number` = '$ordinary_number'";

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

    $itemType = $_POST['item-type'];
    $model = $_POST['model'];
    $serie = $_POST['serie'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total-price'];

        $query = "UPDATE `model_19` set `quantity` = '$quantity', `item-type` = '$itemType', `model` = '$model', `serie` = '$serie', `price` = '$price', `total-price` = '$totalPrice' WHERE `ordinary-number` = '$new_number'";

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