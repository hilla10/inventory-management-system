

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

  <title>User Register</title>
    
</head>
<body  class="body text-light">


<?php
// Include the database connection file
include('../includes/dbcon.php');

// Include the header file
// include('../includes/header.php');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


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
    $email = trim($_POST['email']);
    $phone = trim($_POST['Phone']);
    $position = trim($_POST['position']);
    $password = $_POST['passwords'];
    $confirm = $_POST['confirm'];

    // Perform additional validation if needed
    $errors = [];

    if (empty($name) || empty($gender) || empty($email) || empty($age) || empty($phone) || empty($position) || empty($password) || empty($confirm)) {
        $errors[] = "Some fields are empty.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else {
        // Extract domain from email
        $domain = explode('@', $email)[1];
        // Check if domain has valid DNS records
        if (!checkdnsrr($domain, 'MX')) {
            $errors[] = "Please enter a valid email address.";
        }
    }
    if (strlen($password) < 8) {
        $errors[] = "Please enter a password with a minimum of 8 characters.";
    }
    if ($password !== $confirm) {
        $errors[] = "The passwords do not match.";
    }

    // If there are errors, redirect back to the form with an error message
    if (!empty($errors)) {
         $message = implode(" ", $errors);
        header('location: index.php?error_msg=' . urlencode($message));
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email or phone already exists in the database
    $stmtCheckEmail = $connection->prepare("SELECT email FROM register WHERE email = ?");
    $stmtCheckEmail->bind_param("s", $email);
    $stmtCheckEmail->execute();
    $stmtCheckEmail->store_result();

    $stmtCheckPhone = $connection->prepare("SELECT Phone FROM register WHERE Phone = ?");
    $stmtCheckPhone->bind_param("s", $phone);
    $stmtCheckPhone->execute();
    $stmtCheckPhone->store_result();

    if ($stmtCheckEmail->num_rows > 0) {
        $message = "The email address is already registered.";
        header('location: index.php?error_msg=' . urlencode($message));
        exit;
    } elseif ($stmtCheckPhone->num_rows > 0) {
       $message = "The phone number is already registered.";
        header('location: index.php?error_msg=' . urlencode($message));
        exit;
    }

    // Start transaction
    $connection->begin_transaction();

    try {
        // Insert the input values into the register table
        $stmtRegister = $connection->prepare("INSERT INTO register (username, gender, age, email, Phone, options, passwords) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtRegister->bind_param("ssissss", $name, $gender, $age, $email, $phone, $position, $hashedPassword);
        $stmtRegister->execute();

        if ($stmtRegister->affected_rows > 0) {
            // Insert the input values into the user table
            $stmtUser = $connection->prepare("INSERT INTO user (user_name, email, `option`, `password`) VALUES (?, ?, ?, ?)");
            $stmtUser->bind_param("ssss", $name, $email, $position, $hashedPassword);
            $stmtUser->execute();

            if ($stmtUser->affected_rows > 0) {
                // Commit transaction
                header('Refresh: 3; URL=index.php?insert_msg=' . urlencode("Congratulations! You have successfully registered."));
                exit;
            } else {
                // Rollback transaction if the user table insert failed
                $connection->rollback();
                die("Failed to insert into the user table.");
            }
        } else {
            // Rollback transaction if the register table insert failed
            $connection->rollback();
            die("Failed to insert into the register table.");
        }
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaction on exception
        $connection->rollback();
        die("Query Failed: " . $exception->getMessage());
    } finally {
        // Close statements
        $stmtCheckEmail->close();
        $stmtCheckPhone->close();
        $stmtRegister->close();
        $stmtUser->close();
    }
}
?>
</body>
</html>