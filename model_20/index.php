<?php include('../includes/dbcon.php'); ?>
<?php include('../includes/header.php'); ?>

 <div class=" py-3 text-center bg-dark text-light">
     <h1 >የግዥ መጠየቂያ ፎርም
      </h1>

 </div>

    <div class="container mt-5">


   
<div class="box1 d-flex justify-content-between ">

    <h2 class="my-3">All ሞዴል 20 ወጪ</h2>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal6">Add model_20</button>
</div>
        <table class="table table-hover table-bordered table-striped">
         
            <thead>
                <tr>
                    <th>ተራ ቁጥር</th>
                    <th>ብዛት</th>
                    <th>የእቃው አይነት</th>
                    <th>ሞዴል</th>
                    <th>ማሻሻያ</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM  `model_20`";

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
                            <td><?php echo $row['quantity']?></td>
                            <td><?php echo $row['item-type']?></td>
                            <td><?php echo $row['model']?></td>
                            <td><?php echo $row['update']?></td>
                            <td><a href="update.php?ordinary-number=<?php echo $row['ordinary-number']?>" class="btn btn-success">Update</a></td>
                            <td><a href="delete.php?ordinary-number=<?php echo $row['ordinary-number']?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                            <?php
                        }
                    }

                ?>

            </tbody>
        </table>

        <div class="text-uppercase fs-4 fw-bold text-end">model_20 Count : <span class="text-primary"><?php echo $modelCount; ?></span></div>

  <?php include('../includes/message.php'); ?>
    
     <!-- Modal -->
   <?php include('../includes/modal.php'); ?>

  <?php include('../includes/footer.php'); ?>