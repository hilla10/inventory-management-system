<?php
// Include necessary files
include('../includes/dbcon.php');
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


<header class="main-header">

      <div>
        <?php   if ($userRole == 'admin') {
                echo "<a href=\"../admin/index.php\" class=\"logo";
                echo "\" aria-current=\"page\">";
                echo " <img src=\"../img/EPTC_logo\" alt=\"logo\">";
                echo "</a>";
            } else {
                echo "<a href=\"index.php\" class=\"logo";
                echo "\" aria-current=\"page\">";
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
  
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <div class="d-flex">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">  
        

        <li>
                        <div class="dropdown nav-item">
                            <a class="btn btn-info dropdown-toggle me-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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




<div class="d-flex justify-content-between">

    <?php include('../includes/navigation.php'); ?>

    <div class="flex-grow-1 main-content">


<div class="py-3 text-center">
    <h1>Display All Department</h1>
     <?php
        $title = "Display All Department"; // Set the default title

if (isset($title) && !empty($title)) {
    echo "<script>document.title = '" . $title . "'</script>";
}
?>
</div>
<div class="container mt-5">
    
<div class="box1 d-flex flex-md-row flex-column justify-content-between align-items-center">
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
                        <div class="form-group input-box outline">
                        <input type="text" name="search" id="search" placeholder="Search user" class="form-control search">
                    </div>
                </div>
        <button type="submit" class="btn btn-primary my-3 ms-1">Search</button>
    </div>
        </form>
        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#Modal9">Add Department</button>
    </div>
    
<div class="table-responsive">
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
                $query = "SELECT * FROM `department_registration` WHERE $field LIKE '%$search%' ORDER BY username $order";
            }  else {
                // Display a message if the user didn't select a field or selected "select field" and clicked the submit button
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $errors[] = "Please select a valid field to search the user.";
                }
                $query = "SELECT * FROM `department_registration` ORDER BY username $order";
            }

            if(!empty($errors)) {
                $message = implode(" ", $errors);
                header('location: index.php?error_msg=' . urldecode($message));
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
                         <td>
                                  <a  href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirmDelete('<?php echo $row['id']; ?>','<?php echo $row['email']; ?>' )">Delete</a>
                                </td>

                                <script>
                                function confirmDelete(id, email) {
                                return confirm("Are you sure you want to delete the record?\n\nid: " + id + "\nemail: " + email);
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
    <div class="text-uppercase fs-4 fw-bold text-end">Department Count : <span class="text-primary"><?php echo $departmentCount; ?></span></div>

    </div>
    </div>
    </div>
<!-- Modal -->

<div class="p-3 w-100 mx-auto">
    
</div>


<!-- message -->
<?php include('../includes/message.php'); ?>

<?php include('../includes/modal.php'); ?>

<!-- footer -->
<?php include('../includes/footer.php'); ?>