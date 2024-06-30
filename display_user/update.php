<?php
include('../includes/dbcon.php');
session_start();

function isValidPhone($phoneValue) {
    $phoneValue = trim($phoneValue);

    if ($phoneValue === '+251') {
        return true;
    } else {
        $phoneRegex = '/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/';
        $numericPhoneValue = preg_replace('/[^\d]/', '', $phoneValue);
        return preg_match($phoneRegex, $phoneValue) && (strlen($numericPhoneValue) === 10 || strlen($numericPhoneValue) === 13);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM users WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['update_user'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $username = isset($_POST['username']) ? mysqli_real_escape_string($connection, $_POST['username']) : ''; 
    $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, $_POST['email']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($connection, $_POST['gender']) : '';
    $age = isset($_POST['age']) ? mysqli_real_escape_string($connection, $_POST['age']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($connection, trim($_POST['phone'])) : '';
    $options = isset($_POST['options']) ? mysqli_real_escape_string($connection, $_POST['options']) : '';

      // Validate email if provided
       if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else if (!empty($email)) {
        // Extract domain from email
        $domain = explode('@', $email)[1];
        // Check if domain has valid DNS records
        if (!checkdnsrr($domain, 'MX')) {
            $errors[] = "Please enter a valid email address.";
        }
    } else {
        // If email is empty, set it to NULL
        $email = null;
    }
    if ($phone === '+251') {
        $phone = null;
    } else if (!isValidPhone($phone)) {
        $errors[] = "Please enter a valid phone number.";
    }

    $query = "UPDATE users SET `username` = ?, `gender` = ?, `email` = ?, `age` = ?, `phone` = ?, `options` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, 'sssissi', $username, $gender, $email, $age, $phone, $options, $id);

    if (!mysqli_stmt_execute($stmt)) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        if ($email !== $_SESSION['email']) {
            $_SESSION['email'] = $email;
        }
        header('Location: index.php?update_msg=You have successfully updated the data');
        exit;
    }
}
?>

<?php include('update_user.php'); ?> 
<?php include('../includes/footer.php'); ?>
