<?php
// Include the database connection file
include('../includes/dbcon.php');

// Include the header file
include('../includes/header.php');

// Display a loading message while the page is loading
echo "<div class=\"d-flex flex-column w-100 vh-100 justify-content-center align-items-center\">
    <h2 class=\"pe-2 text-success fw-semibold\">Loading page... Redirecting</h2>
    <img src=\"../page_loading/loading.svg\" style=\"height: 120px; width: 120px;\">
</div>";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);


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

    if(empty($name) || empty($gender) || empty($email) || empty($age) || empty($phone) || empty($position) || empty($password) || empty($confirm)) {
          $errors[] = "Some fields are empty.";
    }elseif (empty($name)) {
        $errors[] = "You need to fill in the username.";
    }elseif (empty($gender)) {
        $errors[] = "You need to fill in the gender.";
    }elseif (empty($email)) {
        $errors[] = "You need to fill in the email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
          // Extract domain from email
        $domain = explode('@', $email)[1];

        // Check if domain has valid DNS records
    if (!checkdnsrr($domain, 'MX')) {
        $errors[] = "Please enter a valid email address.";
    }

    }  elseif (empty($age)) {
        $errors[] = "You need to fill the age.";
    }elseif (empty($phone)) {
        $errors[] = "You need to fill the phone.";
    }elseif (empty($position)) {
        $errors[] = "You need to fill the position.";
    }elseif (empty($password)) {
        $errors[] = "You need to fill the password.";
    }elseif (empty($confirm)) {
        $errors[] = "You need to fill the confirm password.";
    }elseif (strlen($password) < 8) {
        $errors[] = "Please enter a password with a minimum of 8 characters.";
    }elseif ($password !== $confirm) {
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

    // Insert the input values into the register table
    $stmtRegister = $connection->prepare("INSERT INTO register (username, gender, age, email, Phone, options, passwords) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtRegister->bind_param("ssissss", $name, $gender, $age, $email, $phone, $position, $hashedPassword);

    // Insert the input values into the user table
    $stmtUser = $connection->prepare("INSERT INTO user (user_name, email, `option`, `password`) VALUES (?, ?, ?, ?)");
    $stmtUser->bind_param("ssss", $name, $email, $position, $hashedPassword);

    try {
        // Execute the register table insert statement
        $stmtRegister->execute();

        // Check if the query was successful
        if ($stmtRegister->affected_rows > 0) {
            // Execute the user table insert statement
            $stmtUser->execute();

            // Check if the query was successful
            if ($stmtUser->affected_rows > 0) {
                header('Refresh: 3; URL=index.php?insert_msg=' . urlencode("Congratulations! You have successfully registered."));
                exit;
            } else {
                // Rollback the register table insert if the user table insert failed
                $stmtRegister->rollback();
                die("Failed to insert into the user table.");
            }
        } else {
            die("Failed to insert into the register table.");
        }
    } catch (mysqli_sql_exception $exception) {
        die("Query Failed: " . $exception->getMessage());
    }
}

?>