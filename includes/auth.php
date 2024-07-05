<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php?error_msg=" . urlencode("Please login to access this page"));
    exit();
}

// Define project directory
$projectDirectory = '/inventory-management-system'; // Adjust this to match your project's directory

// Define allowed pages based on roles
$allowedPages = [
    'admin' => [
        'allowed_paths' => [
            "$projectDirectory/*.php" // Allow admin to access all pages
        ]
    ],
    'it' => [
        'allowed_paths' => [
            "$projectDirectory/it/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'business' => [
        'allowed_paths' => [
            "$projectDirectory/business/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'art' => [
        'allowed_paths' => [
            "$projectDirectory/art/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'auto' => [
        'allowed_paths' => [
            "$projectDirectory/auto/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'it head' => [
        'allowed_paths' => [
            "$projectDirectory/it/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'art head' => [
        'allowed_paths' => [
            "$projectDirectory/art/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'auto head' => [
        'allowed_paths' => [
            "$projectDirectory/auto/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
    ],
    'business head' => [
        'allowed_paths' => [
            "$projectDirectory/business/index.php",
            "$projectDirectory/bin/index.php",
            "$projectDirectory/model_19/index.php",
            "$projectDirectory/model_20/index.php"
        ]
        ],
    'all' => [
        'allowed_paths' => [
            "$projectDirectory/include/delete_user.php" // Allow all roles to access the delete_user.php file
        ]
    ]
];

$currentPage = $_SERVER['PHP_SELF'];
$userRole = $_SESSION['options'];

$authorized = false;

// Check if current page is in the allowed pages for the user's role
if (isset($allowedPages[$userRole])) {
    foreach ($allowedPages[$userRole]['allowed_paths'] as $allowedPath) {
        if (fnmatch($allowedPath, $currentPage)) {
            $authorized = true;
            break;
        }
    }
}

// If not authorized, redirect to appropriate page
if (!$authorized && $userRole !== 'admin') {
    $errorMessage = "You are not authorized to access the page: " . $currentPage;
    header("Location: index.php?error_msg=" . urlencode($errorMessage));
    exit();
}
?>
