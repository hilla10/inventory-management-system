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

 include('../includes/dbcon.php');
 include('../includes/header.php');


echo "<div class=\"d-flex flex-column w-100 vh-100 justify-content-center align-items-center\">
    <h2 class=\"pe-2 text-success fw-semibold\">Loading page... Redirecting</h2>
    <img src=\"../page_loading/loading.svg\" style=\"height: 120px; width: 120px;\">
</div>";


if(isset($_POST['add_department'])) {
    // Validate and sanitize fields
     $name = trim($_POST['username']); 
     $email = $_POST['email'];
     $age = $_POST['age'];
     $phone = $_POST['phone'];
     $position = $_POST['position'];

       // Perform additional validation if needed
    $errors = [];
    if(empty($name) ||  empty($email) || empty($age) || empty($phone) || empty($position)) {
          $errors[] = "Some fields are empty.";
    }

    elseif (empty($name)) {
        $errors[] = "You need to fill in the username.";
    }
 
    elseif (empty($email)) {
        $errors[] = "You need to fill in the email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
        // Extract domain from email
        $domain = explode('@', $email)[1];

        // Check if domain has valid DNS records
        if (!checkdnsrr($domain, 'MX')) {
            $errors[] = "Please enter a valid email address.";
        }

    }elseif(empty($age)) {
          $errors[] = "You need to fill the age.";
    }

     elseif(empty($phone)) {
          $errors[] = "You need to fill the phone.";
    }

     elseif(empty($position)) {
          $errors[] = "You need to fill the position.";
    }
    

    if (!empty($errors)) {
        $message = implode(" ", $errors);
        header('location: index.php?error_msg=' . urlencode($message));
        exit;
    }

         $stmt =  $connection->prepare("INSERT INTO department_registration (username, email, age, phone, position) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $age, $phone, $position );
        $stmt->execute();

        if($stmt->affected_rows > 0) {
              header('Refresh: 5; URL=index.php?insert_msg=' . urlencode("Congratulations! You have successfully registered."));
        exit;
            
        } else {
            die("Query Failed" . mysqli_error($connection));
        }

    }

?>