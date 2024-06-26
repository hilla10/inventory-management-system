<?php
include('../includes/dbcon.php');  // Ensure database connection
include('../includes/header.php'); // Include header for consistency
include('../includes/auth.php'); // Include auth for security

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include function file to determine current page
include('../includes/determineFnc.php');

// Determine current page URL
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);

// Store current page URL in session
$_SESSION['currentPage'] = $currentPage;

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';

// Access last visit time from session (assuming set during login)
$lastVisitTime = isset($_SESSION['lastVisitTime']) ? $_SESSION['lastVisitTime'] : '';

// Query to count pending model_19 items (example query, adjust as needed)
$countQuery = "SELECT COUNT(*) AS pending_count FROM model_19";
$countResult = mysqli_query($connection, $countQuery);

// Check for query errors
if (!$countResult) {
    die("Database query failed: " . mysqli_error($connection));
}

// Fetch pending count
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

    // Prepare statement to update status
    $query = "UPDATE model_19 SET status = ? WHERE ordinary_number = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $itemId);
    mysqli_stmt_execute($stmt);

    // Check if update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Optionally, set a session message to indicate success
        $_SESSION['message'] = "Item status updated successfully.";
    } else {
        // Optionally, set an error message
        $_SESSION['error'] = "Failed to update item status.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!-- Header Section -->
<header class="main-header">
    <!-- Logo and Navigation -->
    <div>
        <a href="<?php echo ($userRole == 'admin') ? '../admin/index.php' : 'index.php'; ?>" class="logo" aria-current="page">
            <img src="../img/EPTC_logo" alt="logo">
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa-solid fa-bars-staggered"></i>
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </div>

    <!-- Dropdown Menu -->
    <nav class="navbar navbar-expand-lg d-flex align-items-center bg-dark-blue navbar-toggle">
        <div class="hamburger">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="container">
            <div class="collapse navbar-collapse d-flex justify-content-between text-center" id="navbarNav">
                <div class="py-2 mx-auto">
                    <h1 class="text-center fs-3 text-light">Added Item</h1>
                </div>
                <div class="d-flex">
                    <!-- Dropdown for Admin -->
                    <?php if ($userRole == 'admin') { ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li>
                                <div class="dropdown nav-item">
                                    <button class="btn btn-info dropdown-toggle me-5 mb-1" type="button" id="dropdownMenuButton" aria-expanded="false">
                                        Admin
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item text-danger fw-bold" href="../login/logout_process.php">Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Main Content -->
<div class="d-flex justify-content-between">
    <!-- Include Navigation Sidebar -->
    <?php include('../includes/navigation.php'); ?>
 <?php
                    $title = "Added Items"; // Set the default title

                    if (isset($title) && !empty($title)) {
                        echo "<script>document.title = '" . $title . "'</script>";
                    }
                    ?>
    <!-- Main Content Area -->
    <div class="flex-grow-1 main-content">
        <div class="container mx-auto vh">
            <section class="content-header pb-3">
                <h1>
                    Added
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Added</li>
                </ol>
            </section>

             <div class="box1 d-flex flex-md-row flex-column justify-content-between align-items-center mt-2">

       <form method="GET" action="">
           <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center align-items-md-end  gap-3">
<div class="d-flex gap-3">
                <div class="d-flex gap-4">
    <div class="form-group mb-2">
        <select name="field" class="form-select">
            <option value="select field">Select field</option>
            <option value="ordinary_number" <?php if(isset($_GET['field']) && $_GET['field'] == 'ordinary_number') echo 'selected'; ?>>ID</option>
            <option value="added_by" <?php if(isset($_GET['field']) && $_GET['field'] == 'added_by') echo 'selected'; ?>>Added By</option>
            <option value="item_type" <?php if(isset($_GET['field']) && $_GET['field'] == 'item_type') echo 'selected'; ?>>Item type</option>
            <option value="item_type" <?php if(isset($_GET['field']) && $_GET['field'] == 'item_category') echo 'selected'; ?>>Item category</option>
            <option value="model" <?php if(isset($_GET['field']) && $_GET['field'] == 'model') echo 'selected'; ?>>Model</option>
            <option value="serie" <?php if(isset($_GET['field']) && $_GET['field'] == 'serie') echo 'selected'; ?>>Serie</option>
            <option value="quantity" <?php if(isset($_GET['field']) && $_GET['field'] == 'quantity') echo 'selected'; ?>>Quantity</option>
            <option value="timestamp" <?php if(isset($_GET['field']) && $_GET['field'] == 'timestamp') echo 'selected'; ?>>Date</option>
            <option value="status" <?php if(isset($_GET['field']) && $_GET['field'] == 'status') echo 'selected'; ?>>Status</option>
        </select>
    </div>
     <div class="form-group mb-2">
        <select name="order" id="order" class="form-select" onchange="this.form.submit()">
            <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
            <option value="asc" <?php if(isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
        </select>
    </div>
    </div>
  <div class="form-group input-box outline">
                        <input type="text" name="search" id="search" placeholder="Search user" class="form-control search">
                    </div>
   
</div>

        <button type="submit" class="btn btn-primary my-3 ms-1">Search</button>
</div>

    <!-- Other form elements like search input and submit button -->
    <!-- Include search input and submit button here -->
</form>

        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal1">Add User</button>
    </div>
                
            <?php
            // Pagination parameters
            $usersPerPage = 5;

            // Ensure $currentPage is numeric and set a default if not
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

            // Calculate offset for LIMIT in SQL query
            $offset = ($currentPage - 1) * $usersPerPage;

            // Modify query to include LIMIT and OFFSET
            if (isset($_GET['order']) && ($_GET['order'] == 'desc' || $_GET['order'] == 'asc')) {
                $order = $_GET['order'];
            } else {
                $order = 'desc'; // Default ordering is ascending
            }

// Handle form submission for sorting
$field = isset($_GET['field']) ? $_GET['field'] : ''; // Default empty if not set
$order = isset($_GET['order']) ? $_GET['order'] : 'desc'; // Default descending order if not set

// Validate and sanitize input for security
if (!empty($field) && $field != 'select field') {
    $field = mysqli_real_escape_string($connection, $_GET['field']);
    $order = mysqli_real_escape_string($connection, $_GET['order']);

    // Modify query to include sorting
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($connection, $_GET['search']);
        $query = "SELECT * FROM model_19 WHERE `$field` LIKE '%$search%' ORDER BY `$field` $order LIMIT $usersPerPage OFFSET $offset";
    } else {
        $query = "SELECT * FROM model_19 ORDER BY `$field` $order LIMIT $usersPerPage OFFSET $offset";
    }
} else {
    // Default query if no valid sorting parameters are provided
    $query = "SELECT * FROM model_19 ORDER BY `ordinary_number` DESC LIMIT $usersPerPage OFFSET $offset";
}

// Execute the query
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

            if(!empty($errors)) {
                $message = implode(" ", $errors);
                header('location: index.php?error_msg=' . urldecode($message));
            }

            $result = mysqli_query($connection, $query);
  // Count total number of rows without LIMIT for pagination
           $countQuery = "SELECT COUNT(*) AS total FROM model_19";
if (isset($_GET['search']) && !empty($_GET['search']) && isset($_GET['field']) && !empty($_GET['field']) && $_GET['field'] != 'select field') {
    $search = $_GET['search'];
    $field = $_GET['field'];
    $countQuery .= " WHERE `$field` LIKE '%$search%'";
}

            $countResult = mysqli_query($connection, $countQuery);

            if (!$countResult) {
                die("Count query failed: " . mysqli_error($connection));
            }

            $rowCount = mysqli_fetch_assoc($countResult)['total'];
            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            } else {
                if (mysqli_num_rows($result) > 0) {
                    // Initialize the counter variable
                    $userCount = 0;
                    ?>
                    <div class="table-responsive w-100">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Added By</th>
                                    <th>Item Type</th>
                                    <th>Item Category</th>
                                    <th>Model</th>
                                    <th>Serie</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Convert timestamps to milliseconds for comparison
                                    $rowTimestampMilliseconds = strtotime($row['timestamp']) * 1000;
                                    $lastVisitTimeMilliseconds = strtotime($lastVisitTime) * 1000;

                                    // Determine if the item is new based on status and last visit time
                                    $isNew = !$lastVisitTime || ($rowTimestampMilliseconds > $lastVisitTimeMilliseconds) || ($row['status'] == 'pending');

                                    // Output row with condition for new item
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['ordinary_number']; ?>
                                            <?php if ($isNew) { ?>
                                                <span class="badge bg-danger">New</span>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $row['added_by']; ?></td>
                                        <td><?php echo $row['item_type']; ?></td>
                                        <td><?php echo $row['item_category']; ?></td>
                                        <td><?php echo $row['model']; ?></td>
                                        <td><?php echo $row['serie']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['total_price']; ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($row['timestamp'])); ?></td>

                                        <td><?php echo $row['status']; ?></td>
                                        <td>
                                            <!-- Always show links/buttons to approve or decline -->
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-success action my-1" href="index.php?action=approve&id=<?php echo $row['ordinary_number']; ?>">Approve</a>
                                            <a class="btn btn-danger action  my-1" href="index.php?action=decline&id=<?php echo $row['ordinary_number']; ?>">Decline</a> 
                                        </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                       <div class="d-flex justify-content-between bg-light align-items-center p-2 rounded-2">
                        <?php
                    // Calculate start and end item numbers
                    $startItem = ($currentPage - 1) * $usersPerPage + 1;
                    $endItem = min($startItem + $usersPerPage - 1, $rowCount);

                    // Display start and end item numbers and total count
                    echo "<div class=' fs-6 fw-bold '>Showing <span class=\"text-primary fs-5\">$startItem</span> to <span class=\"text-primary fs-5\">$endItem</span> of <span class=\"text-primary fs-5\">$rowCount</span> entries</div>";
                    ?>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end m-auto">
                            <?php
                            // Count total number of rows without LIMIT for pagination
                                  $countQuery = "SELECT COUNT(*) AS total FROM model_19 ";
                            if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $field = $_GET['field'];
                                    $countQuery .= " WHERE `$field` LIKE '%$search%'";
                                }
                            $countResult = mysqli_query($connection, $countQuery);
                            $rowCount = mysqli_fetch_assoc($countResult)['total'];

                            // Calculate total pages
                            $totalPages = ceil($rowCount / $usersPerPage);

                            // Previous page link
                            if ($currentPage > 1) {
                                echo "<li class='page-item'><a class='page-link' href='?page=".($currentPage - 1);
                                if (isset($_GET['order'])) {
                                    echo "&order={$_GET['order']}";
                                }
                                if (isset($_GET['search'])) {
                                    echo "&search={$_GET['search']}";
                                }
                                echo "'>Previous</a></li>";
                            }

                            // Page links
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<li class='page-item";
                                if ($i == $currentPage) {
                                    echo " active";
                                }
                                echo "'><a class='page-link' href='?page=$i";
                                if (isset($_GET['order'])) {
                                    echo "&order={$_GET['order']}";
                                }
                                if (isset($_GET['search'])) {
                                    echo "&search={$_GET['search']}";
                                }
                                echo "'>$i</a></li>";
                            }

                            // Next page link
                            if ($currentPage < $totalPages) {
                                echo "<li class='page-item'><a class='page-link' href='?page=".($currentPage + 1);
                                if (isset($_GET['order'])) {
                                    echo "&order={$_GET['order']}";
                                }
                                if (isset($_GET['search'])) {
                                    echo "&search={$_GET['search']}";
                                }
                                echo "'>Next</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                    <!-- End Pagination -->
                    </div>
                <?php
                } else {
                    // Display message if no items found
                    echo "<div class='alert alert-info text-center w-70 my-3 mx-auto'><strong class='fs-3 text-light'>There are no added items</strong></div>";
                }
            }
                // Close database connection
                mysqli_close($connection);
                ?>
            
        </div>
    </div>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>
</div>

<!-- Include Message Display -->
<?php include('../includes/message.php'); ?>