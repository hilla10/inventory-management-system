 
 <div class=" py-3 text-center bg-dark text-light">
    <h1 >ሞዴል 19 ገቢ ፎርም </h1>

 </div>

    <div class="container mt-5">

<form action="update.php?id_new=<?php echo  $ordinary_number; ?>" method="post">
    
            <div class="form-group mb-2">
                    <input type="text" class="form-control" id="added-by" name="added-by" placeholder="ስም" value="<?php echo $row['added_by'] ?>">
            </div>
    
            <div class="form-group mb-2">
                    <input type="text" class="form-control" id="item-type" name="item-type" placeholder="የእቃው አይነት" value="<?php echo $row['item-type'] ?>">
            </div>


            <div class="form-group mb-2">
                
                        <input type="text" class="form-control" id="model" name="model" placeholder="ሞዴል" value="<?php echo $row['model'] ?>">
            </div>
            

            <div class="form-group mb-2">
                
                        <input type="text" class="form-control" id="serie" name="serie" placeholder="ሴሪ" value="<?php echo $row['serie'] ?>">
            </div>

            <div class="form-group mb-2">
                     <input type="text" class="form-control" id="quantity" name="quantity" placeholder="ብዛት" value="<?php echo $row['quantity'] ?>">
            </div>
            
            <div class="form-group mb-2">
                
                        <input type="text" class="form-control" id="price" name="price" placeholder="የአንዱ ዋጋ" value="<?php echo $row['price'] ?>">
            </div>
            
            <div class="form-group mb-2">
                
                        <input type="text" class="form-control" id="total-price" name="total-price" placeholder="ጠቅላላ ዋጋ" value="<?php echo $row['total-price'] ?>">
            </div>

             <input type="submit" class="btn btn-success" name="update_model" value="Update"></input>
</form>

