<?php
// Include necessary files
include('../includes/dbcon.php');
include('../includes/header.php');

// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include determineFnc.php to access determineCurrentPage() function
include('../includes/determineFnc.php');

// Determine the current page
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);

// Store the current page URL in a session variable
$_SESSION['currentPage'] = $currentPage;

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';

// Access last visit time from session (assuming it's set during login)
$lastVisitTime = isset($_SESSION['lastVisitTime']) ? $_SESSION['lastVisitTime'] : '';

// Query to count pending model_20 items
$countQuery = "SELECT COUNT(*) AS pending_count FROM model_20 WHERE status = 'pending'";
$countResult = mysqli_query($connection, $countQuery);

// Check for query errors
if (!$countResult) {
    die("Database query failed: " . mysqli_error($connection));
}

// Fetch the count
$pendingCount = 0;
if ($row = mysqli_fetch_assoc($countResult)) {
    $pendingCount = $row['pending_count'];
}

// Free result set
mysqli_free_result($countResult);


// Function to convert timestamp to milliseconds (like JavaScript's Date.getTime())
function convertToMilliseconds($timestamp) {
    return strtotime($timestamp) * 1000;
}

// Handle status update if action is provided (approve or decline)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $itemId = $_GET['id'];

    // Perform update in database based on action
    switch ($action) {
        case 'approve':
            updateItemStatus($itemId, 'approved');
            break;
        case 'decline':
            updateItemStatus($itemId, 'declined');
            break;
        default:
            // Invalid action
            break;
    }
}

// Function to update item status in database
function updateItemStatus($itemId, $status) {
    global $connection;

    $query = "UPDATE model_20 SET status = ? WHERE `ordinary-number` = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $itemId);
    mysqli_stmt_execute($stmt);

    // Check if update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Update successful, redirect or perform any other action
        // Optionally, you can set a session message to indicate success
        // $_SESSION['message'] = "Item status updated successfully.";
    } else {
        // Update failed
        // $_SESSION['error'] = "Failed to update item status.";
    }

    mysqli_stmt_close($stmt);
}

?>

<header class="main-header">
    <div>
        <?php 
        if ($userRole == 'admin') {
            echo '<a href="../admin/index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
        } else {
            echo '<a href="index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
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
            <div class="collapse navbar-collapse d-flex justify-content-between text-center" id="navbarNav">
                <div class="py-2 mx-auto">
                    <h1 class="text-center fs-3 text-light">Requested</h1>
                    <?php
                    $title = "Requested"; // Set the default title

                    if (isset($title) && !empty($title)) {
                        echo "<script>document.title = '" . $title . "'</script>";
                    }
                    ?>
                </div>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li>
                            <div class="dropdown nav-item">
                                <button class="btn btn-info dropdown-toggle me-5 mb-1" type="button" id="dropdownMenuButton" aria-expanded="false">
                                    <?php
                                    if ($userRole == 'admin') {
                                        echo 'Admin';
                                    }
                                    ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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

<div class="d-flex justify-content-between">
    <?php include('../includes/navigation.php'); ?>
    <div class="flex-grow-1 main-content">
        <div class="container mx-auto vh">
            <div class="box1 d-flex flex-md-row flex-column justify-content-between align-items-center">
                <?php
                // Query to fetch all model_20 items
                $query = "SELECT * FROM model_20";
                $result = mysqli_query($connection, $query);

                // Check for query errors
                if (!$result) {
                    die("Database query failed: " . mysqli_error($connection));
                }

                // Check if there are any items
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <th>Ordinary Number</th>
                                <th>Quantity</th>
                                <th>Item Type</th>
                                <th>Model</th>
                                <th>Update</th>
                                <th>Requested By</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Remove</th>
                            </thead>
                            <tbody>
                                <?php
                               while ($row = mysqli_fetch_assoc($result)) {
                                        // Convert timestamps to milliseconds for comparison
                                        $rowTimestampMilliseconds = convertToMilliseconds($row['timestamp']);
                                        $lastVisitTimeMilliseconds = convertToMilliseconds($lastVisitTime);

                                        // Determine if the item is new based on status and last visit time
                                       // Determine if the item is new based on status and last visit time
                        $isNew = !$lastVisitTime || ($rowTimestampMilliseconds > $lastVisitTimeMilliseconds) || ($row['status'] == 'pending');


                                        // Output row with condition for new item
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['ordinary-number']; ?>
                                                <?php if ($isNew) { ?>
                                                    <span class="badge bg-danger">New</span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><?php echo $row['item-type']; ?></td>
                                            <td><?php echo $row['model']; ?></td>
                                            <td><?php echo $row['update']; ?></td>
                                            <td><?php echo $row['requested_by']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                                <!-- Always show links/buttons to approve or decline -->
                                                <a class="btn btn-success action" href="index.php?action=approve&id=<?php echo $row['ordinary-number']; ?>">Approve</a> |
                                                <a class="btn btn-danger  action" href="index.php?action=decline&id=<?php echo $row['ordinary-number']; ?>">Decline</a>
                                            </td>
                                            <td>
                                                <?php if ($row['status'] == 'approved' || $row['status'] == 'declined') { ?>
                                                    <a href="../includes/delete_request.php?id=<?php echo $row['ordinary-number']; ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger" disabled="true">Delete</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    echo "<div class='alert alert-info text-center w-70 my-3 mx-auto'><strong class='fs-3 text-light'>There is no requested message</strong></div>";
                }

                // Close database connection
                mysqli_close($connection);
                ?>
            </div>
        </div>
    </div>
    <!-- Include footer -->
    <?php include('../includes/footer.php'); ?>
</div>

<?php include('../includes/message.php'); ?>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete the record?");
}
</script>
