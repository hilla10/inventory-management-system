<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['ordinary_number'])) {
        $ordinary_number = $_GET['ordinary_number'];

        $query = "SELECT * FROM  `model_19` WHERE `ordinary_number` = '$ordinary_number'";

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

    $itemType = $_POST['item_type'];
    $itemCategory = $_POST['item_category'];
    $addedBy = $_POST['added-by'];
    $model = $_POST['model'];
    $serie = $_POST['serie'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

        $query = "UPDATE `model_19` set `quantity` = '$quantity', `added_by` = '$addedBy', `item_type` = '$itemType', `item_category` = '$itemCategory',  `model` = '$model', `serie` = '$serie', `price` = '$price' WHERE `ordinary_number` = '$new_number'";

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