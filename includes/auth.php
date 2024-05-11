<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php?message=Please login to access this page");
    exit();
}

$projectDirectory = '/group-project'; // Adjust this to match your project's directory

$allowedPages = [
    'it' => "$projectDirectory/it/index.php",
    'business' => "$projectDirectory/business/index.php",
    'art' => "$projectDirectory/art/index.php",
    'auto' => "$projectDirectory/auto/index.php",
    'it head' => "$projectDirectory/it/index.php",
    'art head' => "$projectDirectory/art/index.php",
    'auto head' => "$projectDirectory/auto/index.php",
    'business head' => "$projectDirectory/business/index.php",
];

$currentPage = $_SERVER['PHP_SELF'];
$userRole = $_SESSION['options'];

if (!isset($allowedPages[$userRole]) || $allowedPages[$userRole] !== $currentPage) {
    $errorMessage = "You are not authorized to access this page: $currentPage";        
    
    if (isset($allowedPages[$userRole])) {
        header("Location: {$allowedPages[$userRole]}?message=".urlencode($errorMessage));
    } else {
        header("Location: unauthorized.php?message=".urlencode($errorMessage));
    }
    exit();
}
?>