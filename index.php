<?php include('./includes/header.php'); ?>
<?php include('includes/dbcon.php'); ?>

<?php include('includes/message.php'); ?>

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

                    <div class="form-group mb-2 input-box">
                        <input type="text" class="form-control" name="username_or_email" placeholder="ስሞትን ወይም የኢሜል አድራሻዎን ያስገቡ">
                    </div>

                    <div class="form-group mb-2">
                        <label for="options" class="pb-2 text-light">ያሉበትን ሁኔታ ይምረጡ:</label>
                        <select name="options" class="form-select">
                            <option value="Admin">Admin</option>
                            <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                            <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                            <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                            <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                        </select>
                    </div>

                    <div class="form-group mb-2  input-box">
                        <input type="password" class="form-control psw" name="password" placeholder="የይለፍ ቃል">
                       <i class="fa-solid fa-eye-slash showHideBtn"></i>
                    </div>

                    <div>
                        <input type="submit" name="login" value="አስገባ" class="px-5 btn-outline my-2">
                    </div>
            </form>

            <div>
                <button id="usersBtn" class="px-5 btn-outline my-2">Sign Up</button>
            </div>
        </div>
    </div>

                                <div 
                                    id="dropdownMenuButton" aria-expanded="false">
                                </div>
                                <div aria-labelledby="dropdownMenuButton">
                                </div>

<!-- Modal -->
<?php include('includes/register_modal.php'); ?>

<!-- footer -->
<?php include('includes/footer.php'); ?>


<script>
  // Handle click event on the users button
  document.getElementById('usersBtn').addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default form submission behavior
    // Manually open the modal using its ID
    var myModal = new bootstrap.Modal(document.getElementById('ModalUserLogin'));
    myModal.show();
  });
</script>



