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
                        <label for="username_or_email" class="visually-hidden">ስሞትን ወይም የኢሜል አድራሻዎን ያስገቡ:</label>
                        <input type="text" class="form-control" id="username_or_email" name="username_or_email" placeholder="ስሞትን ወይም የኢሜል አድራሻዎን ያስገቡ" aria-label="Enter Email | Username">
                    </div>

                   <div class="form-group mb-2">
                    <label for="options" class="pb-2 text-light" id="optionsLabel">ያሉበትን ሁኔታ ይምረጡ:</label>
                    <select id="options" name="options" class="form-select" aria-labelledby="optionsLabel">
                        <option value="Admin">Admin</option>
                        <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                        <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                        <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                        <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                    </select>
                </div>


                    <div class="form-group mb-2 input-box">
                        <label for="password" class="visually-hidden psw">የይለፍ ቃል:</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="የይለፍ ቃል" aria-label="የይለፍ ቃል">
                         <i class="fa-solid fa-eye-slash showHideBtn" tabindex="0"></i>
                    </div>
                    <div class="form-group mb-2 input-box w-50">
                        <input type="submit" name="login" value="አስገባ" class="px-5 btn-outline my-2 py-2" tabindex="0">
                    </div>
            </form>

            <div class="form-group mb-2 input-box w-50">
                <button id="usersBtn" class="px-5 btn-outline my-2" tabindex="0">Sign Up</button>
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



