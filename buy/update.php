<?php include('../includes/dbcon.php'); ?>
<?php include('../includes/header.php'); ?>

    <?php


    if (isset($_GET['ordinary_number'])) {
        $ordinary_number = $_GET['ordinary_number'];

        $query = "SELECT * FROM  `Purchase` WHERE `ordinary_number` = '$ordinary_number'";

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

    $inventoryList = $_POST['inventory_list'];
    $description = $_POST['description'];
    $measure = $_POST['measure'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total_price'];
    $examination = $_POST['examination'];

        $query = "UPDATE `Purchase` set `inventory_list` = '$inventoryList', `description` = '$description', `measure` = '$measure', `quantity` = '$quantity', `quantity` = '$quantity', `price` = '$price', `total_price` = '$totalPrice', `examination` = '$examination' WHERE `ordinary_number` = '$new_number'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>


<form action="update.php?id_new=<?php echo $ordinary_number; ?>" method="post">

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="inventory_list" name="inventory_list" placeholder="የእቃው ዝርዝር" value="<?php echo $row['inventory_list'] ?>">
            </div>

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="description" name="description" placeholder="የእቃው ዝርዝር" value="<?php echo $row['description'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="measure" name="measure" placeholder="የእቃው ዝርዝር" value="<?php echo $row['measure'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="quantity" name="quantity" placeholder="የእቃው ዝርዝር" value="<?php echo $row['quantity'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="price" name="price" placeholder="የእቃው ዝርዝር" value="<?php echo $row['price'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="total_price" name="total_price" placeholder="የእቃው ዝርዝር" value="<?php echo $row['total_price'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="examination" name="examination" placeholder="የእቃው ዝርዝር" value="<?php echo $row['examination'] ?>">
            </div>
           
             <input type="submit" class="btn btn-success" name="update_items" value="Update"></input>
</form>



  <?php include('../includes/footer.php'); ?>