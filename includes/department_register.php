<?php
// Include the database connection file
include('dbcon.php');
include('header.php');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';
// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Display a loading message while the page is loading
echo "<div class=\"d-flex flex-column w-100 vh-100 justify-content-center align-items-center\">
    <h2 class=\"pe-2 text-success fw-semibold\">Loading page... Redirecting</h2>
    <img src=\"../page_loading/loading.svg\" style=\"height: 120px; width: 120px;\">
</div>";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form for adding a user is submitted
if (isset($_POST['add_user'])) {
    // Validate and sanitize fields
    $name = trim($_POST['username']);
    $gender = trim($_POST['gender']);
    $age = trim($_POST['age']);
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $position = trim($_POST['position']);

    // Perform additional validation if needed
    $errors = [];

    if (empty($name) || empty($gender) || empty($age) || empty($position)) {
        $errors[] = "Some fields are empty.";
    }
    
    // Ensure either email or phone is provided or neither, but not both
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else if (!empty($email)) {
        // Extract domain from email
        $domain = explode('@', $email)[1];
        // Check if domain has valid DNS records
        if (!checkdnsrr($domain, 'MX')) {
            $errors[] = "Please enter a valid email address.";
        }
    }

    if (!empty($phone)) {
        // Validate phone number format
        $phoneRegex = "/^\\s*(?:\\+?(\\d{1,3}))?[-. (]*(\\d{2,3})[-. )]*(\\d{3})[-. ]*(\\d{4})(?: *x(\\d+))?\\s*$/";
        if (!preg_match($phoneRegex, $phone)) {
            $errors[] = "Please enter a valid phone number.";
        }
    }

    // If there are errors, redirect back to the form with an error message
    if (!empty($errors)) {
        $message = implode(" ", $errors);
        $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
        header('Location: ' . $redirectUrl);
        exit;
    }

    // Check if the email or phone already exists in the database
    $stmtCheckEmail = null;
    $stmtCheckPhone = null;

    if (!empty($email)) {
        $stmtCheckEmail = $connection->prepare("SELECT email FROM department_registration WHERE email = ?");
        $stmtCheckEmail->bind_param("s", $email);
        $stmtCheckEmail->execute();
        $stmtCheckEmail->store_result();
    }

    if (!empty($phone)) {
        $stmtCheckPhone = $connection->prepare("SELECT phone FROM department_registration WHERE phone = ?");
        $stmtCheckPhone->bind_param("s", $phone);
        $stmtCheckPhone->execute();
        $stmtCheckPhone->store_result();
    }

    // Handle email and phone checks
    $emailExists = ($stmtCheckEmail && $stmtCheckEmail->num_rows > 0);
    $phoneExists = ($stmtCheckPhone && $stmtCheckPhone->num_rows > 0);

    if ($emailExists) {
        $message = "The email address is already registered.";
        $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
        header('Location: ' . $redirectUrl);
        exit;
    }
    if ($phoneExists) {
        $message = "The phone number is already registered.";
        $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
        header('Location: ' . $redirectUrl);
        exit;
    }

    // Start transaction
    $connection->begin_transaction();

    try {
        // Insert the input values into the Department table
        $stmtDepartment = $connection->prepare("INSERT INTO department_registration (username, gender, age, email, phone, options) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtDepartment->bind_param("ssisss", $name, $gender, $age, $email, $phone, $position);
        $stmtDepartment->execute();

        if ($stmtDepartment->affected_rows > 0) {
            // Commit transaction
            $connection->commit();
            $message = "Congratulations! You have successfully added a new user.";
            $redirectUrl = '../' . $currentPage . '?insert_msg=' . urlencode($message);
            header('Refresh: 3; URL=' . $redirectUrl);
            exit;
        } else {
            // Rollback transaction if the user table insert failed
            $connection->rollback();
            die("Failed to insert into the Department table.");
        }
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaction on exception
        $connection->rollback();
        die("Query Failed: " . $exception->getMessage());
    } finally {
        // Close statements
        if ($stmtCheckEmail) {
            $stmtCheckEmail->close();
        }
        if ($stmtCheckPhone) {
            $stmtCheckPhone->close();
        }
        $stmtDepartment->close();
    }
}

include('register_modal.php');
?>


   <?php $title = "Department Register"; // Set the default title

        if (isset($title) && !empty($title)) {
            echo "<script>document.title = '" . $title . "'</script>";
        }
        ?>