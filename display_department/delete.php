<?php
// Include database connection
include('../includes/dbcon.php');
include("../includes/auth.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch email before deleting
    $query_fetch_email = "SELECT email FROM department_registration WHERE id = ?";
    $stmt_fetch_email = mysqli_prepare($connection, $query_fetch_email);
    mysqli_stmt_bind_param($stmt_fetch_email, 'i', $id);
    mysqli_stmt_execute($stmt_fetch_email);
    mysqli_stmt_bind_result($stmt_fetch_email, $deleted_email);
    mysqli_stmt_fetch($stmt_fetch_email);
    mysqli_stmt_close($stmt_fetch_email);

    // Delete the record from department_registration
    $query_delete = "DELETE FROM department_registration WHERE id = ?";
    $stmt_delete = mysqli_prepare($connection, $query_delete);
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    $result_delete = mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);

    if (!$result_delete) {
        die("Query Failed" . mysqli_error($connection));
    } else {
        // Construct success message
        $delete_msg = "You have deleted the record with email: $deleted_email";

        // Redirect with message
        header("location:index.php?delete_msg=" . urlencode($delete_msg));
        exit;
    }
}
?>
