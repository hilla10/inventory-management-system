<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ordinaryNumber = $_POST['ordinary-number'];
    $quantity = $_POST['quantity'];
    $itemType = $_POST['item-type'];
    $model = $_POST['model'];
    $update = $_POST['update'];

        // Check if any required fields are empty
    if (empty($ordinaryNumber) || empty($quantity) || empty($itemType) || empty($model)  || empty($update)) {
        echo "Error: Some fields are empty.";
        exit();
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
  $sql = "INSERT INTO model_20 (`ordinary-number`, `quantity`, `item-type`, `model`, `update`) VALUES ('$ordinaryNumber', '$quantity', '$itemType', '$model', '$update')";

    if($conn->query($sql) === TRUE) {
      echo "<p>Data inserted successfully!</p>";
    } else {
      echo "Error: ". $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<?php include('../includes/header.php'); ?>

    <form method="post">
        <div class="container">
            <h1 class="text-center">ሞዴል 20 ወጪ</h1>
            <form>
              <div class="form-group">
          
                <input type="number" class="form-control" id="ordinary-number" name="ordinary-number" placeholder="ተራ ቁጥር">
              </div>

              <div class="form-group">
              
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder=" ብዛት">
           
              </div>

              <div class="form-group">
             
                <input type="text" class="form-control" id="item-type" name="item-type" placeholder="የእቃው አይነት">
              </div>
              <div class="form-group">
                
                <input type="text" class="form-control" id="model" name="model" placeholder="ሞዴል">
              </div>
          
              <div class="form-group">
                
                <input type="text" class="form-control" id="update"  name="update" placeholder="ማሻሻያ አምድ">
              </div>
          
             
              <button type="submit" class="btn btn-primary" name="add_model">አስገባ</button>
            </form>
          </div>
    </form>
</body>
</html>