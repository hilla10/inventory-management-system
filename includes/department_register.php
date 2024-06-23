

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

// Include the header file
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
if(isset($_POST['add_department'])) {
    // Validate and sanitize fields
     $name = trim($_POST['username']); 
     $email = $_POST['email'];
     $gender = $_POST['gender'];
     $age = $_POST['age'];
     $phone = $_POST['phone'];
     $position = $_POST['position'];

       // Perform additional validation if needed
    $errors = [];
    if(empty($name) ||  empty($email) || empty($gender) || empty($age) || empty($phone) || empty($position)) {
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
        $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode($message);
        header('Location: ' . $redirectUrl);
        exit;
    }
         $stmt =  $connection->prepare("INSERT INTO department_registration (username, email, gender, age, phone, position) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $name, $email,$gender, $age, $phone, $position );
        $stmt->execute();

        if($stmt->affected_rows > 0) {
              $connection->commit();
                $message = "Congratulations! You have successfully registered.";
                $redirectUrl = '../' . $currentPage . '?insert_msg=' . urlencode($message);
                header('Refresh: 3; URL=' . $redirectUrl);
                exit;
        exit;
            
        } else {
            die("Query Failed" . mysqli_error($connection));
        }

    }

?>

</body>
</html>