


    <?php
include('../includes/dbcon.php');
include('../includes/header.php');

                $title = "Update Bin Card"; 
                    if (isset($title) && !empty($title)) {
                        echo "<script>document.title = '" . $title . "'</script>";
                    } else {
                       echo "<script>document.title = 'inventory '</script>";
                    }

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


    if(isset($_POST['update_items'])) {

        if(isset($_GET['id_new'])) {
            $new_id = $_GET['id_new'];
        }

   $date = $_POST['date'];
    $income = $_POST['income'];
    $cost = $_POST['cost'];
    $short = $_POST['short'];
    

        $query = "UPDATE `bin` set `date` = '$date',`income` = '$income', `cost` = '$cost', `short` = '$short' WHERE `id` = '$new_id'";

          $result = mysqli_query($connection, $query);

            if (!$result) {
            die("query Failed" . mysqli_error($connection));
        } else {

            header('location: index.php?update_msg=You have successfully updated the data');

        }
        
    }

?>

    <div class="py-2 text-light primary-color mx-auto">
        <h1 class="text-center fs-3">Update Bin Card</h1>
    </div>


<div class="container mt-5 w-50">
    
<form action="update.php?id_new=<?php echo $id; ?>" method="post" class="update insert-binCard-form shake-bin-content">

            <div class="form-group input-box mb-2">
                     <input type="date" class="form-control date" id="date" name="date" placeholder="ቀን" value="<?php echo $row['date'] ?>">
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control income" id="income" name="income" placeholder="ገቢ" value="<?php echo $row['income'] ?>">
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control cost" id="cost" name="cost" placeholder="ወጪ" value="<?php echo $row['cost'] ?>">
            </div>


            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control remain" id="remain" name="remain" placeholder="ከወጪ ቀሪ" value="<?php echo $row['remain'] ?>" readonly>
            </div>

            <div class="form-group input-box mb-2">
               
                     <input type="text" class="form-control short" id="short" name="short" placeholder="አጭር ፈር" value="<?php echo $row['short'] ?>">
            </div>

           
             <input type="submit" class="btn btn-success" name="update_items" value="Update"></input>
</form>

</div>


  <?php include('../includes/footer.php'); ?>