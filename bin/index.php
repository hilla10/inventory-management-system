<?php include('../includes/dbcon.php'); ?>
<?php include('header.php'); ?>
   
<div class="box1 d-flex justify-content-between ">

    <h2 class="my-3">All Bin Card</h2>
   <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal3">Add Bin</button>
</div>
        <table class="table table-hover table-bordered table-striped">
         
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ቀን</th>
                    <th>የተጠቃ.ቁጥር</th>
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

                    $query = "SELECT * FROM  `bin`";

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
                            <td><?php echo $row['number']?></td>
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