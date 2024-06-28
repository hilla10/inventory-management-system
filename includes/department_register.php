
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
<script type="module" src="../js/main.js?v=<?php echo time(); ?>" defer></script>

  <title>Department Register</title>
    
</head>
<body  class="body text-light">

<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('dbcon.php'); // Include  database connection script
// include('header.php'); 


// Debugging output

// echo "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
// print_r($_POST);

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';
// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Display a loading message while the page is loading
echo "<div class=\"d-flex flex-column w-100 vh-100 justify-content-center align-items-center\">
    <h2 class=\"pe-2 text-success fw-semibold\">Loading page... Redirecting</h2>
    <img src=\"../page_loading/loading.svg\" style=\"height: 120px; width: 120px;\">
</div>";

// Check if the form is submitted and process it
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_department'])) {

        // Trim and sanitize input data
        $name = trim($_POST['username']);
        $gender = trim($_POST['gender']);
        $age = trim($_POST['age']);
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $position = trim($_POST['position']);

        // Array to store validation errors
        $errors = [];

        // Basic field validation
        if (empty($name) || empty($gender) || empty($age) || empty($position)) {
            $errors[] = "Some fields are empty.";
        }
        
        // Validate email if provided
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a valid email address.";
            } else {
                // Check DNS records for the email domain
                $domain = explode('@', $email)[1];
                if (!checkdnsrr($domain, 'MX')) {
                    $errors[] = "Please enter a valid email address with a valid domain.";
                }
            }
        }

        // Validate phone number format if provided
        if (!empty($phone)) {
            $phoneRegex = "/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/";
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

        // Prepare statement for checking email
        if (!empty($email)) {
            $stmtCheckEmail = $connection->prepare("SELECT email FROM department_registration WHERE email = ?");
            $stmtCheckEmail->bind_param("s", $email);
            $stmtCheckEmail->execute();
            $stmtCheckEmail->store_result();

            if ($stmtCheckEmail->num_rows > 0) {
                $message = "The email address is already registered.";
                $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
                header('Location: ' . $redirectUrl);
                exit;
            }
        }

        // Prepare statement for checking phone
        if (!empty($phone)) {
            $stmtCheckPhone = $connection->prepare("SELECT phone FROM department_registration WHERE phone = ?");
            $stmtCheckPhone->bind_param("s", $phone);
            $stmtCheckPhone->execute();
            $stmtCheckPhone->store_result();

            if ($stmtCheckPhone->num_rows > 0) {
                $message = "The phone number is already registered.";
                $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
                header('Location: ' . $redirectUrl);
                exit;
            }
        }

        // Start a database transaction
        $connection->begin_transaction();

        try {
            // Insert new department registration data
            $stmtDepartment = $connection->prepare("INSERT INTO department_registration (username, gender, age, email, phone, position) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtDepartment->bind_param("ssisss", $name, $gender, $age, $email, $phone, $position);
            $stmtDepartment->execute();

            // Check if insertion was successful
            if ($stmtDepartment->affected_rows > 0) {
                // Commit transaction if successful
                $connection->commit();
                $message = "Congratulations! You have successfully added a new User.";
                $redirectUrl = '../' . $currentPage . '?insert_msg=' . urlencode($message);
                header('Refresh: 3; URL=' . $redirectUrl);
                exit;
            } else {
                // Rollback transaction if insertion failed
                $connection->rollback();
                $message = "Failed to add User. Please try again.";
                $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
                header('Location: ' . $redirectUrl);
                exit;
            }
        } catch (Exception $e) {
            // Rollback transaction on exception
            $connection->rollback();
            $message = "An error occurred: " . $e->getMessage();
            $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
            header('Location: ' . $redirectUrl);
            exit;
        }
    }
} else {
    $message = "Error: Unable to process the form submission. Please try again.";
    $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
    header('Location: ' . $redirectUrl);
    exit;
}


?>



