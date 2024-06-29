<?php
include('../includes/dbcon.php');

if(isset($_POST['add_bin'])) {
    // Sanitize and validate input
    $date = htmlspecialchars($_POST['date']);
    $income = intval($_POST['income']);
    $cost = intval($_POST['cost']);
    $short = htmlspecialchars($_POST['short']);
    
    // Validate that required fields are not empty
    if(empty($date) || empty($income) || empty($cost) || empty($short)) {
        header('location: index.php?error_msg=Some fields are empty.');
        exit;
    }
    
    // Prepare the SQL statement using a prepared statement
    $query = "INSERT INTO bin (`date`, income, cost, `short`) VALUES (?, ?, ?, ?)";
    
    // Initialize a prepared statement
    $stmt = mysqli_stmt_init($connection);
    
    // Prepare the statement
    if(mysqli_stmt_prepare($stmt, $query)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sdds", $date, $income, $cost, $short);
        
        // Execute the statement
        if(mysqli_stmt_execute($stmt)) {
            // Success: Redirect with success message
            header('location: index.php?insert_msg=Your data has been added successfully');
            exit;
        } else {
            // Error handling for database execution failure
            die("Query execution failed: " . mysqli_stmt_error($stmt));
        }
    } else {
        // Error handling for statement preparation failure
        die("Statement preparation failed: " . mysqli_error($connection));
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($connection);
?>
