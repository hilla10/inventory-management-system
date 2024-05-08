<?php include('../includes/dbcon.php'); ?>
<?php 

if(isset($_POST['add_bin'])) {
    $date = $_POST['date'];
    $income = $_POST['income'];
    $cost = $_POST['cost'];
    $remain = $_POST['remain'];
    $short = $_POST['short'];
    
    if(empty($date) || empty($income) || empty($cost) || empty($remain) || empty($short)) {
        header('location: index.php?message= Some fields are empty.');
    } elseif($date === "" || empty($date)) {
         header('location: index.php?message=You need to fill the inventory list');
    } elseif($income === "" || empty($income)) {
         header('location: index.php?message=You need to fill the income');
    }  elseif($cost === "" || empty($cost)) {
         header('location: index.php?message=You need to fill the cost');
    }  elseif($remain === "" || empty($remain)) {
         header('location: index.php?message=You need to fill the remain');
    }  elseif($short === "" || empty($short)) {
         header('location: index.php?message=You need to fill the short');
    } else {

        $query =  "INSERT INTO bin (`date`,  income, cost, remain, `short`) VALUES ('$date', '$income', '$cost', '$remain', '$short')";


        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Your data has been added successfully');
        }

    }
}

?>