<?php
// Include necessary files
include ('../includes/dbcon.php');
include('../includes/header.php');
include('../includes/auth.php'); // Include auth for security

// Start the session (if not already started in included files)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include insert_app.php to access determineCurrentPage() function
include('../includes/insert_app.php');

// Determine the current page
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);


// Store the current page URL in a session variable
$_SESSION['currentPage'] = $currentPage;

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';


?>

<header class="main-header">
    <div>
        <?php
        if ($userRole == 'admin') {
            echo "<a href=\"../admin/index.php\" class=\"logo\" aria-current=\"page\">";
            echo " <img src=\"../img/EPTC_logo\" alt=\"logo\">";
            echo "</a>";
        } else {
            echo "<a href=\"index.php\" class=\"logo\" aria-current=\"page\">";
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
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link link-light link-opacity-50-hover" href="#" data-bs-toggle="modal" data-bs-target="#ModalDepartment">Add Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light link-opacity-50-hover" href="#" data-bs-toggle="modal" data-bs-target="#ModalUser">Add User</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li>
                            <div class="dropdown nav-item">
                                <button class="btn btn-info dropdown-toggle me-5 mb-1" type="button"
                                    id="dropdownMenuButton" aria-expanded="false">
                                    <?php
                                    if ($userRole == 'admin') {
                                        echo 'Admin';
                                    } elseif ($userRole == 'it head') {
                                        echo 'IT Head';
                                    }
                                    ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item text-danger fw-bold"
                                            href="../login/logout_process.php">Logout</a></li>
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
<?php 
 $title = "IT Department"; // Set the default title
            if (isset($title) && !empty($title)) {
                echo "<script>document.title = '" . $title . "'</script>";
            }
            ?>
    <div class="flex-grow-1 main-content">
                <div class="content-wrapper container">
                     <section class="content-header">
                    <h1>
                        IT Department
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">it</li>
                    </ol>
                    </section>
          


            <div class="box1 d-flex flex-md-row flex-column justify-content-between align-items-center mt-2">
                <form method="GET" action="">
                    <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center align-items-md-end  gap-3">
                        <div class="d-flex gap-3">
                            <div class="form-group mb-2">
                                <select name="order" id="order" class="form-select" onchange="this.form.submit()">
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
                <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#ModalItem">Add Items</button>
            </div>

            <?php
            // Pagination parameters
            $itemsPerPage = 5;

            // Ensure $currentPage is numeric and set a default if not
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

            // Calculate offset for LIMIT in SQL query
            $offset = ($currentPage - 1) * $itemsPerPage;

            // Modify query to include LIMIT and OFFSET
            if (isset($_GET['order']) && ($_GET['order'] == 'asc' || $_GET['order'] == 'desc')) {
                $order = $_GET['order'];
            } else {
                $order = 'asc'; // Default ordering is ascending
            }

            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $_GET['search'];
                $query = "SELECT * FROM `inventory` 
                          WHERE `department` = 'IT' 
                          AND `inventory_list` LIKE '%$search%'
                          ORDER BY `inventory_list` $order 
                          LIMIT $itemsPerPage OFFSET $offset";
            } else {
                $query = "SELECT * FROM `inventory` 
                          WHERE `department` = 'IT'
                          ORDER BY `ordinary_number` $order 
                          LIMIT $itemsPerPage OFFSET $offset";
            }

            $result = mysqli_query($connection, $query);
            // Count total number of rows without LIMIT for pagination
            $countQuery = "SELECT COUNT(*) AS total FROM `inventory` WHERE `department` = 'IT'";
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $countQuery .= " AND `inventory_list` LIKE '%$search%'";
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
                                    <th>የእቃው ምድብ</th>
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
                                        <td><?php echo $row['ordinary_number']; ?></td>
                                        <td><?php echo $row['department']; ?></td>
                                        <td><?php echo $row['inventory_list']; ?></td>
                                        <td><?php echo $row['item_type']; ?></td>
                                        <td><?php echo $row['item_category']; ?></td>
                                        <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['description']; ?></td>
                                        <td><?php echo $row['measure']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['total_price']; ?></td>
                                        <td class="text-wrap" style="max-width: 12rem;"><?php echo $row['examination']; ?></td>
                                        <td><a href="../includes/update.php?ordinary_number=<?php echo $row['ordinary_number']; ?>&department=<?php echo $row['department']; ?>" class="btn btn-success">Update</a></td>
                                        <td>
                                            <a href="../includes/delete.php?ordinary_number=<?php echo $row['ordinary_number']; ?>&department=<?php echo $row['department']; ?>" class="btn btn-danger" onclick="return confirmDelete('<?php echo $row['ordinary_number']; ?>', '<?php echo htmlspecialchars($row['inventory_list']); ?>')">Delete</a>
                                        </td>
                                        <script>
                                            function confirmDelete(ordinaryNumber, inventoryList) {
                                                return confirm("Are you sure you want to delete the record?\n\nOrdinary Number: " + ordinaryNumber + "\nInventory List: " + inventoryList);
                                            }
                                        </script>
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
                    $startItem = ($currentPage - 1) * $itemsPerPage + 1;
                    $endItem = min($startItem + $itemsPerPage - 1, $rowCount);

                    // Display start and end item numbers and total count
                    echo "<div class=' fs-6 fw-bold '>Showing <span class=\"text-primary fs-5\">$startItem</span> to <span class=\"text-primary fs-5\">$endItem</span> of <span class=\"text-primary fs-5\">$rowCount</span> entries</div>";
                    ?>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end m-auto">
                            <?php
                            // Count total number of rows without LIMIT for pagination
                            $countQuery = "SELECT COUNT(*) AS total FROM `inventory` WHERE `department` = 'IT'";
                            if (isset($_GET['search']) && !empty($_GET['search'])) {
                                $countQuery .= " AND `inventory_list` LIKE '%$search%'";
                            }
                            $countResult = mysqli_query($connection, $countQuery);
                            $rowCount = mysqli_fetch_assoc($countResult)['total'];

                            // Calculate total pages
                            $totalPages = ceil($rowCount / $itemsPerPage);

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
<?php include('../includes/register_modal.php'); ?>
<?php include('../includes/modal.php'); ?>


<!-- footer -->
<?php include('../includes/footer.php'); ?>

