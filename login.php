 <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$form_username = trim($_POST['username']);
$form_password = trim($_POST['password']);
$option = trim($_POST['options']);

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$form_username = $conn->real_escape_string($form_username); // Escape the username to prevent SQL injection
$form_password = $conn->real_escape_string($form_password); // Escape the password to prevent SQL injection

$check_user_sql = "SELECT * FROM `user` WHERE user_name='$form_username' AND password='$form_password' AND `option`='$option'";

$user_result = $conn->query($check_user_sql);

function checkCredentials($username, $password) {
    
    if ($username === "user_name" && $password === "password") {
        return true;
    } else {
        return false;
    }
}

function checkUserType($option) {
    if ($option === "it head") {
        header("Location: it.php");
        exit(); // Add an exit statement after redirecting
    } elseif ($option === "business head") {
        header("Location: business.php");
        exit(); // Add an exit statement after redirecting
    } elseif ($option === "art head") {
        header("Location: art.php");
        exit(); // Add an exit statement after redirecting
    } elseif ($option === "auto head") {
        header("Location: auto.php");
        exit();
    } else {
        return "unknown user_type";
    }
}

if ($user_result->num_rows > 0) {
    echo "User name and password are correct";
    $option_description = checkUserType($option);
    echo "User is a $option_description";
} else {
    echo "Incorrect user name or password";
}

$conn->close();

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reg.css">
    <title>ዋናው መመዝገቢያ ቅጽ</title>
    <style>
      input[type="password"]
   {
    border-radius: 4px;
    border: 1px solid #ccc;
    padding: 10px;
    width: 400px;
  }
    </style>
</head>
<body>

 <header class="header">
        <nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="logo">
            </div>
            <ul class="list">
                <li class="item "><a href="register.php">Register</a></li>
                <li class="item"><a href="art.php">Art</a></li>
                <li class="item"><a href="auto.php">Auto</a></li>
                <li class="item"><a href="bin.php">Bin</a></li>
                <li class="item"><a href="business.php">Business</a></li>
                <li class="item"><a href="buy.php">Buy</a></li>
                <li class="item"><a href="de.php">Delete</a></li>
                <li class="item"><a href="depre.php">Department Register</a></li>
                <li class="item"><a href="it.php">It</a></li>
                <li class="item"><a href="out.php">Model 20 cost</a></li>
                <li class="item"><a href="tempo.php">Model 19 cost</a></li>
                <li class="item"><a href="up.php">Update Authority</a></li>
            </ul>
            <button class="btn btn-primary active">Login</button>
        </nav>
    </header>

    <form method="post">
        <div class="container">
            <h1 class="text-center">ዋናው መመዝገቢያ ቅጽ</h1>
       

              <div class="form-group">
          
                <input type="text" class="form-control" name="username" placeholder="ስሞትን ያስገቡ">
              </div>
             
          
              <div class="form-group">
              <label for="position">ያሉበትን ሁኔታ ይምረጡ:</label>
              <select name="options">
                  <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                  <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                  <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                  <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
              </select><br><br>

              <div class="form-group">
             
             <input type="password" class="form-control" name="password" placeholder=" የይለፍ ቃል">
           </div>

            </div>
              <button type="submit" class="btn btn-primary">አስገባ</button>
          </div>
    </form>
</body>
</html>