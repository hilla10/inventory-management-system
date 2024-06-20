<?php
    if(isset($_GET['message'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo '<strong class="text-dark">' .$_GET['message'] . '</strong>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } 
?>

<?php
    if(isset($_GET['insert_msg'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<strong class="text-dark">' .$_GET['insert_msg'] . '</strong>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } 
?>

<?php
    if(isset($_GET['update_msg'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<strong class="text-dark">' .$_GET['update_msg'] . '</strong>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } 
?>

<?php
    if(isset($_GET['delete_msg'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<strong class="text-dark">' .$_GET['delete_msg'] . '</strong>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } 
?>
    