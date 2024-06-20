<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- google font noto serif Ethiopic-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Ethiopic:wght@100..900&display=swap" rel="stylesheet">
 <!-- google font open sans-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<!-- font awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- style file -->
<!-- <link rel="stylesheet" href="../css/style.css"> -->
 <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">

   <!-- bootstrap js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <!-- main js -->
<script src="../js/main.js?v=<?php echo time(); ?>" defer></script>

  <title>የግዥ መጠየቂያ ፎርም</title>
    
</head>
<body  class="body text-light">

       <div class=" py-2 text-light primary-color mx-auto">
            <h1 class="text-center fs-3">የግዥ መጠየቂያ ፎርም</h1>
</div>

 

    <div class="container mt-5 w-50">

    
        
<form action="update.php?id_new=<?php echo $ordinary_number; ?>" method="post" class="update">

            <div class="form-group mb-2 input-box">
                     <input type="text" class="form-control" id="inventory-list" name="inventory-list" placeholder="የእቃው ዝርዝር" value="<?php echo $row['inventory-list'] ?>">
            </div>
            
            <div class="form-group mb-2 input-box">
                     <input type="text" class="form-control" id="description" name="description" placeholder="የእቃው ዝርዝር" value="<?php echo $row['description'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
               
                     <input type="text" class="form-control" id="measure" name="measure" placeholder="የእቃው ዝርዝር" value="<?php echo $row['measure'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
               
                     <input type="text" class="form-control" id="quantity" name="quantity" placeholder="የእቃው ዝርዝር" value="<?php echo $row['quantity'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
               
                     <input type="text" class="form-control" id="price" name="price" placeholder="የእቃው ዝርዝር" value="<?php echo $row['price'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
               
                     <input type="text" class="form-control" id="total-price" name="total-price" placeholder="የእቃው ዝርዝር" value="<?php echo $row['total-price'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
               
                     <input type="text" class="form-control" id="examination" name="examination" placeholder="የእቃው ዝርዝር" value="<?php echo $row['examination'] ?>">
            </div>
           
             <input type="submit" class="btn btn-success" name="update_items" value="Update"></input>
</form>

</body>
</html>