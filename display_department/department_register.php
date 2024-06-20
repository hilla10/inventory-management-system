

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
// Include necessary files
include('../includes/dbcon.php');
// include('../includes/header.php');



// Display loading message
echo "<div class=\"d-flex flex-column w-100 vh-100 justify-content-center align-items-center\">
    <h2 class=\"pe-2 text-success fw-semibold\">Loading page... Redirecting</h2>
    <img src=\"../page_loading/loading.svg\" style=\"height: 120px; width: 120px;\">
</div>";

// Error reporting and form handling
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['add_department'])) {
    // Sanitize and validate input fields
    $name = trim($_POST['username']);
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];

    $errors = [];

    if(empty($name) || empty($email) || empty($age) || empty($phone) || empty($position)) {
        $errors[] = "Some fields are empty.";
    }

    if(empty($name)) {
        $errors[] = "You need to fill in the username.";
    }

    if(empty($email)) {
        $errors[] = "You need to fill in the email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";

        // Additional DNS check if needed
        $domain = explode('@', $email)[1];
        if (!checkdnsrr($domain, 'MX')) {
            $errors[] = "Please enter a valid email address with valid domain.";
        }
    }

    if(empty($age)) {
        $errors[] = "You need to fill the age.";
    }

    if(empty($phone)) {
        $errors[] = "You need to fill the phone.";
    }

    if(empty($position)) {
        $errors[] = "You need to fill the position.";
    }

    // If there are errors, redirect with error message
    if (!empty($errors)) {
        $message = implode(" ", $errors);
        header('Location: index.php?message=' . urlencode($message));
        exit;
    }

    // Prepare and execute SQL statement for insertion
    $stmt = $connection->prepare("INSERT INTO department_registration (username, email, age, phone, position) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $name, $email, $age, $phone, $position);
    $stmt->execute();

    // Check for successful insertion
    if($stmt->affected_rows > 0) {
        header('Refresh: 3; URL=index.php?insert_msg=' . urlencode("Congratulations! You have successfully registered."));
        exit;
    } else {
        die("Query Failed: " . mysqli_error($connection));
    }
}
?>

</body>
</html>