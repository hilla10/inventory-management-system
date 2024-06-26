

       <div class="py-2 text-center primary-color text-light">
               <h1 class="fs-3">Update Department</h1>
            <?php  $title = "Update Department"; // Set the default title

       if (isset($title) && !empty($title)) {
    echo "<script>document.title = '" . $title . "'</script>";
}
?>

        </div>
<div class="container mt-5 w-50">
<form action="update.php?id_new=<?php echo $id; ?>" method="post" class="update">

            <div class="form-group input-box mb-2">
                     <input type="text" class="form-control name" id="username" name="username" placeholder="የእቃው ዝርዝር" value="<?php echo $row['username'] ?>">
            </div>

            <div class="form-group input-box mb-2">
                     <input type="text" class="form-control email " id="email" name="email" placeholder="የእቃው ዝርዝር" value="<?php echo $row['email'] ?>">
            </div>
                <div class="form-group input-box mb-2">
                            <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                            <select name="gender" class="select-option">
                                <option value="male">ወንድ</option>
                                <option value="female">ሴት</option>
                            </select>
                        </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control age" id="age" name="age" placeholder="የእቃው ዝርዝር" value="<?php echo $row['age'] ?>">
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control phone" id="phone" name="phone" placeholder="የእቃው ዝርዝር" value="<?php echo $row['phone'] ?>">
            </div>

          <div class="form-group mb-2 input-box">
    <label for="position">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
    <select name="position" class="select-option">
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
