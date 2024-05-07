<?php include('../includes/dbcon.php'); ?>
<?php 

if(isset($_POST['add_model'])) {
    $ordinaryNumber = $_POST['ordinary-number'];
    $itemType = $_POST['item-type'];
    $model = $_POST['model'];
    $serie = $_POST['serie'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total-price'];
    
    if( empty($quantity) || empty($itemType)|| empty($model) || empty($serie)  || empty($price) || empty($totalPrice) ) {
        header('location: index.php?message= Some fields are empty.');
          exit();
    } elseif($quantity === "" || empty($quantity)) {
         header('location: index.php?message=You need to fill the quantity');
         exit();
    } elseif($itemType === "" || empty($itemType)) {
         header('location: index.php?message=You need to fill the itemType');
         exit();
    } elseif($model === "" || empty($model)) {
         header('location: index.php?message=You need to fill the model');
         exit();
    } elseif($serie === "" || empty($serie)) {
         header('location: index.php?message=You need to fill the serie');
         exit();
    } elseif($price === "" || empty($price)) {
         header('location: index.php?message=You need to fill the price');
         exit();
    } elseif($totalPrice === "" || empty($totalPrice)) {
         header('location: index.php?message=You need to fill the total Price');
         exit();
    } else {

      
    // Prepare and execute the Insert query
   $query = "INSERT INTO model_19 (`ordinary-number`, `item-type`, `model`, `serie`, `quantity`, `price`, `total-price`) VALUES ('$ordinaryNumber', '$itemType', '$model', '$serie', '$quantity', '$price', '$totalPrice')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been added successfully');
        }

    }
}

?>