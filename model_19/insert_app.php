<?php include('../includes/dbcon.php'); ?>
<?php 

if(isset($_POST['add_model'])) {
    // $ordinaryNumber = $_POST['ordinary-number'];
    $addedBy = $_POST['added-by'];
    $itemType = $_POST['item-type'];
    $model = $_POST['model'];
    $serie = $_POST['serie'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    // $totalPrice = $_POST['total-price'];
    
    if( empty($addedBy) || empty($quantity) || empty($itemType)|| empty($model) || empty($serie)  || empty($price)) {
        header('location: index.php?error_msg= Some fields are empty.');
          exit();
    }  else {

      
    // Prepare and execute the Insert query
   $query = "INSERT INTO model_19 ( `added_by`, `item-type`, `model`, `serie`, `quantity`, `price`) VALUES ( '$addedBy', '$itemType', '$model', '$serie', '$quantity', '$price')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been added successfully');
        }

    }
}

?>