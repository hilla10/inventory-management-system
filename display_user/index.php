<?php include('../includes/dbcon.php'); ?>
<?php include('../includes/header.php'); ?>

<?php
session_start();

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['username']) || $_SESSION['options'] !== 'it head') {

    // Redirect to specific pages based on the role
    if ($_SESSION['options'] === 'business head') {
        header('Location: ../business/index.php');
        exit();
    } elseif ($_SESSION['options'] === 'art head') {
        header('Location: ../art/index.php');
        exit();
    } elseif ($_SESSION['options'] === 'auto head') {
        header('Location: ../auto/index.php');
        exit();
    }
}
?>

<div class=" py-3 text-center bg-dark text-light">
    <h1>Display All User</h1>
        <?php
        $title = "Display All User"; // Set the default title

if (isset($title) && !empty($title)) {
    echo "<script>document.title = '" . $title . "'</script>";
}
?>
</div>

<div class="container mt-5">
    
<div class="box1 d-flex flex-md-row flex-column justify-content-between align-items-center">

        <h2 class="my-3 text-center">All User</h2>
        <form method="GET" action="">
           <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center align-items-md-end">
                <div>
                <div class="d-flex gap-4">
                    <div class="form-group mb-2">
                        <select name="field" class="form-select">
                            <option value="select field">Select field</option>
                            <option value="username" <?php if(isset($_GET['field']) && $_GET['field'] == 'username') echo 'selected'; ?>>Username</option>
                            <option value="gender" <?php if(isset($_GET['field']) && $_GET['field'] == 'gender') echo 'selected'; ?>>Gender</option>
                            <option value="age" <?php if(isset($_GET['field']) && $_GET['field'] == 'age') echo 'selected'; ?>>Age</option>
                            <option value="email" <?php if(isset($_GET['field']) && $_GET['field'] == 'email') echo 'selected'; ?>>Email</option>
                            <option value="Phone" <?php if(isset($_GET['field']) && $_GET['field'] == 'Phone') echo 'selected'; ?>>Phone</option>
                            <option value="options" <?php if(isset($_GET['field']) && $_GET['field'] == 'options') echo 'selected'; ?>>Options</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                            <select name="order" id="order" class="form-select ">
                                <option value="asc" <?php if(isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
                                <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
                            </select>
                        </div>
                </div>
                        <div class="form-group input-box">
                        <input type="text" name="search" id="search" placeholder="Search user" class="form-control search">
                    </div>
                </div>
        <button type="submit" class="btn btn-primary my-3 ms-1">Search</button>
    </div>
        </form>
        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal1">Add User</button>
    </div>
    
<div class="table-responsive">
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
            $userCount = 0;
            $errors = [];
            // Check if the user selected an ordering option
            if (isset($_GET['order']) && ($_GET['order'] == 'asc' || $_GET['order'] == 'desc')) {
                $order = $_GET['order'];
            } else {
                $order = 'asc'; // Default ordering is ascending
            }
            if (isset($_GET['search']) && !empty($_GET['search']) && isset($_GET['field']) && !empty($_GET['field']) && $_GET['field'] != 'select field') {
                $search = $_GET['search'];
                $field = $_GET['field'];
                $query = "SELECT * FROM `register` WHERE `$field` LIKE '%$search%' ORDER BY username $order";
            } else {
                // Display a message if the user didn't select a field or selected "select field" and clicked the submit button
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $errors[] = "Please select a valid field to search the user.";
                }
                $query = "SELECT * FROM `register` ORDER BY username $order";
            }

            if(!empty($errors)) {
                $message = implode(" ", $errors);
                header('location: index.php?message=' . urldecode($message));
            }

            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query failed" . mysqli_error($connection));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userCount++;
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['age'] ?></td>
                        <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['email'] ?></td>
                        <td><?php echo $row['Phone'] ?></td>
                        <td><?php echo $row['options'] ?></td>
                        <td><a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Update</a></td>
                        <td><a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"  onclick="return confirmDelete()">Delete</a></td>
                        
                                <script>
                                function confirmDelete() {
                                return confirm("Are you sure you want to delete the record?");
                                }
                                </script>
                    </tr>
                <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

    <div class="text-uppercase fs-4 fw-bold text-end">User Count : <span class="text-primary"><?php echo $userCount; ?></span></div>

         <!-- message -->
  <?php include('../includes/message.php'); ?>

    <!-- Modal -->
    <?php include('../includes/modal.php'); ?>

    <?php include('../includes/footer.php'); ?>