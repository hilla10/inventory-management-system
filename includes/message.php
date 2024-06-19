<?php

// Check if the function does not already exist before declaring it
if (!function_exists('displayMessage')) {
    // Function to display messages
    function displayMessage($type, $message) {
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show m-auto text-center w-50" role="alert">';
        echo '<strong class="text-light">' . htmlspecialchars($message) . '</strong>';
        echo '</div>';
        // Remove the message from the URL
        $redirectUrl = 'index.php';
        echo '<meta http-equiv="refresh" content="3;URL=' . $redirectUrl . '">';
        exit;
    }
}


// Check for messages in the URL
if (isset($_GET['success_msg'])) {
    displayMessage('warning', $_GET['success_msg']);
}

if (isset($_GET['insert_msg'])) {
    displayMessage('success', $_GET['insert_msg']);
}

if (isset($_GET['error_msg'])) {
    displayMessage('danger', $_GET['error_msg']);
}

if (isset($_GET['update_msg'])) {
    displayMessage('success', $_GET['update_msg']);
}

if (isset($_GET['delete_msg'])) {
    displayMessage('success', $_GET['delete_msg']);
}
?>
