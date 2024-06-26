<?php include('../includes/dbcon.php'); ?>
<?php 

if(isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];

    
    if(empty($username) || empty($email) || empty($age) || empty($phone) || empty($position)) {
        header('location: index.php?error_msg= Some fields are empty.');
    } elseif($username === "" || empty($username)) {
         header('location: index.php?error_msg=You need to fill the username');
    }elseif($email === "" || empty($email)) {
         header('location: index.php?error_msg=You need to fill the email');
    }  elseif($age === "" || empty($age)) {
         header('location: index.php?error_msg=You need to fill the age');
    }  elseif($phone === "" || empty($phone)) {
         header('location: index.php?error_msg=You need to fill the phone');
    }  elseif($position === "" || empty($position)) {
         header('location: index.php?error_msg=You need to fill the position');
    } else {

        $query =  "INSERT INTO department_registration (`username`, `email`, `age`, `phone`, `position`) VALUES ('$username', '$email', '$age', '$phone', '$position')";


        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            header('location: index.php?insert_msg=Congratulations! You have successfully usersed');
        }

    }
}

?>