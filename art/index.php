<?php include('../includes/header.php'); ?>
<?php include('../includes/dbcon.php'); ?>


<nav class="navbar navbar-expand-lg d-flex align-items-center bg-dark-blue">
  <div class="container">
    <a class="navbar-brand" href="../auto/index.php">
        <img src="../logo.png" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto ">
        <li class="nav-item">
          <a class="nav-link link-light link-opacity-50-hover" href="#"  data-bs-toggle="modal" data-bs-target="#Modal2">Add Department</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-light link-opacity-50-hover" href="#" data-bs-toggle="modal" data-bs-target="#Modal1">Add User</a>
        </li>

      </ul>
      <div class="d-flex">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
               <a href="../login/logout_process.php" class="btn btn-danger m-2 me-3">Logout</a>
        </li>
    </ul>
      </div>
    </div>
  </div>
</nav>

 <div class=" py-3 text-center">
     <h1>Art Department</h1>

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

                <div class="form-group mb-2">
                   <input type="text" name="search" id="search" placeholder="Search item by inventory list" class="form-control">
               </div>
               

            </div>

            <button type="submit" class="btn btn-primary mb-2 ms-1">Search</button>
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
            $query = "SELECT * FROM `art_department` WHERE `inventory-list` LIKE '%$search%' ORDER BY `inventory-list` $order";
        } else {
            $query = "SELECT * FROM `art_department` ORDER BY `inventory-list` $order";
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