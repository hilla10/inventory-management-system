<?php include('../includes/dbcon.php'); ?>
<?php include('header.php'); ?>
   
<div class="box1 d-flex justify-content-between align-items-center">

    <h2 class="my-3 text-light">All Bin Card</h2>

     <form method="GET" action="">
           <div class="d-flex justify-content-center align-items-end">
            <div>
                <div class="form-group mb-2">
                    <select name="order" id="order" class="form-select ">
                        <option value="asc" <?php if(isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
                        <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                   <input type="text" name="search" id="search" placeholder="Search item by inventory list" class="form-control">
               </div>
               

            </div>

            <button type="submit" class="btn btn-primary mb-2 ms-1">Search</button>
           </div>
        </form>

   <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal3">Add Bin</button>
</div>
        <table class="table table-hover table-bordered table-striped">
         
            <thead>
                <tr>
                    <th>የተጠቃ.ቁጥር</th>
                    <th>ቀን</th>
                    <th>ገቢ</th>
                    <th>ወጪ</th>
                    <th>ከወጪ ቀሪ</th>
                    <th>አጭር ፈር</th>
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
            $query = "SELECT * FROM `bin` WHERE `date` LIKE '%$search%' ORDER BY `date` $order";
        } else {
            $query = "SELECT * FROM `bin` ORDER BY `date` $order";
        }

                    $result = mysqli_query($connection, $query);

                    if(!$result) {
                        die("query Failed".mysqli_error($connection));
                    } else {
                          // Initialize the counter variable
                        $binCount = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                              // Increment the counter for each item
                        $binCount++;
                            ?>

                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['date']?></td>
                            <td><?php echo $row['income']?></td>
                            <td><?php echo $row['cost']?></td>
                            <td><?php echo $row['remain']?></td>
                            <td><?php echo $row['short']?></td>
                            
                            <td><a href="update.php?id=<?php echo $row['id']?>" class="btn btn-success">Update</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                            <?php
                        }
                    }

                ?>

            </tbody>
        </table>

        <div class="text-uppercase fs-4 fw-bold text-end">Bin Count : <span class="text-primary"><?php echo $binCount; ?></span></div>

 <?php include('../includes/message.php'); ?>

     <!-- Modal -->
<?php include('../includes/modal.php'); ?>

  <?php include('../includes/footer.php'); ?>