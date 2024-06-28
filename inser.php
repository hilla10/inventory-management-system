

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- google font noto serif Ethiopic-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Ethiopic:wght@100..900&display=swap" rel="stylesheet">
 <!-- google font open sans-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<!-- font awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- style file -->
<!-- <link rel="stylesheet" href="../css/style.css"> -->
 <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">

   <!-- bootstrap js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <!-- main js -->
<script src="../js/main.js?v=<?php echo time(); ?>" defer></script>

  <title>Department Register</title>
    
</head>
<body  class="body text-light">


<?php
// Include the database connection file
include('dbcon.php');
// include('header.php');

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
if (isset($_POST['add_department'])) {
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
        $stmtDepartment = $connection->prepare("INSERT INTO department_registration (username, gender, age, email, phone, position) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtDepartment->bind_param("ssisss", $name, $gender, $age, $email, $phone, $position);
        $stmtDepartment->execute();

        if ($stmtDepartment->affected_rows > 0) {
            // Commit transaction
            $connection->commit();
            $message = "Congratulations! You have successfully added a new Department.";
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

        </body>
</html>