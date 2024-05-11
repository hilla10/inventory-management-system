<?php include('../includes/dbcon.php'); ?>
<?php include("../includes/auth.php"); ?>
<?php 

if(isset($_POST['add_item'])) {
    $inventoryList = $_POST['inventory-list'];
    $description = $_POST['description'];
    $measure = $_POST['measure'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total-price'];
    $examination = $_POST['examination'];
    
    if(empty($inventoryList) || empty($description) || empty($measure) || empty($quantity) || empty($price) || empty($totalPrice) || empty($examination)) {
        header('location: index.php?message= Some fields are empty.');
    } elseif($inventoryList === "" || empty($inventoryList)) {
         header('location: index.php?message=You need to fill the inventory list');
    }elseif($description === "" || empty($description)) {
         header('location: index.php?message=You need to fill the description');
    }  elseif($measure === "" || empty($measure)) {
         header('location: index.php?message=You need to fill the measure');
    }  elseif($quantity === "" || empty($quantity)) {
         header('location: index.php?message=You need to fill the quantity');
    }  elseif($price === "" || empty($price)) {
         header('location: index.php?message=You need to fill the price');
    }  elseif($totalPrice === "" || empty($totalPrice)) {
         header('location: index.php?message=You need to fill the totalPrice');
    } elseif($examination === "" || empty($examination)) {
         header('location: index.php?message=You need to fill the examination');
    } else {

        $query =  "INSERT INTO it_department (`inventory-list`, `description`, measure, quantity, price, `total-price`, examination) VALUES ('$inventoryList', '$description', '$measure', '$quantity', '$price', '$totalPrice', '$examination')";


        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been added successfully');
        }

    }
}

?>