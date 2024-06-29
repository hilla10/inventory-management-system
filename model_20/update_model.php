     <?php  $title = "Update Model 20"; // Set the default title
                    if (isset($title) && !empty($title)) {
                        echo "<script>document.title = '" . $title . "'</script>";
                    }
                    ?>
<div class=" py-2 text-light primary-color mx-auto">
    <h1 class="text-center fs-3">ሞዴል 20 ገቢ ፎርም </h1>

 </div>


    <div class="container mt-5 w-50">

<form action="update.php?id_new=<?php echo  $ordinary_number; ?>" method="post" class="update insert-model20-app-form shake-model20-content">

            <div class="form-group  input-box mb-2">
                     <input type="text" class="form-control quantity" id="quantity" name="quantity" placeholder="quantity" value="<?php echo $row['quantity'] ?>">
            </div>
              <div class="form-group input-box mb-2">
                        <input type="text" class="form-control requested-by" id="requested-by" name="requested-by" placeholder="name" value="<?php echo $row['requested_by'] ?>">
                    </div>
            <div class="form-group  input-box mb-2">
                     <input type="text" class="form-control item_type" id="item_type" name="item_type" placeholder="item type" value="<?php echo $row['item_type'] ?>">
            </div>

             <div class="form-group  input-box input-box mb-2">
                    <select name="item_category" class="select-option">
                        <option value="consumable">አላቂ እቃ</option>
                        <option value="non-consumable">የማያልቅ እቃ</option>
                    </select>
              </div> 

            <div class="form-group  input-box mb-2">
               
                     <input type="text" class="form-control model" id="model" name="model" placeholder="model" value="<?php echo $row['model'] ?>">
            </div>

            <div class="form-group  input-box mb-2">
               
                     <input type="text" class="form-control update" id="update" name="update" placeholder="update" value="<?php echo $row['update'] ?>">
            </div>

             <input type="submit" class="btn btn-success" name="update_model" value="Update"></input>
</form>

