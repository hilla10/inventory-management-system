<?php include('../includes/dbcon.php'); ?>
<?php 

if(isset($_POST['add_item'])) {
    $inventoryList = $_POST['inventory-list'];
    $department = trim(strtoupper($_POST['department']));
    $itemType = trim(strtoupper($_POST['item-type']));
    $description = $_POST['description'];
    $measure = $_POST['measure'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total-price'];
    $examination = $_POST['examination'];
    
    if(empty($inventoryList) || empty($department) || empty($description) || empty($measure) || empty($quantity) || empty($price) || empty($totalPrice) || empty($examination)) {
        header('location: index.php?message= Some fields are empty.');
    } elseif($inventoryList === "" || empty($inventoryList)) {
         header('location: index.php?message=You need to fill the inventory list');
    } elseif($department === "" || empty($department)) {
         header('location: index.php?message=You need to fill the Department');
    }elseif($description === "" || empty($description)) {
         header('location: index.php?message=You need to fill the description');
    }  elseif($measure === "" || empty($measure)) {
         header('location: index.php?message=You need to fill the measure');
    }  elseif($quantity === "" || empty($quantity)) {
         header('location: index.php?message=You need to fill the quantity');
    }  elseif($price === "" || empty($price)) {
         header('location: index.php?message=You need to fill the price');
    }  elseif($totalPrice === "" || empty($totalPrice)) {
         header('location: index.php?message=You need to fill the totalPrice');
    } elseif($examination === "" || empty($examination)) {
         header('location: index.php?message=You need to fill the examination');
    }  elseif ($department !== 'IT') {
        header('location: index.php?message=Department must be "it" or "IT".');
    } else {

        $query =  "INSERT INTO inventory (`inventory-list`,department, `item-type`, `description`, measure, quantity, price, `total-price`, examination) VALUES ('$inventoryList','$department', $itemType, '$description', '$measure', '$quantity', '$price', '$totalPrice', '$examination')";


        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been added successfully');
        }

    }
}

?>











<?php
// Include the database connection
include('dbcon.php');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Handle form submission
if (isset($_POST['add_item'])) {
    $formData = $_POST;
    $errors = validateFormData($formData);

    if (empty($errors)) {
        $result = insertInventoryItem($formData, $currentPage);
        if ($result) {
            // Successful insertion
            $department = trim(strtoupper($formData['department']));
            $redirectUrl = '../' . $currentPage . '?insert_msg=Your data has been added successfully';
            header('Location: ' . $redirectUrl);
            exit;
        } else {
            $errors[] = 'An error occurred while inserting the data. Please try again.';
        }
    }

    // Handle errors
    if (!empty($errors)) {
        $errorMessage = implode(', ', $errors);
        $redirectUrl = '../' . $currentPage . '?message=' . urlencode($errorMessage);
        header('Location: ' . $redirectUrl);
        exit;
    }
}

/**
 * Determine the current page based on the URL.
 *
 * @param string $currentUrl The current URL.
 * @return string The current page.
 */
function determineCurrentPage($currentUrl)
{
    $path = parse_url($currentUrl, PHP_URL_PATH);
    // Remove any double slashes to ensure correct path segmentation
    $path = str_replace('//', '/', $path);
    $segments = explode('/', trim($path, '/'));
    foreach ($segments as $key => $segment) {
        if (in_array($segment, ['admin', 'it', 'art', 'auto', 'business', 'bin', 'model_19', 'model_20'])) {
            return implode('/', array_slice($segments, $key)); // Return the path from the department segment onward
        }
    }
    return ''; // Handle cases where no valid department segment is found
}

/**
 * Validate the form data.
 *
 * @param array $formData The form data.
 * @return array The validation errors.
 */
function validateFormData($formData)
{
    $errors = [];

    $inventoryList = trim($formData['inventory-list']);
    $department = trim(strtoupper($formData['department']));
    $itemType = trim(strtoupper($formData['item-type']));
    $description = trim($formData['description']);
    $measure = trim($formData['measure']);
    $quantity = trim($formData['quantity']);
    $price = trim($formData['price']);
    $totalPrice = trim($formData['total-price']);
    $examination = trim($formData['examination']);

    // Validation rules
    if (empty($inventoryList)) {
        $errors[] = 'You need to fill the inventory list';
    }
    if (empty($department)) {
        $errors[] = 'You need to fill the Department';
    } elseif (!in_array($department, ['IT', 'ART', 'AUTO', 'BUSINESS'])) {
        $errors[] = 'Department must be like "IT", "ART", "AUTO", or "BUSINESS"';
    }
    if (empty($description)) {
        $errors[] = 'You need to fill the description';
    }
    if (empty($measure)) {
        $errors[] = 'You need to fill the measure';
    }
    if (empty($quantity)) {
        $errors[] = 'You need to fill the quantity';
    }
    if (empty($totalPrice)) {
        $errors[] = 'You need to fill the total price';
    }
    if (empty($price)) {
        $errors[] = 'You need to fill the price';
    }
    if (empty($examination)) {
        $errors[] = 'You need to fill the examination';
    }

    return $errors;
}

/**
 * Insert the inventory item into the database.
 *
 * @param array $formData The form data.
 * @param string $currentPage The current page.
 * @return bool True if the insertion was successful, false otherwise.
 */
function insertInventoryItem($formData, $currentPage)
{
    global $connection;

    $inventoryList = $formData['inventory-list'];
    $department = $formData['department'];
    $itemType = $formData['item-type'];
    $description = $formData['description'];
    $measure = $formData['measure'];
    $quantity = $formData['quantity'];
    $price = $formData['price'];
    $totalPrice = $formData['total-price'];
    $examination = $formData['examination'];

    $query = "INSERT INTO inventory (`inventory-list`, department, `item-type`, `description`, measure, quantity, price, `total-price`, examination) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssss', $inventoryList, $department, $itemType, $description, $measure, $quantity, $price, $totalPrice, $examination);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}
?>
