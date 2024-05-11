<?php
session_start();

// Perform form validation and user registration process
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Check if the user is authenticated
    if (!isset($_SESSION['authenticated'])) {
        // If not authenticated, redirect to the login page or any other appropriate page
        header("Location: ./index.php");
        exit();
    }

}
 
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<div class=\"d-flex flex-column w-100 vh-100 justify-content-center align-items-center\">
    <h2 class=\"pe-2 text-success fw-semibold\">Loading page... Redirecting</h2>
    <img src=\"../page_loading/loading.svg\" style=\"height: 120px; width: 120px;\">
</div>";


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
        header('location: index.php?message=' . urlencode($message));
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the input values into the register table
    $stmtRegister = $connection->prepare("INSERT INTO register (username, gender, age, email, Phone, options, passwords) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtRegister->bind_param("ssissss", $name, $gender, $age, $email, $phone, $position, $hashedPassword);
    $stmtRegister->execute();

    // Insert the input values into the user table
    $stmtUser = $connection->prepare("INSERT INTO user (user_name, `option`, `password`) VALUES (?, ?, ?)");
    $stmtUser->bind_param("sss", $name, $position, $hashedPassword);
    $stmtUser->execute();

    // Check if the queries were successful
    if ($stmtRegister->affected_rows > 0 && $stmtUser->affected_rows > 0) {
        header('Refresh: 5; URL=index.php?insert_msg=' . urlencode("Congratulations! You have successfully registered."));
        header('location: ../display_user/index.php');
        exit;
    } else {
        die("Query Failed" . mysqli_error($connection));
    }
}
?>