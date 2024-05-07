<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ordinaryNumber = $_POST['ordinary-number'];
    $inventoryList = $_POST['inventory-list'];
    $description = $_POST['description'];
    $measure = $_POST['measure'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total-price'];
    $examination = $_POST['examination'];

        // Check if any required fields are empty
    if (empty($ordinaryNumber) || empty($inventoryList) || empty($description) || empty($measure) || empty($quantity) || empty($price) || empty($totalPrice) || empty($examination)) {
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
  $sql = "INSERT INTO it_department (`ordinary-number`, `inventory-list`, `description`, measure, quantity, price, `total-price`, examination) VALUES ('$ordinaryNumber', '$inventoryList', '$description', '$measure', '$quantity', '$price', '$totalPrice', '$examination')";

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
    <title>ወጪ</title>
</head>
<body>

 <header class="header">
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
                <li class="item"><a href="depre.php">Department Register</a></li>
                <li class="item active"><a href="it.php">It</a></li>
                <li class="item"><a href="out.php">Model 20 cost</a></li>
                <li class="item"><a href="tempo.php">Model 19 cost</a></li>
                <li class="item"><a href="up.php">Update Authority</a></li>
            </ul>
            <button class="btn btn-primary">Login</button>
        </nav>
    </header>

    <form method="post">
    <div class="container">
        <h1 class="text-center">It Department የግዥ መጠየቂያ ፎርም</h1>
      
            <div class="form-group">
                <input type="number" class="form-control" id="ordinary-number" name="ordinary-number" placeholder="ተራ ቁጥር">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="inventory-list" name="inventory-list" placeholder="የእቃው ዝርዝር">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="description" name="description" placeholder=" መግለጫ">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="measure" name="measure" placeholder="መለኪያ">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="ብዛት">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="price" name="price" placeholder="የአንዱ ዋጋ">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="total-price" name="total-price" placeholder="ጠቅላላ ዋጋ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="examination" name="examination" placeholder="ምርመራ">
            </div>
            <button type="submit" class="btn btn-primary">አስገባ</button>
 
    </div>
</form>
</body>
</html>