<?php include('../includes/dbcon.php'); ?>
<?php include('../includes/header.php'); ?>

 <div class="py-3 text-center bg-dark text-light">
     <h1>የግዥ መጠየቂያ ፎርም</h1>
 </div>

    <div class="container mt-5">


<div class="box1 d-flex justify-content-between align-items-center">

    <h2 class="my-3">All Items</h2>

         <form method="GET" action="">
           <div class="d-flex justify-content-center align-items-end">
            <div>
                <div class="form-group mb-2">
                    <select name="order" id="order" class="form-select ">
                        <option value="asc" <?php if(isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
                        <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
                    </select>
                </div>

                <div class="form-group mb-2 input-box">
                   <input type="text" name="search" id="search" placeholder="Search item by inventory list" class="form-control">
               </div>
               
            </div>

            <button type="submit" class="btn btn-primary mb-4 ms-1">Search</button>
           </div>
        </form>
        
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal">Add Items</button>
</div>
        <table class="table table-hover table-bordered table-striped">
         
            <thead>
                <tr>
                    <th>ተራ ቁጥር</th>
                    <th>የእቃው ዝርዝር</th>
                    <th>መግለጫ</th>
                    <th>መለኪያ</th>
                    <th>ብዛት</th>
                    <th>የአንዱ ዋጋ</th>
                    <th>ጠቅላላ ዋጋ</th>
                    <th>ምርመራ</th>
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
            $query = "SELECT * FROM `Purchase` WHERE `inventory-list` LIKE '%$search%' ORDER BY `inventory-list` $order";
        } else {
            $query = "SELECT * FROM `Purchase` ORDER BY `inventory-list` $order";
        }


                    $result = mysqli_query($connection, $query);

                    if(!$result) {
                        die("query Failed".mysqli_error($connection));
                    } else {
                         // Initialize the counter variable
                        $itemCount = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                             // Increment the counter for each item
                        $itemCount++;
                            ?>

                        <tr>
                            <td><?php echo $row['ordinary-number']?></td>
                            <td><?php echo $row['inventory-list']?></td>
                            <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['description']?></td>
                            <td><?php echo $row['measure']?></td>
                            <td><?php echo $row['quantity']?></td>
                            <td><?php echo $row['price']?></td>
                            <td><?php echo $row['total-price']?></td>
                            <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['examination']?></td>
                            <td><a href="update.php?ordinary-number=<?php echo $row['ordinary-number']?>" class="btn btn-success">Update</a></td>
                            <td><a href="delete.php?ordinary-number=<?php echo $row['ordinary-number']?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                            <?php
                        }
                    }

                ?>

            </tbody>
        </table>

        <div class="text-uppercase fs-4 fw-bold text-end">Item Count : <span class="text-primary"><?php echo $itemCount; ?></span></div>

<?php include('../includes/message.php'); ?>

        <!-- Modal -->

<?php include('../includes/modal.php'); ?>
 
  <?php include('../includes/footer.php'); ?>