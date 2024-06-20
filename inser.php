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
include('../includes/insert_app.php');

// Determine the current page
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);


// Store the current page URL in a session variable
$_SESSION['currentPage'] = $currentPage;

// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';
echo $_SESSION['currentPage'];

// Query to get the total number of items in the inventory
$query = "SELECT COUNT(*) as total_items FROM `inventory`";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$totalItems = $row['total_items'];

// Query to get the total number of consumable items
$queryConsumableItems = "SELECT COUNT(*) as total_consumable_items FROM `inventory` WHERE `item-type` = 'consumable'";
$resultConsumableItems = mysqli_query($connection, $queryConsumableItems);
$rowConsumableItems = mysqli_fetch_assoc($resultConsumableItems);
$totalConsumableItems = $rowConsumableItems['total_consumable_items'];

// Query to get the total number of non-consumable items
$queryNonConsumableItems = "SELECT COUNT(*) as total_non_consumable_items FROM `inventory` WHERE `item-type` = 'non-consumable'";
$resultNonConsumableItems = mysqli_query($connection, $queryNonConsumableItems);
$rowNonConsumableItems = mysqli_fetch_assoc($resultNonConsumableItems);
$totalNonConsumableItems = $rowNonConsumableItems['total_non_consumable_items'];


// Query to get the total number of items in the inventory
$queryDepartments = "SELECT COUNT(*) as total_departments FROM `departments`";
$resultDepartments = mysqli_query($connection, $queryDepartments);
$rowDepartments = mysqli_fetch_assoc($resultDepartments);
$totalDepartments = $rowDepartments['total_departments'];

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
                        data-bs-target="#Modal2">Add Department</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light link-opacity-50-hover" href="#" data-bs-toggle="modal"
                        data-bs-target="#Modal1">Add User</a>
                </li>
               

            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
       <li class="nav-item">
                        <button type="button" class="btn btn-danger mb-3 mb-lg-0  me-3" data-bs-toggle="modal"
                            data-bs-target="#Modal4">
                            Delete User
                        </button>
                    </li>
                    <li>
                        <div class="dropdown nav-item">
                            <a class="btn btn-info  dropdown-toggle me-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                        if ($userRole == 'admin') {
                                            echo 'Admin';
                                        } elseif ($userRole == 'it head') {
                                            echo 'IT Head';
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
    
   <div class="d-flex justify-content-between ">


        <?php include('../includes/navigation.php'); ?>

        <div class="flex-grow-1 main-content">

            <div class="content-wrapper" >

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

                    <div class="row">
                        <div class="col-lg-3 col-xs-6">

                            <div class="small-box bg-aqua">
                                <div class="inner">
                                   <h3><?php echo $totalItems; ?></h3>
                                    <p>Total Items</p>
                                </div>
                                <div class="icon">
                                   <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <a href="../more_info/all_items.php" class="small-box-footer">More
                                    info
                                    <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">

                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $totalConsumableItems ?></h3>
                                    <p>Total Consumable Items</p>
                                </div>
                                <div class="icon">
                                   <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <a href="https://demo.codersfolder.com/imsv2/orders/" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">

                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?php echo $totalNonConsumableItems ?></h3>
                                    <p>Total Non-Consumable Items</p>
                                </div>
                                <div class="icon">
                                     <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <a href="https://demo.codersfolder.com/imsv2/users/" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">

                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?php echo $totalDepartments ?></h3>
                                    <p>Total Departments</p>
                                </div>
                                <div class="icon">
                                     <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <a href="https://demo.codersfolder.com/imsv2/stores/" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>
                   

                </section>

<!-- Message -->
<?php include('../includes/message.php'); ?>

            </div>
        </div>
        
    </div>


<!-- Modal -->
<?php include('../includes/modal.php'); ?>

<?php include('../includes/update.php'); ?>

<?php include('../includes/user_register.php'); ?>

<!-- footer -->
<?php include('../includes/footer.php'); ?>