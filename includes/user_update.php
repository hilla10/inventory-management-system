<?php
include('../includes/dbcon.php');
session_start();

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';

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
               (strlen($numericPhoneValue) === 12 || strlen($numericPhoneValue) === 13);
    }
}

// Fetch user details based on ID from GET parameter
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

// Handle form submission for updating user details
if (isset($_POST['update_user'])) {
    // Validate and sanitize input data
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

    // Validate and sanitize phone number
    if (!isValidPhone($phone)) {
        $errors[] = "Phone number '$phone' is invalid.<br><br>";
    } else if ($phone === '+251' || $phone === '+251 ' || $phone === '') {
        $phoneValue = null; // Set to NULL if +251 or empty
    } else {
        $phoneValue = $phone;
    }

    // Check if the updated email already exists (excluding current user)
    if (!empty($email)) {
        $queryCheckEmail = "SELECT id FROM users WHERE email = ? AND id <> ?";
        $stmtCheckEmail = mysqli_prepare($connection, $queryCheckEmail);
        mysqli_stmt_bind_param($stmtCheckEmail, 'si', $email, $id);
        mysqli_stmt_execute($stmtCheckEmail);
        mysqli_stmt_store_result($stmtCheckEmail);
        if (mysqli_stmt_num_rows($stmtCheckEmail) > 0) {
            $errors[] = "Email '$email' is already registered.";
        }
        mysqli_stmt_close($stmtCheckEmail);
    }

    // Check if the updated phone number already exists (excluding current user)
    if (!empty($phoneValue)) {
        $queryCheckPhone = "SELECT id FROM users WHERE phone = ? AND id <> ?";
        $stmtCheckPhone = mysqli_prepare($connection, $queryCheckPhone);
        mysqli_stmt_bind_param($stmtCheckPhone, 'si', $phoneValue, $id);
        mysqli_stmt_execute($stmtCheckPhone);
        mysqli_stmt_store_result($stmtCheckPhone);
        if (mysqli_stmt_num_rows($stmtCheckPhone) > 0) {
            $errors[] = "Phone number '$phoneValue' is already registered.";
        }
        mysqli_stmt_close($stmtCheckPhone);
    }

    // If there are errors, display them and stop further execution
      if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
            $redirectUrl = '../' . $currentPage . '?update_msg= ' . $error ;
             header('Location: ' . $redirectUrl);
        }
        exit;
    }

    // Update user details in database using prepared statement
    $queryUpdate = "UPDATE users SET `username` = ?, `gender` = ?, `email` = ?, `age` = ?, `phone` = ?, `options` = ? WHERE `id` = ?";
    $stmtUpdate = mysqli_prepare($connection, $queryUpdate);
    mysqli_stmt_bind_param($stmtUpdate, 'sssissi', $username, $gender, $email, $age, $phoneValue, $options, $id);

    if (!mysqli_stmt_execute($stmtUpdate)) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        // Update session email if it has changed
        if ($email !== $_SESSION['email']) {
            $_SESSION['email'] = $email;
        }
        $redirectUrl = '../' . $currentPage . '?update_msg=You have successfully updated the data';
        header('Location: ' . $redirectUrl);
        exit;
    }
}
?>

<?php include('../display_user/update_user.php'); ?> 
<?php include('../includes/footer.php'); ?>
