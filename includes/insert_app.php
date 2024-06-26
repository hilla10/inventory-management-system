<?php
// Include the database connection
include('dbcon.php');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Access the stored current page URL
$currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : '';

// Extract department from URL if available
$department = isset($_GET['department']) ? $_GET['department'] : '';

function isSelected($value, $department) {
    return $value === $department ? 'selected' : '';
}

// Handle form submission
if (isset($_POST['add_item'])) {
    $formData = $_POST;
    $errors = validateFormData($formData);

    if (empty($errors)) {
        $department = trim(strtoupper($formData['department']));
        $currentPageUpper = strtoupper($currentPage);

        // Extract the department name from the current page
        $pathSegments = explode('/', trim($currentPage, '/'));
        $currentDepartment = strtoupper($pathSegments[0]);

        // Check if the department matches the current page
        if ($department !== $currentDepartment) {
            // Department mismatch error
            $redirectUrl = '../' . $currentPage . '?error_msg=Your department must be ' . $currentDepartment . ' or ' . strtolower($currentDepartment);
            header('Location: ' . $redirectUrl);
            exit;
        }

        $result = insertInventoryItem($formData, $currentPage);
        
        if ($result) {
            // Successful insertion
            $redirectUrl = '../' . $currentPage . '?insert_msg=Your data has been added successfully';
            header('Location: ' . $redirectUrl);
            exit;
        } else {
            // General insertion error
            $errors[] = 'An error occurred while inserting the data. Please try again.';
        }
    }

    // If there are errors, handle them accordingly (e.g., display them to the user)
    if (!empty($errors)) {
        // Here you can store errors in the session or pass them back to the form page
        $_SESSION['errors'] = $errors;
        $redirectUrl = '../' . $currentPage . '?error_msg=' . urlencode(implode(', ', $errors));
        header('Location: ' . $redirectUrl);
        exit;
    }
}

/**
 * Fetch the list of departments from the database.
 *
 * @return array The list of departments.
 */
function fetchDepartments()
{
    global $connection;

    $query = "SELECT `name` FROM departments";
    $result = mysqli_query($connection, $query);

    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = strtoupper($row['name']);
    }

    return $departments;
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
    $allowedDepartments = fetchDepartments();

    foreach ($segments as $key => $segment) {
        if (in_array(strtoupper($segment), $allowedDepartments)) {
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

    $inventoryList = trim($formData['inventory_list']);
    $department = trim(strtoupper($formData['department']));
    $itemType = trim(strtoupper($formData['item_type']));
    $description = trim($formData['description']);
    $quantity = trim($formData['quantity']);
    $price = trim($formData['price']);
    // $totalPrice = trim($formData['total_price']);
    $examination = trim($formData['examination']);

    $allowedDepartments = fetchDepartments();

    // Validation rules

    if(empty($inventoryList) || empty($department) || empty($description) || empty($quantity) || empty($price) || empty($examination) || empty($itemType)) {

        $errors[] = 'Some field are empty';
    }elseif (!in_array($department, $allowedDepartments)) {
        $errors[] = 'Department must be one of the following: ' . implode(', ', $allowedDepartments);
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

    $inventoryList = $formData['inventory_list'];
    $department = $formData['department'];
    $itemType = $formData['item_type'];
    $itemCategory = $formData['item_category'];
    $description = $formData['description'];
    $measure = $formData['measure'];
    $quantity = $formData['quantity'];
    $price = $formData['price'];
    $examination = $formData['examination'];

    $query = "INSERT INTO inventory (`inventory_list`, department, `item_type`, `item_category`, `description`, measure, quantity, price, examination) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssss', $inventoryList, $department, $itemType, $itemCategory, $description, $measure, $quantity, $price, $examination);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}
?>
