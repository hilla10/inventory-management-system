
<?php include('login/header.php'); ?>

    <div class="container w-50" style="margin-top: 7rem;">

    <div class="card  border-primary-subtle rounded-3 border-2 mt-5 shadow">
        <div class="card-body">
            
    <form method="post" action="./login/login_process.php">
        <div class="container">
            <h1 class="text-center text-body-tertiary fw-semibold p-3">Login Form</h1>
       
<?php

    if(isset($_GET['message'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo '<strong class="text-dark">' .$_GET['message'] . '</strong>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
          header('Refresh: 2; URL=index.php');
    exit;
    } 

?>

              <div class="form-group mb-2">
                <input type="text" class="form-control" name="username" placeholder="ስሞትን ያስገቡ">
              </div>
             
              <div class="form-group mb-2">
                <label for="position" class="pb-2">ያሉበትን ሁኔታ ይምረጡ:</label>
              <select name="options" class="form-select">
                  <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                  <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                  <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                  <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
              </select>
              </div>

            <div class="form-group mb-2">
                <input type="password" class="form-control" name="password" placeholder=" የይለፍ ቃል" >
           </div>
            <div>
                  <input type="submit" name="login" value="አስገባ" class="btn btn-success my-2">
          </div>
    </form>

        </div>
    </div>

<?php include ('./login/footer.php'); ?>
