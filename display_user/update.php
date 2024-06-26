 <?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>


<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM  users WHERE `id` = '$id'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("query Failed" . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}


if(isset($_POST['update_user'])) {
$new_number = isset($_GET['id_new']) ? $_GET['id_new'] : null;

$username = isset($_POST['username']) ? mysqli_real_escape_string($connection, $_POST['username']) : ''; $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, $_POST['email']) : '';
$gender = isset($_POST['gender']) ? mysqli_real_escape_string($connection, $_POST['gender']) : '';
$age = isset($_POST['age']) ? mysqli_real_escape_string($connection, $_POST['age']) : '';
$phone = isset($_POST['phone']) ? mysqli_real_escape_string($connection, $_POST['phone']) : '';
 $options = isset($_POST['options']) ? mysqli_real_escape_string($connection, $_POST['options']) : '';

 // Ensure phone number format is valid (optional)
    $phonePattern = '/^\+?(\\d{1,3})?[-. (]*(\\d{2})[-. )]*(\\d{3})[-. ]*(\\d{4})( *x(\\d+))?\\s*$/';
    if (!preg_match($phonePattern, $phone)) {
        header('location: index.php?error_msg=Phone number is invalid.');
        exit;
    }

    $queryusers = "UPDATE users SET `username` = '$username', `gender` = '$gender', `email` = '$email', `age` = '$age', `phone` = '$phone', `options` = '$options' WHERE `id` = '$new_number'";

    $query = "UPDATE users SET `username` = ?, `gender` = ?, `email` = ?, `age` = ?, `phone` = ?, `options` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, 'sssissi',$username, $gender, $email, $age, $phone, $options, $new_number);

      $resultusers = mysqli_query($connection, $queryusers);

        if (!mysqli_stmt_execute($stmt)) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location: index.php?update_msg=You have successfully updated the data');
        exit;
    }
    
}

?>
<?php include('update_user.php'); ?> 
<?php include('../includes/footer.php'); ?>