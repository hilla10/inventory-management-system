<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $authority = $_POST['authority'];

        // Check if any required fields are empty
    if (empty($username) || empty($email) || empty($age) || empty($phone) || empty($authority)) {
        echo "Error: Some fields are empty.";
        exit;
    }

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "inventory";

 // Create a new mysqli instance

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check Connection

    if($conn->connect_error) {
      die("Connection Field: ". $conn->connect_error);

    }

    // Prepare and execute the Insert query
  $sql = "INSERT INTO department_registration (`username`, `email`, `age`, phone, authority) VALUES ('$username', '$email', '$age', '$phone', '$authority')";

    if($conn->query($sql) === TRUE) {
      echo "<p>Data inserted successfully!</p>";
    } else {
      echo "Error: ". $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reg.css">
    <title>የዲፓርትመንት ምዝገባ ቅጽ</title>
</head>
<body>

 <!-- <header class="header">
        <nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="logo">
            </div>
            <ul class="list">
                <li class="item"><a href="register.php">Register</a></li>
                <li class="item"><a href="art.php">Art</a></li>
                <li class="item"><a href="auto.php">Auto</a></li>
                <li class="item"><a href="bin.php">Bin</a></li>
                <li class="item"><a href="business.php">Business</a></li>
                <li class="item"><a href="buy.php">Buy</a></li>
                <li class="item"><a href="de.php">Delete</a></li>
                <li class="item active"><a href="depre.php">Department Register</a></li>
                <li class="item"><a href="it.php">It</a></li>
                <li class="item"><a href="out.php">Model 20 cost</a></li>
                <li class="item"><a href="tempo.php">Model 19 cost</a></li>
                <li class="item"><a href="up.php">Update Authority</a></li>
            </ul>
            <button class="btn btn-primary">Login</button>
        </nav>
    </header> -->

    <form method="post">
        <div class="container">
            <h1 class="text-center">የዲፓርትመንት ምዝገባ ቅጽ</h1>
              <div class="form-group">
          
                <input type="text" class="form-control" id="username" name="username" placeholder="ስሞትን ያስገቡ">
              </div>
              <div class="form-group">
             
                <input type="email" class="form-control" id="email" name="email" placeholder="ኢሜል ያስገቡ">
              </div>
              <div class="form-group">
                
                <input type="number" class="form-control" id="age" name="age" placeholder="አድሜ ያስገቡ">
              </div>
              <div class="form-group">
             
                <input type="number" class="form-control" id="Phone" name="phone" placeholder=" ስልክ ቁጥር ያስገቡ">
              </div>
              <div class="form-group">
              
                <input type="text" class="form-control" id="authority" name="authority" placeholder=" ያሉበትን ሁኔታ ይምረጡ">
           
              </div>
              <button type="submit" class="btn btn-primary">አስገባ</button>

          </div>
    </form>
</body>
</html>