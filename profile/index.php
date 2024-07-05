<?php
// Start the session
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php?error_msg=Please login to access this page");
    exit();
}

// Include your database connection file
include("../includes/dbcon.php");


// Include insert_app.php to access determineCurrentPage() function
include('../includes/determineFnc.php');

// Determine the current page
$currentPage = determineCurrentPage($_SERVER['REQUEST_URI']);
// Access user role from session
$userRole = isset($_SESSION['options']) ? $_SESSION['options'] : '';


// Store the current page URL in a session variable
$_SESSION['currentPage'] = $currentPage;

// Retrieve user information based on session data
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Prepare the query to fetch user data based on email or username
if ($email) {
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
} else {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
} else {
    $user = mysqli_fetch_assoc($result);

    // Check if user data exists before accessing fields
    if ($user) {
        $displayEmail = $user['email'] ? htmlspecialchars($user['email']) : 'Email not available';
        $displayName = htmlspecialchars($user['username']) ?? 'Name not available';
        $displayRole = htmlspecialchars($user['options']) ?? 'Role not available';
        $displayPhone = $user['phone'] ?  htmlspecialchars($user['phone']) : 'Phone not available';
        $displayId = $user['id'] ?  htmlspecialchars($user['id']) : 'ID not available';
    } else {
        $displayEmail = 'Email not available';
        $displayName = 'User not found';
        $displayRole = 'Role not found';
        $displayPhone = 'Phone not found';
        $displayId = 'ID not found';
    }
}
include ('../includes/header.php');


?>

<header class="main-header">
    <div>
        <?php 
        if ($userRole == 'admin') {
            echo '<a tabindex=\"0\" href="../admin/index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
        } else if ($userRole === 'it head'){
            echo '<a tabindex=\"0\" href="../it/index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
        } else if ($userRole === 'art head'){
            echo '<a tabindex=\"0\" href="../art/index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
        } else if ($userRole === 'auto head'){
            echo '<a tabindex=\"0\" href="../auto/index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
        } else if ($userRole === 'business head'){
            echo '<a tabindex=\"0\" href="../business/index.php" class="logo" aria-current="page">';
            echo '<img src="../img/EPTC_logo" alt="logo">';
            echo '</a>';
        }
        ?>
        <nav class="navbar navbar-static-top">
            <a tabindex="0" href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa-solid fa-bars-staggered"></i>
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </div>

    <nav class="navbar navbar-expand-lg d-flex align-items-center bg-dark-blue navbar-toggle">
        <div class="hamburger"  tabindex="0" role="button" aria-label="Toggle menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="container">
            <div class="collapse navbar-collapse d-flex justify-content-between text-center" id="navbarNav">
                <div class="py-2 mx-auto">
                    <h1 class="text-center fs-3 text-light">User Profile</h1>
                </div>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li>
                            <div class="dropdown nav-item">
                                <button  tabindex="0" class="btn btn-info dropdown-toggle me-5 mb-1" type="button" id="dropdownMenuButton" aria-expanded="false">
                                          <?php
                                    if ($userRole == 'admin') {
                                        echo 'Admin';
                                    }elseif ($userRole == 'it head') {
                                        echo 'IT Head';
                                    }elseif ($userRole == 'auto head') {
                                        echo 'AUTO Head';
                                    }elseif ($userRole == 'art head') {
                                        echo 'ART Head';
                                    }elseif ($userRole == 'business head') {
                                        echo 'BUSINESS Head';
                                    }
                                    ?>
                                </button>
                                 <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                    <!-- Display user information -->
                                   <li>
                                        <a tabindex="0" class="dropdown-item" href="../profile/">
                                            <i class="fas fa-user me-1 fs-5"></i> <!-- Font Awesome icon for user -->
                                            <?php echo $_SESSION['username']; ?> <!-- Display user's email or other info -->
                                        </a>
                                    </li>
                                    <li><a tabindex="0" class="dropdown-item text-danger fw-bold" href="../login/logout_process.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<?php include('../includes/navigation.php'); ?>
<?php $title = "User Profile"; // Set the default title
if (isset($title) && !empty($title)) {
    echo "<script>document.title = '" . $title . "'</script>";
} 
?>
    <div class="flex-grow-1 main-content">
 <div class="container content-wrapper">
     <section class=" content-header">
                    <h1>
                        User Profile
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a tabindex="0" href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">profile</li>
                    </ol>
                    </section>
  <div class="card profile-card shadow-sm">
    
    <div class="card-body">
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">Email</th>
                <td><?php echo isset($displayEmail) ? htmlspecialchars($displayEmail) : 'Email not available'; ?></td>
            </tr>
            <tr>
                <th scope="row">Name</th>
                <td><?php echo isset($displayName) ? htmlspecialchars($displayName) : 'Name not available'; ?></td>
            </tr>
            <tr>
                <th scope="row">Role</th>
                <td><?php echo isset($displayRole) ? htmlspecialchars($displayRole) : 'Role not available'; ?></td>
            </tr>
            <tr>
                <th scope="row">Phone</th>
                <td><?php echo isset($displayPhone) ? htmlspecialchars($displayPhone) : 'Phone not available'; ?></td>
            </tr>
            <tr>
                <th scope="row">ID</th>
                <td><?php echo isset($displayId) ? htmlspecialchars($displayId) : 'ID not available'; ?></td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-4">
        <a tabindex="0" href="../includes/user_update.php?id=<?php echo isset($user['id']) ? htmlspecialchars($user['id']) : ''; ?>" class="btn btn-success">Update</a>
    </div>
</div>

  </div>
</div>
</div>
<!-- message -->
<?php include('../includes/message.php'); ?>

<?php include('../includes/footer.php'); ?>