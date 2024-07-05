<?php
include('../includes/dbcon.php');

// Start session if not already started
session_start();

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';

// Function to validate phone number format
function isValidPhone($phoneValue) {
    // Trim whitespace
    $phoneValue = trim($phoneValue);

    // Allow empty/null phone numbers or '+251'
    if ($phoneValue === '+251' || $phoneValue === '+251 ') {
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

// Fetch department registration details based on ID from GET parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM `department_registration` WHERE `id` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }

    mysqli_stmt_close($stmt);
}

// Handle form submission for updating department registration
if (isset($_POST['update_department'])) {
    // Validate input and sanitize data
    $new_number = isset($_GET['id_new']) ? $_GET['id_new'] : null;
    $username = isset($_POST['username']) ? mysqli_real_escape_string($connection, $_POST['username']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($connection, $_POST['email']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($connection, $_POST['gender']) : '';
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($connection, trim($_POST['phone'])) : '';
    $position = isset($_POST['position']) ? mysqli_real_escape_string($connection, $_POST['position']) : '';

    // Array to store validation errors
    $errors = [];

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

    // Validate phone number format if provided
    if (!isValidPhone($phone)) {
        $errors[] = "Phone number '$phone' is invalid.";
    } else if ($phone === '+251' || $phone === '+251 ') {
        $phone = null; // Set to NULL if +251 or empty
    }

    // Check if the updated email already exists (excluding current user)
    if (!empty($email)) {
        $queryCheckEmail = "SELECT id FROM department_registration WHERE email = ? AND id <> ?";
        $stmtCheckEmail = mysqli_prepare($connection, $queryCheckEmail);
        mysqli_stmt_bind_param($stmtCheckEmail, 'si', $email, $new_number);
        mysqli_stmt_execute($stmtCheckEmail);
        mysqli_stmt_store_result($stmtCheckEmail);
        if (mysqli_stmt_num_rows($stmtCheckEmail) > 0) {
            $errors[] = "Email '$email' is already registered.";
        }
        mysqli_stmt_close($stmtCheckEmail);
    }

    // Check if the updated phone number already exists (excluding current user)
    if (!empty($phone)) {
        $queryCheckPhone = "SELECT id FROM department_registration WHERE phone = ? AND id <> ?";
        $stmtCheckPhone = mysqli_prepare($connection, $queryCheckPhone);
        mysqli_stmt_bind_param($stmtCheckPhone, 'si', $phone, $new_number);
        mysqli_stmt_execute($stmtCheckPhone);
        mysqli_stmt_store_result($stmtCheckPhone);
        if (mysqli_stmt_num_rows($stmtCheckPhone) > 0) {
            $errors[] = "Phone number '$phone' is already registered.";
        }
        mysqli_stmt_close($stmtCheckPhone);
    }

    // If there are errors, display them and stop further execution
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        exit;
    }

    // Update department registration in database using prepared statement
    $queryUpdate = "UPDATE `department_registration` SET `username` = ?, `email` = ?, `age` = ?, `gender` = ?, `phone` = ?, `position` = ? WHERE `id` = ?";
    $stmtUpdate = mysqli_prepare($connection, $queryUpdate);
    mysqli_stmt_bind_param($stmtUpdate, 'ssisssi', $username, $email, $age, $gender, $phone, $position, $new_number);

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

    mysqli_stmt_close($stmtUpdate);
}

include('update_department.php');
include('../includes/footer.php');
?>
