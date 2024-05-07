<?php include('header.php'); ?>
<?php include('../includes/dbcon.php'); ?>

    <?php


    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM  `bin` WHERE `id` = '$id'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php 

    if(isset($_POST['update_items'])) {

        if(isset($_GET['id_new'])) {
            $new_id = $_GET['id_new'];
        }

   $date = $_POST['date'];
    $number = $_POST['number'];
    $income = $_POST['income'];
    $cost = $_POST['cost'];
    $remain = $_POST['remain'];
    $short = $_POST['short'];
    

        $query = "UPDATE `bin` set `date` = '$date', `number` = '$number', `income` = '$income', `cost` = '$cost', `remain` = '$remain', `short` = '$short' WHERE `id` = '$new_id'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>


<form action="update.php?id_new=<?php echo $id; ?>" method="post">

            <div class="form-group mb-2">
                     <input type="date" class="form-control" id="date" name="date" placeholder="ቀን" value="<?php echo $row['date'] ?>">
            </div>

            <div class="form-group mb-2">
                     <input type="number" class="form-control" id="number" name="number" placeholder="የተጠቃ.ቁጥር" value="<?php echo $row['number'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="number" class="form-control" id="income" name="income" placeholder="ገቢ" value="<?php echo $row['income'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="number" class="form-control" id="cost" name="cost" placeholder="ወጪ" value="<?php echo $row['cost'] ?>">
            </div>


            <div class="form-group mb-2">
               
                     <input type="number" class="form-control" id="remain" name="remain" placeholder="ከወጪ ቀሪ" value="<?php echo $row['remain'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="number" class="form-control" id="short" name="short" placeholder="አጭር ፈር" value="<?php echo $row['short'] ?>">
            </div>

           
             <input type="submit" class="btn btn-success" name="update_items" value="Update"></input>
</form>



  <?php include('../includes/footer.php'); ?>