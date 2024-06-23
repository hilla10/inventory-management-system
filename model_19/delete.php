<?php
include('../includes/dbcon.php');

if (isset($_GET['ordinary-number'])) {
    $ordinaryNumber = mysqli_real_escape_string($connection, $_GET['ordinary-number']);

    // Select the record to get added_by before deleting it
    $queryName = "SELECT added_by FROM `model_19` WHERE `ordinary-number` = '$ordinaryNumber'";
    $resultName = mysqli_query($connection, $queryName);
    
    if (!$resultName) {
        die("Query Failed" . mysqli_error($connection));
    }

    // Fetch the added_by value
    $addedBy = '';
    if ($row = mysqli_fetch_assoc($resultName)) {
        $addedBy = $row['added_by'];
    }

    // Prepare and execute DELETE query
    $queryDelete = "DELETE FROM `model_19` WHERE `ordinary-number` = '$ordinaryNumber'";
    $resultDelete = mysqli_query($connection, $queryDelete);

    if (!$resultDelete) {
        die("Query Failed" . mysqli_error($connection));
    } else {
        // Redirect with appropriate message
        if (!empty($addedBy)) {
            header('location:index.php?delete_msg=You have deleted the record ' . $addedBy);
        }
    }
}
?>
