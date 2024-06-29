<?php
include('../includes/header.php');
include('../includes/dbcon.php');

function isValidPhone($phoneValue) {
    // Trim whitespace
    $phoneValue = trim($phoneValue);

    // Allow empty/null phone numbers or '+251'
    if ($phoneValue === '+251') {
        return true; // Allow '+251' as valid
    } else {
        // Define phone number regex
        $phoneRegex = '/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/';

        // Remove non-digit characters
        $numericPhoneValue = preg_replace('/[^\d]/', '', $phoneValue);

        // Validate with regex and length check
        return preg_match($phoneRegex, $phoneValue) &&
               (strlen($numericPhoneValue) === 10 || strlen($numericPhoneValue) === 13);
    }
}


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
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($connection, trim($_POST['phone'])) : '';
    $position = isset($_POST['position']) ? mysqli_real_escape_string($connection, $_POST['position']) : '';

      // Validate phone number format if provided
    if ($phone === '+251') {
        $phone = null; // Set phone number to NULL if it is '+251'
    } else if (!isValidPhone($phone)) {
        $errors[] = "Please enter a valid phone number.";
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
