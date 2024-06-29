 
                <?php  $title = "Update Model 19"; // Set the default title
                    if (isset($title) && !empty($title)) {
                        echo "<script>document.title = '" . $title . "'</script>";
                    }
                    ?>

 <div class=" py-2 text-light primary-color mx-auto">
    <h1 class="text-center fs-3">ሞዴል 19 ገቢ ፎርም </h1>

 </div>

    <div class="container mt-5 w-50">

<form action="update.php?id_new=<?php echo  $ordinary_number; ?>" method="post" class="insert-model19-app-form update shake-model19-content">
    
            <div class="form-group input-box mb-2">
                    <input type="text" class="form-control added-by" id="added-by" name="added-by" placeholder="ስም" value="<?php echo $row['added_by'] ?>">
            </div>
    
            <div class="form-group input-box mb-2">
                    <select name="item_category" class="select-option">
                        <option value="consumable">አላቂ እቃ</option>
                        <option value="non-consumable">የማያልቅ እቃ</option>
                    </select>
              </div> 
    
            <div class="form-group input-box  mb-2">
                    <input type="text" class="form-control item_type" id="item_type" name="item_type" placeholder="የእቃው አይነት" value="<?php echo $row['item_type'] ?>">
            </div>


            <div class="form-group input-box  mb-2">
                
                        <input type="text" class="form-control model" id="model" name="model" placeholder="ሞዴል" value="<?php echo $row['model'] ?>">
            </div>
            

            <div class="form-group input-box  mb-2">
                
                        <input type="text" class="form-control serie" id="serie" name="serie" placeholder="ሴሪ" value="<?php echo $row['serie'] ?>">
            </div>

            <div class="form-group input-box  mb-2">
                     <input type="text" class="form-control quantity" id="quantity" name="quantity" placeholder="ብዛት" value="<?php echo $row['quantity'] ?>">
            </div>
            
            <div class="form-group input-box  mb-2">
                
                        <input type="text" class="form-control price" id="price" name="price" placeholder="የአንዱ ዋጋ" value="<?php echo $row['price'] ?>">
            </div>
            
            <div class="form-group input-box  mb-2">
                
                        <input type="text" class="form-control" id="total_price" name="total_price" placeholder="ጠቅላላ ዋጋ" value="<?php echo $row['total_price'] ?>" readonly>
            </div>

             <input type="submit" class="btn btn-success" name="update_model" value="Update"></input>
</form>

