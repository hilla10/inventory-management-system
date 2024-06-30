<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php?error_msg=Please login to access this page");
    exit();
}

$projectDirectory = '/group-project'; // Adjust this to match your project's directory

$allowedPages = [
    'admin' => "$projectDirectory/*.php", // Allow admin to access all pages
    'it' => "$projectDirectory/it/index.php",
    'business' => "$projectDirectory/business/index.php",
    'art' => "$projectDirectory/art/index.php",
    'auto' => "$projectDirectory/auto/index.php",
    'it head' => "$projectDirectory/it/index.php",
    'art head' => "$projectDirectory/art/index.php",
    'auto head' => "$projectDirectory/auto/index.php",
    'business head' => "$projectDirectory/business/index.php",
    'all' => "$projectDirectory/include/delete_user.php", // Allow all roles to access the delete_user.php file
];

$currentPage = $_SERVER['PHP_SELF'];
$userRole = $_SESSION['options'];

if (!isset($allowedPages[$userRole]) || ($allowedPages[$userRole] !== $currentPage && $currentPage !== $allowedPages['all'] && $userRole !== 'admin')) {
    $errorMessage = "You are not authorized to access the page: " . $currentPage;

    if (isset($allowedPages[$userRole])) {
        header("Location: {$allowedPages[$userRole]}?error_msg=" . urlencode($errorMessage));
    } else {
        header("Location: index.php?error_msg=" . urlencode($errorMessage));
    }
    exit();
}

?>
