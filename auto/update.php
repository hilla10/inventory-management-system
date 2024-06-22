<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['ordinary-number'])) {
        $ordinary_number = $_GET['ordinary-number'];

        $query = "SELECT * FROM  `auto_department` WHERE `ordinary-number` = '$ordinary_number'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php 

    if(isset($_POST['update_items'])) {

        if(isset($_GET['id_new'])) {
            $new_number = $_GET['id_new'];
        }

    $inventoryList = $_POST['inventory-list'];
    $description = $_POST['description'];
    $measure = $_POST['measure'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total-price'];
    $examination = $_POST['examination'];

        $query = "UPDATE `auto_department` set `inventory-list` = '$inventoryList', `description` = '$description', `measure` = '$measure', `quantity` = '$quantity', `quantity` = '$quantity', `price` = '$price', `total-price` = '$totalPrice', `examination` = '$examination' WHERE `ordinary-number` = '$new_number'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>
  <?php include('../includes/update_item.php'); ?>

  <?php include('../includes/footer.php'); ?>