<?php
if (isset($_GET['message'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
    echo '<strong class="text-dark">' . $_GET['message'] . '</strong>';
    echo '</div>';
    // Remove the message from the URL
    $redirectUrl = 'index.php';
    echo '<meta http-equiv="refresh" content="3;URL=' . $redirectUrl . '">';
    exit;
}
?>

<?php
if (isset($_GET['insert_msg'])) {
    echo '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">';
    echo '<strong class="text-dark">' . $_GET['insert_msg'] . '</strong>';
    echo '</div>';
    // Remove the message from the URL
    $redirectUrl = 'index.php';
    echo '<meta http-equiv="refresh" content="3;URL=' . $redirectUrl . '">';
    exit;
}
?>

<?php
if (isset($_GET['update_msg'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo '<strong class="text-dark">' . $_GET['update_msg'] . '</strong>';
    echo '</div>';
    // Remove the message from the URL
    $redirectUrl = 'index.php';
    echo '<meta http-equiv="refresh" content="3;URL=' . $redirectUrl . '">';
    exit;
}
?>

<?php
if (isset($_GET['delete_msg'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo '<strong class="text-dark">' . $_GET['delete_msg'] . '</strong>';
    echo '</div>';
    // Remove the message from the URL
    $redirectUrl = 'index.php';
    echo '<meta http-equiv="refresh" content="3;URL=' . $redirectUrl . '">';
    exit;
}
?>