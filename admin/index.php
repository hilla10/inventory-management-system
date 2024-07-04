<?php
// Include necessary files
include('../includes/dbcon.php');
include("../includes/auth.php");
include('../includes/header.php');

// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Determine the current page
include ('../includes/determineFnc.php');

// Determine the current page
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);

// Store the current page URL in a session variable
$_SESSION['currentPage'] = $currentPage;

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';

// Query to get the total number of items in the inventory
$query = "SELECT COUNT(*) as total_items FROM `inventory`";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalItems = $row['total_items'];

// Query to get the total number of consumable items
$queryConsumableItems = "SELECT COUNT(*) as total_consumable_items FROM `inventory` WHERE `item_category` = 'consumable'";
$resultConsumableItems = mysqli_query($connection, $queryConsumableItems);
$rowConsumableItems = mysqli_fetch_assoc($resultConsumableItems);
$totalConsumableItems = $rowConsumableItems['total_consumable_items'];

// Query to get the total number of non-consumable items
$queryNonConsumableItems = "SELECT COUNT(*) as total_non_consumable_items FROM `inventory` WHERE `item_category` = 'non-consumable'";
$resultNonConsumableItems = mysqli_query($connection, $queryNonConsumableItems);
$rowNonConsumableItems = mysqli_fetch_assoc($resultNonConsumableItems);
$totalNonConsumableItems = $rowNonConsumableItems['total_non_consumable_items'];

// Query to get the total number of bin cards items
$queryBinCard = "SELECT COUNT(*) as total_bin FROM `bin`";
$resultBinCard = mysqli_query($connection, $queryBinCard);
$rowBinCard = mysqli_fetch_assoc($resultBinCard);
$totalBinCard = $rowBinCard['total_bin'];

// Query to get the total number of Model 19 items
$queryModel19 = "SELECT COUNT(*) as total_model_19 FROM `model_19`";
$resultModel19 = mysqli_query($connection, $queryModel19);
$rowModel19 = mysqli_fetch_assoc($resultModel19);
$totalModel19 = $rowModel19['total_model_19'];

// Query to get the total number of Model 20 items
$queryModel20 = "SELECT COUNT(*) as total_model_20 FROM `model_20`";
$resultModel20 = mysqli_query($connection, $queryModel20);
$rowModel20 = mysqli_fetch_assoc($resultModel20);
$totalModel20 = $rowModel20['total_model_20'];

// Query to get the count of pending items and the users who requested them model 19
$queryPendingRequests = "SELECT requested_by FROM model_20 WHERE status = 'pending'";
$resultPendingRequests = mysqli_query($connection, $queryPendingRequests);

// Query to get the count of pending items and the users who requested them model 20
$queryPendingAdded = "SELECT added_by FROM model_19 WHERE status = 'pending'";
$resultPendingAdded = mysqli_query($connection, $queryPendingAdded);

if (!$resultPendingRequests) {
    die("Database query failed: " . mysqli_error($connection));
}

if (!$resultPendingAdded) {
    die("Database query failed: " . mysqli_error($connection));
}

// Initialize variables for pending requests notifications model 20
$pendingRequestsNotifications = [];
$pendingCount = 0;

// Initialize variables for pending added notifications model 19
$pendingAddedNotifications = [];
$pendingAddedCount = 0;

// Fetch the pending requests notifications
while ($rowPendingRequests = mysqli_fetch_assoc($resultPendingRequests)) {
    $requestedBy = $rowPendingRequests['requested_by'];
    $pendingRequestsNotifications[] = "New item requested by: $requestedBy.";
    $pendingCount++;
}

// Fetch the pending requests notifications
while ($rowPendingAdded = mysqli_fetch_assoc($resultPendingAdded)) {
    $addedBy = $rowPendingAdded['added_by'];
    $pendingAddedNotifications[] = "New item Added by: $addedBy.";
    $pendingAddedCount++;
}

// Free result set
mysqli_free_result($resultPendingRequests);
mysqli_free_result($resultPendingAdded);

// Query to get the count of low stock items in each department
$queryLowStockItems = "
    SELECT department, COUNT(*) as low_stock_count 
    FROM `inventory` 
    WHERE `item_category` = 'consumable' AND `quantity` < 5 
    GROUP BY department
