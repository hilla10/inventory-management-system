<?php
include('dbcon.php');
// include('auth.php'); // Assuming you have an auth file for user authentication
include('../includes/check_time.php'); // Include time out for security

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Fetch the item details to be updated
if (isset($_GET['ordinary_number']) && isset($_GET['department'])) {
    $ordinary_number = $_GET['ordinary_number'];
    $department = $_GET['department'];

    $query = "SELECT * FROM `inventory` WHERE `department` = ? AND `ordinary_number` = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('ss', $department, $ordinary_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("No item found with the given ordinary number and department.");
    }
}


if (isset($_POST['update_items'])) {

    if (isset($_GET['id_new'])) {
        $new_number = $_GET['id_new'];
       $department = $_GET['department'];
    }

    
    $itemType = $_POST['item_type'];
    $itemCategory = $_POST['item_category'];
    $inventoryList = $_POST['inventory_list'];
    $description = $_POST['description'];
    $measure = $_POST['measure'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total_price'];
    $examination = $_POST['examination'];

    // Update the item details using a prepared statement
    $query = "UPDATE `inventory` SET `department` = ?, `item_type` = ?, `item_category` = ?, `inventory_list` = ?, `description` = ?, `measure` = ?, `quantity` = ?, `price` = ?, `examination` = ? WHERE `department` = ? AND `ordinary_number` = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('sssssssdsss', $department, $itemType,$itemCategory, $inventoryList, $description, $measure, $quantity, $price,  $examination, $department, $new_number);

    if ($stmt->execute()) {
        $redirectUrl = '../' . $currentPage . '?update_msg=You have successfully updated the data';
        header('Location: ' . $redirectUrl);
        exit;
    } else {
        die("Query failed: " . $stmt->error);
    }
}

include('update_item.php'); 
?>