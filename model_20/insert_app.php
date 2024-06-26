<?php
// Include database connection
include('../includes/dbcon.php');

// Start session
session_start();

if(isset($_POST['add_model'])) {
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
    $itemType = mysqli_real_escape_string($connection, $_POST['item_type']);
    $itemCategory = mysqli_real_escape_string($connection, $_POST['item_category']);
    $model = mysqli_real_escape_string($connection, $_POST['model']);
    $update = mysqli_real_escape_string($connection, $_POST['update']);
    $requestedBy = mysqli_real_escape_string($connection, $_POST['requested-by']);
   
    
    // Validate inputs (checking for empty fields)
    if(empty($quantity) || empty($itemType) || empty($model)) {
        header('location: index.php?error_msg=Some fields are empty.');
        exit();
    }

    // Insert data into model_20 table
    $query = "INSERT INTO model_20 (quantity, `item_type`, `item_category`, model, `update`, requested_by) 
              VALUES ('$quantity', '$itemType', '$itemCategory', '$model', '$update', '$requestedBy')";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Query Failed" . mysqli_error($connection));
    } else {
        // Set notification message in session
        $_SESSION['notification'] = 'New item added successfully from: Model 20';
        // Redirect to admin/index.php after adding the item
        header('Location: index.php?insert_msg=New item added successfully:');
        exit();
    }
}

// Close database connection
mysqli_close($connection);
?>