";
$resultLowStockItems = mysqli_query($connection, $queryLowStockItems);

if (!$resultLowStockItems) {
    die("Database query failed: " . mysqli_error($connection));
}

// Initialize variables for low stock notifications
$lowStockNotifications = [];
$totalLowStockCount = 0;

// Fetch the low stock notifications
while ($rowLowStockItems = mysqli_fetch_assoc($resultLowStockItems)) {
    $department = $rowLowStockItems['department'];
    $link = strtolower($rowLowStockItems['department']);
    $lowStockCount = $rowLowStockItems['low_stock_count'];
    $lowStockNotifications[] = "$department department is out of items.";
    $totalLowStockCount += $lowStockCount;
}

// Free result set
mysqli_free_result($resultLowStockItems);

// Total notification count
$totalNotifications = $pendingCount + $totalLowStockCount + $pendingAddedCount;
?>

<header class="main-header">

    <div>
        <a href="index.php" class="logo">
            <img src="../img/EPTC_logo" alt="logo">
        </a>

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
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link link-light link-opacity-50-hover" href="#" data-bs-toggle="modal"
                            data-bs-target="#ModalDepartment">Add Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light link-opacity-50-hover" href="#" data-bs-toggle="modal"
                            data-bs-target="#ModalUser">Add User</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <button type="button" class="btn mb-3 mb-lg-0 me-3 position-relative"
                                data-bs-toggle="modal" data-bs-target="#notificationModal">
                                <i class="fa-solid fa-bell fs-4 text-light"></i>
                                <span class="message_count"><?php echo $totalNotifications; ?></span>
                            </button>

                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-danger mb-3 mb-lg-0  me-3" data-bs-toggle="modal"
                                data-bs-target="#ModalDelete">
                                Delete User
                            </button>
                        </li>

                        <li>
                            <div class="dropdown nav-item">
                                <button class="btn btn-info dropdown-toggle me-5 mb-1" type="button"
                                    id="dropdownMenuButton" aria-expanded="false">
                                    <?php
                                    if ($userRole == 'admin') {
                                        echo 'Admin';
                                    }
                                    ?>
                                </button>
                              <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                    <!-- Display user information -->
                                   <li>
                                        <a class="dropdown-item" href="../profile/">
                                            <i class="fas fa-user me-1 fs-5"></i> <!-- Font Awesome icon for user -->
                                            <?php echo $_SESSION['username']; ?> <!-- Display user's email or other info -->
                                        </a>
                                    </li>
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

<div class="d-flex justify-content-between ">


    <?php include('../includes/navigation.php'); ?>

    <div class="flex-grow-1 main-content">
        <h1 class="sr-only">Dashboard</h1>
        <?php $title = "Dashboard"; // Set the default title

        if (isset($title) && !empty($title)) {
            echo "<script>document.title = '" . $title . "'</script>";
        }
        ?>

        <div class="content-wrapper">


            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <section class="content">

                <div class=" grid">
                    <div>
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?php echo $totalItems; ?></h3>
                                <p>Total Items</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </div>
                            <a href="../more_info/all_items.php" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div>
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $totalConsumableItems; ?></h3>
                                <p>Total Consumable Items</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-droplet"></i>
                            </div>
                            <a href="../more_info/consumable_items.php" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div>
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo $totalNonConsumableItems; ?></h3>
                                <p>Total Non-Consumable Items</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-toolbox"></i>
                            </div>
                            <a href="../more_info/non_consumable_items.php" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div>
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3><?php echo $totalBinCard; ?></h3>
                                <p>Total Bin Card</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-archive"></i>
                            </div>
                            <a href="../bin/" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div>
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $totalModel19; ?></h3>
                                <p>Total Model 19</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <a href="../model_19/" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div>
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <h3><?php echo $totalModel20; ?></h3>
                                <p>Total Model 20</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <a href="../model_20/" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>


            </section>


        </div>
    </div>

</div>


<!-- message -->
<?php include('../includes/message.php'); ?>


<!-- Modal -->
<?php include('../includes/register_modal.php'); ?>

<?php include('../includes/footer.php'); ?>
<?php include('../includes/modal.php'); ?>

