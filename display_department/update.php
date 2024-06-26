<?php
include('../includes/header.php');
include('../includes/dbcon.php');

// Fetch department registration details based on ID from GET parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM `department_registration` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

// Handle form submission for updating department registration
if (isset($_POST['update_department'])) {
    // Validate input and sanitize data
    $new_number = isset($_GET['id_new']) ? $_GET['id_new'] : null;
    $username = isset($_POST['username']) ? mysqli_real_escape_string($connection, $_POST['username']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, $_POST['email']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($connection, $_POST['gender']) : '';
    $age = isset($_POST['age']) ? mysqli_real_escape_string($connection, $_POST['age']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($connection, $_POST['phone']) : '';
    $position = isset($_POST['position']) ? mysqli_real_escape_string($connection, $_POST['position']) : '';

    // Ensure phone number format is valid (optional)
    $phonePattern = '/^\+?(\\d{1,3})?[-. (]*(\\d{2})[-. )]*(\\d{3})[-. ]*(\\d{4})( *x(\\d+))?\\s*$/';
    if (!preg_match($phonePattern, $phone)) {
        header('location: index.php?error_msg=Phone number is invalid.');
        exit;
    }

    // Update department registration in database using prepared statement
    $query = "UPDATE `department_registration` SET `username` = ?, `email` = ?, `age` = ?, `gender` = ?, `phone` = ?, `position` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'ssisssi', $username, $email, $age, $gender, $phone, $position, $new_number);

    if (!mysqli_stmt_execute($stmt)) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location: index.php?update_msg=You have successfully updated the data');
        exit;
    }
}

include('update_department.php');
include('../includes/footer.php');
?>
