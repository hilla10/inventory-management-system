<?php
// Include necessary files
include('../includes/dbcon.php');
include("../includes/auth.php");
include('../includes/header.php');

// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include insert_app.php to access determineCurrentPage() function
include('../includes/determineFnc.php');

// Determine the current page
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);

// Store the current page URL in a session variable
$_SESSION['currentPage'] = $currentPage;

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';
echo $_SESSION['currentPage'];
?>

<header class="main-header">
    <div>
        <?php
        if ($userRole == 'admin') {
            echo "<a href=\"../admin/index.php\" class=\"logo\" aria-current=\"page\">";
            echo " <img src=\"../img/EPTC_logo\" alt=\"logo\">";
            echo "</a>";
        }
        ?>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa-solid fa-bars-staggered"></i>
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </div>
    <nav class="navbar navbar-expand-lg d-flex align-items-center bg-dark-blue navbar-toggle">
        <div class="hamburger">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="container">
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                <div class="py-2 text-center mx-auto">
            <h1 class="fs-3">የግዥ መጠየቂያ ፎርም</h1>
           
        </div>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li>
                            <div class="dropdown nav-item">
                                <a class="btn btn-info dropdown-toggle me-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                    if ($userRole == 'admin') {
                                        echo 'Admin';
                                    }
                                    ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-danger fw-bold" href="../login/logout_process.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="d-flex justify-content-between mt-4 pt-5">
    <?php include('../includes/navigation.php'); ?>

    <div class="flex-grow-1 main-content">
        
 <?php
            $title = "የግዥ መጠየቂያ ፎርም"; // Set the default title
            if (isset($title) && !empty($title)) {
                echo "<script>document.title = '" . $title . "'</script>";
            }
            ?>
        <div class="container mt-4">
            <div class="box1 d-flex flex-md-row flex-column justify-content-between align-items-center">
                <form method="GET" action="">
                    <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center align-items-md-end">
                        <div>
                            <div class="form-group mb-2">
                                <select name="order" id="order" class="form-select">
                                    <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
                                    <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
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

            <?php
            // Check if the user selected an ordering option
            if (isset($_GET['order']) && ($_GET['order'] == 'asc' || $_GET['order'] == 'desc')) {
                $order = $_GET['order'];
            } else {
                $order = 'asc'; // Default ordering is ascending
            }

            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $_GET['search'];
                $query = "SELECT * FROM `inventory`
                          AND `inventory-list` LIKE '%$search%'
                          ORDER BY `inventory-list` $order";
            } else {
                $query = "SELECT * FROM `inventory`
                          ORDER BY `inventory-list` $order";
            }

            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            } else {
                if (mysqli_num_rows($result) > 0) {
                    // Initialize the counter variable
                    $itemCount = 0;
            ?>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ተራ ቁጥር</th>
                            <th>ዲፖርትመንት</th>
                            <th>የእቃው ዝርዝር</th>
                            <th>የእቃው አይነት</th>
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
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Increment the counter for each item
                            $itemCount++;
                        ?>
                        <tr>
                            <td><?php echo $row['ordinary-number']?></td>
                            <td><?php echo $row['department']?></td>
                            <td><?php echo $row['inventory-list']?></td>
                            <td><?php echo $row['item-type']?></td>
                            <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['description']?></td>
                            <td><?php echo $row['measure']?></td>
                            <td><?php echo $row['quantity']?></td>
                            <td><?php echo $row['price']?></td>
                            <td><?php echo $row['total-price']?></td>
                            <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['examination']?></td>
                            <td><a href="../includes/update.php?ordinary-number=<?php echo $row['ordinary-number']?>&department=<?php echo $row['department']; ?>" class="btn btn-success">Update</a></td>
                            <td>
                                <a href="../includes/delete.php?ordinary-number=<?php echo $row['ordinary-number']; ?>&department=<?php echo $row['department']; ?>" class="btn btn-danger" onclick="return confirmDelete('<?php echo $row['ordinary-number']; ?>', '<?php echo htmlspecialchars($row['inventory-list']); ?>')">Delete</a>
                            </td>
                        </tr>
                        <script>
                            function confirmDelete(ordinaryNumber, inventoryList) {
                                return confirm("Are you sure you want to delete the record?\n\nOrdinary Number: " + ordinaryNumber + "\nInventory List: " + inventoryList);
                            }
                        </script>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="text-uppercase fs-4 fw-bold text-end">Item Count : <span class="text-primary"><?php echo $itemCount; ?></span></div>
            <?php
                } else {
                   echo "<div class='alert alert-info text-center w-70 m-3'><strong class='fs-3 text-light'>No items found in the database.</strong></div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- message -->
<?php include('../includes/message.php'); ?>

<!-- Modal -->
<?php include('../includes/modal.php'); ?>

<?php include('../includes/update.php'); ?>


<?php include('../includes/footer.php'); ?>
