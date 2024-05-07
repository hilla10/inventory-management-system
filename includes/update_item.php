
 <div class=" py-3 text-center bg-dark text-light">
     <h1 >የግዥ መጠየቂያ ፎርም
      </h1>

 </div>

    <div class="container mt-5">
        
<form action="update.php?id_new=<?php echo $ordinary_number; ?>" method="post">

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="inventory-list" name="inventory-list" placeholder="የእቃው ዝርዝር" value="<?php echo $row['inventory-list'] ?>">
            </div>
            
            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="description" name="description" placeholder="የእቃው ዝርዝር" value="<?php echo $row['description'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="measure" name="measure" placeholder="የእቃው ዝርዝር" value="<?php echo $row['measure'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="quantity" name="quantity" placeholder="የእቃው ዝርዝር" value="<?php echo $row['quantity'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="price" name="price" placeholder="የእቃው ዝርዝር" value="<?php echo $row['price'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="total-price" name="total-price" placeholder="የእቃው ዝርዝር" value="<?php echo $row['total-price'] ?>">
            </div>

            <div class="form-group mb-2">
               
                     <input type="text" class="form-control" id="examination" name="examination" placeholder="የእቃው ዝርዝር" value="<?php echo $row['examination'] ?>">
            </div>
           
             <input type="submit" class="btn btn-success" name="update_items" value="Update"></input>
</form>

