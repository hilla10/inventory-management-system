<?php include('../includes/dbcon.php'); ?>
<?php include('../includes/header.php'); ?>

 <div class=" py-3 text-center bg-dark text-light">
     <h1 class="col-md-8">Display All User</h1>

 </div>
 
   <div class="container mt-5">

<div class="box1 d-flex justify-content-between ">

    <h2 class="my-3">All User</h2>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal1">Add User</button>
</div>
<table class="table table-hover table-bordered table-striped">

    <thead>
        <tr>
            <th>ተራ ቁጥር</th>
            <th>ስም</th>
            <th>ጾታ</th>
            <th>አድሜ</th>
            <th>ኢሜል</th>
            <th> ስልክ ቁጥር </th>
            <th>ያሉበትን ሁኔታ</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php

                    $query = "SELECT * FROM  `register`";

                    $result = mysqli_query($connection, $query);

                    if(!$result) {
                        die("query Failed".mysqli_error($connection));
                    } else {
                        // Initialize the counter variable
                        $userCount = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                              // Increment the counter for each item
                        $userCount++;
                            ?>

        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['gender']?></td>
            <td><?php echo $row['age']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['Phone']?></td>
            <td><?php echo $row['options']?></td>
            <td><a href="update.php?id=<?php echo $row['id']?>" class="btn btn-success">Update</a></td>
            <td><a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
                        }
                    }

                ?>

    </tbody>
</table> 

<div class="text-uppercase fs-4 fw-bold text-end">User Count : <span class="text-primary"><?php echo $userCount; ?></span></div>


<?php include('../includes/message.php'); ?>

<!-- Modal -->

<?php include('../includes/modal.php'); ?>

<?php include('../includes/footer.php'); ?>