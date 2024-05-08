<?php include('../includes/dbcon.php'); ?>
<?php include('../includes/header.php'); ?>

 <div class=" py-3 text-center bg-dark text-light">
     <h1 >ሞዴል 19 ገቢ ፎርም </h1>

 </div>

    <div class="container mt-5">


        <h2 class="my-3">All ሞዴል 19 ገቢ</h2>
   
<div class="box1 d-flex justify-content-between ">

    <form method="GET" action="">
           <div class="d-flex justify-content-center align-items-center gap-5">
             <div class="form-group">
                <input type="text" name="search" id="search" placeholder="Search item by inventory list" class="form-control">
            </div>

            <div class="form-group">
                <select name="order" id="order" class="form-select ">
                      <option value="asc" <?php if(isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
                        <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
                </select>
             </div>
           
            <button type="submit" class="btn btn-primary my-3">Search</button>
           </div>
        </form>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal7">Add model_19</button>
</div>
        <table class="table table-hover table-bordered table-striped">
         
            <thead>
                <tr>
                    <th>ተራ ቁጥር</th>
                    <th>የእቃው አይነት</th>
                    <th>ሞዴል</th>
                    <th>ሴሪ</th>
                    <th>ብዛት</th>
                    <th>የአንዱ ዋጋ</th>
                    <th>ጠቅላላ ዋጋ</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Check if the user selected an ordering option
        if (isset($_GET['order']) && ($_GET['order'] == 'asc' || $_GET['order'] == 'desc')) {
            $order = $_GET['order'];
        } else {
            $order = 'asc'; // Default ordering is ascending
        }

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $query = "SELECT * FROM `model_19` WHERE `item-type` LIKE '%$search%' ORDER BY `item-type` $order";
        } else {
            $query = "SELECT * FROM `model_19` ORDER BY `item-type` $order";
        }


                    $result = mysqli_query($connection, $query);

                    if(!$result) {
                        die("query Failed".mysqli_error($connection));
                    } else {
                        // Initialize the counter variable
                        $modelCount = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                              // Increment the counter for each item
                        $modelCount++;
                            ?>

                        <tr>
                            <td><?php echo $row['ordinary-number']?></td>
                            <td><?php echo $row['item-type']?></td>
                            <td><?php echo $row['model']?></td>
                            <td><?php echo $row['serie']?></td>
                            <td><?php echo $row['quantity']?></td>
                            <td><?php echo $row['price']?></td>
                            <td><?php echo $row['total-price']?></td>
                            <td><a href="update.php?ordinary-number=<?php echo $row['ordinary-number']?>" class="btn btn-success">Update</a></td>
                            <td><a href="delete.php?ordinary-number=<?php echo $row['ordinary-number']?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                            <?php
                        }
                    }

                ?>

            </tbody>
        </table>

  <?php include('../includes/message.php'); ?>

       <div class="text-uppercase fs-4 fw-bold text-end">model_19 Count : <span class="text-primary"><?php echo $modelCount; ?></span></div>

        <!-- Modal -->
   <?php include('../includes/modal.php'); ?>

  <?php include('../includes/footer.php'); ?>