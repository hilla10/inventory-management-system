
    <?php
     include('dbcon.php');
    //  include('header.php'); 

     // Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}




// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

    if (isset($_GET['ordinary-number'])) {
        $ordinary_number = $_GET['ordinary-number'];
        $department = $_GET['department'];

        $query = "SELECT * FROM  `inventory` WHERE `department` = '$department' AND `ordinary-number` = '$ordinary_number'";

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

        $query = "UPDATE `inventory` set `inventory-list` = '$inventoryList', `description` = '$description', `measure` = '$measure', `quantity` = '$quantity', `quantity` = '$quantity', `price` = '$price', `total-price` = '$totalPrice', `examination` = '$examination' WHERE `department` = 'IT' AND `ordinary-number` = '$new_number'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {
              $redirectUrl = '../' . $currentPage . '?update_msg=You have successfully updated the data';
            header('Location: ' . $redirectUrl);

        }
        
    }

?>

  <?php include('update_item.php'); ?>

  <?php include('footer.php'); ?>