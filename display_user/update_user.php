

<div class="py-3 text-center bg-dark text-light ">
     <h1>Update User</h1>
 </div>
 
   <div class="container mt-5 w-50">
<form action="update.php?id_new=<?php echo $id; ?>" method="post">

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="username" name="username" placeholder="የእቃው ዝርዝር" value="<?php echo $row['username'] ?>">
            </div>

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="gender" name="gender" placeholder="የእቃው ዝርዝር" value="<?php echo $row['gender'] ?>">
            </div>

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="age" name="age" placeholder="የእቃው ዝርዝር" value="<?php echo $row['age'] ?>">
            </div>

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="email" name="email" placeholder="የእቃው ዝርዝር" value="<?php echo $row['email'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="phone" name="phone" placeholder="የእቃው ዝርዝር" value="<?php echo $row['Phone'] ?>">
            </div>
<div class="form-group">
    <label for="options">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
    <select name="options" class="form-select">
        <option value="it head" <?php if ($row['options'] == 'it head') echo 'selected'; ?>>የአይቲ ዲፓርትመንት ሄድ</option>
        <option value="business head" <?php if ($row['options'] == 'business head') echo 'selected'; ?>>የቢዝነስ ዲፓርትመንት ሄድ</option>
        <option value="art head" <?php if ($row['options'] == 'art head') echo 'selected'; ?>>የአርት ዲፓርትመንት ሄድ</option>
        <option value="auto head" <?php if ($row['options'] == 'auto head') echo 'selected'; ?>>የአውቶ ዲፓርትመንት ሄድ</option>
    </select><br><br>
</div>
             <input type="submit" class="btn btn-success" name="update_user" value="Update"></input>
</form>


