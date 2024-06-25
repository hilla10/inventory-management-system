<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Font: Noto Serif Ethiopic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Ethiopic:wght@100..900&display=swap" rel="stylesheet">
    <!-- Google Font: Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  

    <title>Update Items</title>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const quantity = document.getElementById('quantity');
            const price = document.getElementById('price');
            const totalPriceField = document.getElementById('total-price');

            const calculateTotalPrice = () => {
                const totalPrice = quantity.value * price.value;
                totalPriceField.value = totalPrice.toFixed(2);
            }

            quantity.addEventListener('input', calculateTotalPrice);
            price.addEventListener('input', calculateTotalPrice);
        });
    </script>
</head>
<body class="body text-light">

    <div class="py-2 text-light primary-color mx-auto">
        <h1 class="text-center fs-3">Update Items</h1>
    </div>

    <div class="container mt-5 w-50">
        <form action="update.php?id_new=<?php echo urlencode($ordinary_number); ?>&department=<?php echo urlencode($department); ?>" method="post" class="update">
            <div class="form-group mb-2 input-box">
                <input type="text" class="form-control" id="department" name="department" placeholder="ዲፖርትመንት" value="<?php echo $row['department'] ?>">
            </div>
             <div class="form-group input-box mb-2">
                    <select name="item-type" class="select-option">
                        <option value="consumable">አላቂ እቃ</option>
                        <option value="non-consumable">የማያልቅ እቃ</option>
                    </select>
              </div> 
            <div class="form-group mb-2 input-box">
                <input type="text" class="form-control" id="inventory-list" name="inventory-list" placeholder="የእቃው ዝርዝር" value="<?php echo $row['inventory-list'] ?>">
            </div>
            
            <div class="form-group mb-2 input-box">
                <input type="text" class="form-control" id="description" name="description" placeholder="መግለጫ" value="<?php echo $row['description'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
                <input type="text" class="form-control" id="measure" name="measure" placeholder="መለኪያ" value="<?php echo $row['measure'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="ብዛት" value="<?php echo $row['quantity'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
                <input type="number" class="form-control" id="price" name="price" placeholder="የአንዱ ዋጋ" value="<?php echo $row['price'] ?>">
            </div>

            <div class="form-group mb-2 input-box">
                <input type="number" class="form-control" id="total-price" name="total-price" placeholder="ጠቅላላ ዋጋ" value="<?php echo $row['total-price'] ?>" readonly>
            </div>

            <div class="form-group mb-2 input-box">
                <input type="text" class="form-control" id="examination" name="examination" placeholder="ምርመራ" value="<?php echo $row['examination'] ?>">
            </div>
           
            <input type="submit" class="btn btn-success" name="update_items" value="Update">
        </form>
    </div>

</body>
</html>
