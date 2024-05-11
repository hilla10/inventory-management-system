<?php include('includes/header.php') ?>
<?php session_start()?>


<?php

if(isset($_SESSION['uname'])) {
    echo "<h2>Hello " . $_SESSION['uname'] . "</h2>";
} else {
    header('location:index.php?message=You need to login to enter the site');
}

?>

<a href="includes/logout_process.php" class="btn btn-danger">Logout</a>

<?php include('includes/footer.php') ?>