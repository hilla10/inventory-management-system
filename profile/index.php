<?php
// Start the session
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php?error_msg=Please login to access this page");
    exit();
}

// Include your database connection file
include("../includes/dbcon.php");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">User Profile</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> <?php echo $displayEmail; ?></p>
                        <p><strong>Name:</strong> <?php echo $displayName; ?></p>
                        <p><strong>Role:</strong> <?php echo $displayRole; ?></p>
                        <p><strong>Phone:</strong> <?php echo $displayPhone; ?></p>
                        <p><strong>ID:</strong> <?php echo $displayId; ?></p>
                        <!-- Add more information as needed -->
                    </div>
                </div>
                <td><a href="../display_user/update.php?id=<?php echo $user['id'] ?>" class="btn btn-success">Update</a></td>
            </div>
            <div class="card-footer text-muted">
                <!-- Add any footer content here -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
