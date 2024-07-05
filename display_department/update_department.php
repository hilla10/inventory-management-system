<?php include('../includes/header.php') ?>

       <div class="py-2 text-center primary-color text-light">
               <h1 class="fs-3">Update Department</h1>
            <?php  $title = "Update Department"; // Set the default title

       if (isset($title) && !empty($title)) {
    echo "<script>document.title = '" . $title . "'</script>";
}
?>

        </div>
<div class="container mt-5 w-50">
<form action="update.php?id_new=<?php echo $id; ?>" method="post" class="update departmentForm form-department-content">

            <div class="form-group input-box mb-2">
                <label for="username" >Username:</label>
                <input tabindex="0" aria-label="Username" type="text" class="form-control name" id="username" name="username" placeholder="Username" value="<?php echo htmlspecialchars($row['username']); ?>">
            </div>

           
                <div class="form-group input-box mb-2">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" class="select-option" aria-label="Select gender">
                        <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>

              <div class="form-group mb-2 input-box"> <label for="age" >Age:</label>
            <input tabindex="0" aria-label="Age" type="text" class="form-control age" id="age" name="age" placeholder="Age" value="<?php echo htmlspecialchars($row['age']); ?>">
        </div>

             <div class="form-group mb-2 input-box"> 
            <label for="email" >Email:</label>
            <input tabindex="0" aria-label="Email" type="text" class="form-control email" id="email" name="email" placeholder="Email" value="<?php  echo $row['email'] ? htmlspecialchars($row['email']) : ''; ?>">
        </div>

            <div class="form-group mb-2 input-box">
             <label for="phone" >Phone:</label>
            <input tabindex="0" aria-label="Phone" type="text" class="form-control update_phone" id="phone" name="phone" placeholder="Phone" value="<?php echo $row['phone'] ? htmlspecialchars($row['phone']) : '+251 '; ?>">
        </div>

          <div class="form-group mb-2 input-box">
    <label for="position">ያሉበትን ሁኔታ ይምረጡ:|Enter your position:</label>
    <select name="position" id="position" class="select-option" aria-label="Select position">
        <option value="it head" <?php if ($row['position'] == 'it head') echo 'selected'; ?>>የአይቲ ዲፓርትመንት ሄድ</option>
        <option value="business head" <?php if ($row['position'] == 'business head') echo 'selected'; ?>>የቢዝነስ ዲፓርትመንት ሄድ</option>
        <option value="art head" <?php if ($row['position'] == 'art head') echo 'selected'; ?>>የአርት ዲፓርትመንት ሄድ</option>
        <option value="auto head" <?php if ($row['position'] == 'auto head') echo 'selected'; ?>>የአውቶ ዲፓርትመንት ሄድ</option>
    </select><br><br>
</div>
           
             <input type="submit" class="btn btn-success" name="update_department" value="Update"></input>
</form>


    <!-- Modal -->
<?php include('../includes/modal.php'); ?>

<?php include('../includes/footer.php'); ?>