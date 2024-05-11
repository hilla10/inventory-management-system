<?php include('./includes/header.php'); ?>

<?php

    if(isset($_GET['message'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo '<strong class="text-dark">' .$_GET['message'] . '</strong>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } 

?>

<form class="form" action="./includes/login_process.php" method="post">
    <div class="form-group">
        <label for="uname"  class="form-label">Username</label>
        <input type="text" name="uname" class="form-control">
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control">
    </div>

    <div class="form-group">
        
        <input type="submit" name="login" value="Login" class="btn btn-success my-2">
    </div>
</form>



<?php include ('./includes/footer.php'); ?>

