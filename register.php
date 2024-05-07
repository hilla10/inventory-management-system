<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['Phone'];
    $option = $_POST['options'];
    $password = $_POST['passwords'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        echo "The password does not match";
    } else {
        $conn = new mysqli('localhost', 'root', '', 'inventory');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security reasons.

            // Insert the input value into the register table
            $sqlRegister = "INSERT INTO register (username, gender, age, email, Phone, options, passwords) VALUES ('$name', '$gender', '$age', '$email', '$phone', '$option', '$hashedPassword')";

            // Insert the input value into the user table
            $sqlUser = "INSERT INTO user (user_name, password, `option`) VALUES ('$name', '$hashedPassword', '$option')";

            if ($conn->query($sqlRegister) === true && $conn->query($sqlUser) === true) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sqlUser . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reg.css">
    <title>ዋናው መመዝገቢያ ቅጽ</title>

</head>
<body>

 <header class="header">
        <nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="logo">
            </div>
            <ul class="list">
                <li class="item active"><a href="register.php">Register</a></li>
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
            <button class="btn btn-primary">Login</button>
        </nav>
    </header>

    <form method="post">
        <div class="container">
            <h1 class="text-center">ዋናው መመዝገቢያ ቅጽ</h1>

        
              <div class="form-group">
          
                <input type="text" class="form-control" name="username" placeholder="ስሞትን ያስገቡ| Enter your name|">
              </div>
              <div class="form-group">

              <div class="form-group">
              <label for="position">ጾታ አስገባ |Enter your gender|:</label>
              <select name="gender" class="wide-select">
              <option value="male">ወንድ</option>
              <option value="female">ሴት</option>
                </select><br><br>
                </div>

              
              <div class="form-group">
                
                <input type="number" class="form-control" name="age" placeholder="አድሜ ያስገቡ |Enter your age|">
              </div>

              <div class="form-group">

                <input type="email" class="form-control" name="email" placeholder="ኢሜል ያስገቡ|Enter your email|">
              </div>
    
              <div class="form-group">
             
                <input type="number" class="form-control" name="Phone" placeholder=" ስልክ ቁጥር ያስገቡ |Enter your phone.no|">
              </div>
          
              <div class="form-group">
  <label for="position">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
  <select name="position" class="wide-select">
    <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
    <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
    <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
    <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
  </select><br><br>
</div>

              <div class="form-group">
             
             <input type="password" class="form-control" name="passwords" placeholder=" የይለፍ ቃል |Enter your password|">
           </div>

           <div class="form-group">
             
             <input type="password" class="form-control" name="confirm" placeholder=" የይለፍ ቃል አረጋግጥ| Confirm your password|">
           </div>
            </div>
              <button type="submit" class="btn btn-primary">አስገባ</button>
          </div>
    </form>
</body>
</html>