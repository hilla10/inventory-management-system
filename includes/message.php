<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to display messages
if (!function_exists('displayMessage')) {
    function displayMessage($type, $message) {
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show mx-auto text-center w-50" role="alert">';
        echo '<strong class="text-light">' . htmlspecialchars($message) . '</strong>';
        echo '</div>';
    }
}

// Check for messages in the URL
if (isset($_GET['success_msg'])) {
    $_SESSION['message'] = ['type' => 'success', 'content' => $_GET['success_msg']];
    $redirectUrl = strtok($_SERVER["REQUEST_URI"], '?');
    echo '<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirectUrl) . '">';
    exit;
}

if (isset($_GET['insert_msg'])) {
    $_SESSION['message'] = ['type' => 'success', 'content' => $_GET['insert_msg']];
    $redirectUrl = strtok($_SERVER["REQUEST_URI"], '?');
    echo '<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirectUrl) . '">';
    exit;
}

if (isset($_GET['error_msg'])) {
    $_SESSION['message'] = ['type' => 'danger', 'content' => $_GET['error_msg']];
    $redirectUrl = strtok($_SERVER["REQUEST_URI"], '?');
    echo '<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirectUrl) . '">';
    exit;
}

if (isset($_GET['update_msg'])) {
    $_SESSION['message'] = ['type' => 'success', 'content' => $_GET['update_msg']];
    $redirectUrl = strtok($_SERVER["REQUEST_URI"], '?');
    echo '<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirectUrl) . '">';
    exit;
}

if (isset($_GET['delete_msg'])) {
    $_SESSION['message'] = ['type' => 'success', 'content' => $_GET['delete_msg']];
    $redirectUrl = strtok($_SERVER["REQUEST_URI"], '?');
    echo '<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirectUrl) . '">';
    exit;
}
?>

<!-- Bootstrap Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="messageText" class="fs-6 text-light"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
// JavaScript to show the modal
if (isset($_SESSION['message']) && is_array($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                const messageModal = new bootstrap.Modal(document.getElementById("messageModal"));
                const messageText = document.getElementById("messageText");
                const modalContent = document.querySelector("#messageModal .modal-content");

                // Remove existing alert classes
                modalContent.classList.remove("alert-success", "alert-danger", "alert-warning");

                // Add the appropriate alert class
                modalContent.classList.add("alert-" + "' . $msg['type'] . '");

                // Update the message text
                messageText.innerHTML = "' . htmlspecialchars($msg['content']) . '";

                // Show the modal
                messageModal.show();

                // Hide the modal and reset the title after 5 seconds
                setTimeout(function() {
                    messageModal.hide();
                }, 5000);
            });
          </script>';
    unset($_SESSION['message']);
}
?>
</body>
</html>
