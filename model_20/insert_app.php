<?php include('../includes/dbcon.php'); ?>
<?php 

if(isset($_POST['add_model'])) {
    $ordinaryNumber = $_POST['ordinary-number'];
    $quantity = $_POST['quantity'];
    $itemType = $_POST['item-type'];
    $model = $_POST['model'];
    $update = $_POST['update'];
    
    if( empty($quantity) || empty($itemType)|| empty($model) || empty($update)) {
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
    } elseif($update === "" || empty($update)) {
         header('location: index.php?message=You need to fill the update');
         exit();
    } else {

      
    // Prepare and execute the Insert query
  $query = "INSERT INTO model_20 (`ordinary-number`, `quantity`, `item-type`, `model`, `update`) VALUES ('$ordinaryNumber', '$quantity', '$itemType', '$model', '$update')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been added successfully');
        }

    }
}

?>