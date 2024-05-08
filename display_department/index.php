<?php
include('../includes/dbcon.php');
include('../includes/header.php');
?>

<div class="d-flex py-3 text-center bg-dark text-light justify-content-between">
    <h1 class="col-md-8">Display All Department</h1>
</div>

<div class="container mt-5">
    <h2 class="my-3">All Department</h2>

    <div class="box1 d-flex justify-content-between ">
        <form method="GET" action="">
            <div class="d-flex justify-content-center align-items-center gap-5">
                <div class="form-group">
                    <input type="text" name="search" id="search" placeholder="Search department" class="form-control">
                </div>
                <div class="form-group">
                    <select name="field">
                        <option value="username" <?php if(isset($_GET['field']) && $_GET['field'] == 'username') echo 'selected'; ?>>Username</option>
                        <option value="email" <?php if(isset($_GET['field']) && $_GET['field'] == 'email') echo 'selected'; ?>>Email</option>
                        <option value="age" <?php if(isset($_GET['field']) && $_GET['field'] == 'age') echo 'selected'; ?>>Age</option>
                        <option value="Phone" <?php if(isset($_GET['field']) && $_GET['field'] == 'Phone') echo 'selected'; ?>>Phone</option>
                        <option value="position" <?php if(isset($_GET['field']) && $_GET['field'] == 'position') echo 'selected'; ?>>Position</option>
                    </select>
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
        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal2">Add Department</button>
    </div>

    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>ተራ ቁጥር</th>
                <th>ስም</th>
                <th>ኢሜል</th>
                <th>አድሜ</th>
                <th>ስልክ ቁጥር</th>
                <th>ያሉበትን ሁኔታ</th>
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

            if (isset($_GET['search']) && !empty($_GET['search']) && isset($_GET['field']) && !empty($_GET['field'])) {
                $search = $_GET['search'];
                $field = $_GET['field'];
                $query = "SELECT * FROM `department_registration` WHERE $field LIKE '%$search%' ORDER BY username $order";
            } else {
                $query = "SELECT * FROM `department_registration`  ORDER BY username $order";
            }


            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query Failed" . mysqli_error($connection));
            } else {
                // Initialize the counter variable
                $departmentCount = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    // Increment the counter for each item
                    $departmentCount++;
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['email'] ?></td>
                       <td><?php echo $row['age'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['position'] ?></td>
                        <td><a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Update</a></td>
                        <td><a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <div class="text-uppercase fs-4 fw-bold text-end">Department Count : <span class="text-primary"><?php echo $departmentCount; ?></span></div>
</div>

<!-- Modal -->
<?php include('../includes/modal.php'); ?>
<?php include('../includes/message.php'); ?>
<?php include('../includes/footer.php'); ?>