<?php include('login/header.php'); ?>

<div class="container w-50" style="margin-top: 5rem;">
    <div class="card border-primary-subtle rounded-3 border-2 mt-5 shadow login-card" style="background: #175374;">
        <div class="card-body">
            <form method="post" action="./login/login_process.php">
                <div class="container">
                    <h1 class="text-center text-light fw-semibold p-2">Login Form</h1>
                    <?php
                    $title = "Login Form"; // Set the default title

                    if (isset($title) && !empty($title)) {
                        echo "<script>document.title = '" . $title . "'</script>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['message'])) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                        echo '<strong class="text-dark">' . $_GET['message'] . '</strong>';
                        header('Refresh: 2; URL=index.php');
                        exit;
                    }
                    ?>

                    <div class="form-group mb-2 input-box">
                        <input type="text" class="form-control" name="username_or_email" placeholder="ስሞትን ወይም የኢሜል አድራሻዎን ያስገቡ">
                    </div>

                    <div class="form-group mb-2">
                        <label for="options" class="pb-2 text-light">ያሉበትን ሁኔታ ይምረጡ:</label>
                        <select name="options" class="form-select">
                            <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                            <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                            <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                            <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                        </select>
                    </div>

                    <div class="form-group mb-2  input-box">
                        <input type="password" class="form-control" name="password" placeholder="የይለፍ ቃል">
                    </div>

                    <div>
                        <input type="submit" name="login" value="አስገባ" class="px-5 btn-outline my-2">
                    </div>
            </form>

            <div>
                <button id="registerBtn" class="px-5 btn-outline my-2">Register</button>
            </div>
        </div>
    </div>

<?php include('includes/modal.php'); ?>
<?php include('includes/message.php'); ?>
<?php include('includes/footer.php'); ?>

<script>
    // Handle click event on the register button
    document.getElementById('registerBtn').addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the default form submission behavior
        // Manually open the modal using its ID
        var myModal = new bootstrap.Modal(document.getElementById('Modal5'));
        myModal.show();
    });
</script>
