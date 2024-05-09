

<div class="py-3 text-center bg-dark text-light ">
    <h1>Update Department</h1>
</div>
<div class="container mt-5 w-50">
<form action="update.php?id_new=<?php echo $id; ?>" method="post">

            <div class="form-group input-box mb-2">
                     <input type="text" class="form-control" id="username" name="username" placeholder="የእቃው ዝርዝር" value="<?php echo $row['username'] ?>">
            </div>

            <div class="form-group input-box mb-2">
                     <input type="text" class="form-control" id="email" name="email" placeholder="የእቃው ዝርዝር" value="<?php echo $row['email'] ?>">
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control" id="age" name="age" placeholder="የእቃው ዝርዝር" value="<?php echo $row['age'] ?>">
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control" id="phone" name="phone" placeholder="የእቃው ዝርዝር" value="<?php echo $row['phone'] ?>">
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control" id="position" name="position" placeholder="የእቃው ዝርዝር" value="<?php echo $row['position'] ?>">
            </div>
           
             <input type="submit" class="btn btn-success" name="update_department" value="Update"></input>
</form>

