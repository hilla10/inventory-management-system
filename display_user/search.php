<?php
include('../includes/dbcon.php');

if (isset($_GET['search']) && !empty($_GET['search']) && isset($_GET['field']) && !empty($_GET['field'])) {
    $search = $_GET['search'];
    $field = $_GET['field'];
    $query = "SELECT * FROM users WHERE $field LIKE '%$search%'";
} else {
    $query = "SELECT * FROM users";
}

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed" . mysqli_error($connection));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['age'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['Phone'] ?></td>
            <td><?php echo $row['options'] ?></td>
            <td><a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Update</a></td>
            <td><a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a></td>
        </tr>
    <?php
    }
}
?>