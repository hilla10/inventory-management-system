


<!-- modal for item -->

<form action="../includes/insert_app.php" method="post">
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
           <h2 class="fs-3 text-center py-3">የግዥ መጠየቂያ ፎርም</h2>

            <div class="form-group input-box mb-2">
                <input required type="text" class="form-control" id="inventory-list" name="inventory-list">
                <span>የእቃው ዝርዝር</span>
            </div>

            <div class="form-group input-box mb-2">
                      <label for="gender" class="py-2">Select Department:</label>
                     <select name="department" id="department" class="select-option">
                            <?php
                            // Include the database connection
                            include('dbcon.php');

                            // Function to fetch departments from database
                            function fetchDepartmentsAndDisplay($connection)
                            {
                                $departments = [];

                                $query = "SELECT `name` FROM departments";
                                $result = mysqli_query($connection, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $departments[] = $row['name'];
                                    }
                                    mysqli_free_result($result);
                                }

                                return $departments;
                            }

                            // Fetch departments
                            $departments = fetchDepartmentsAndDisplay($connection);

                            // Output options for select dropdown
                            foreach ($departments as $dept) {
                                echo '<option value="' . htmlspecialchars($dept) . '">' . htmlspecialchars($dept) . '</option>';
                            }

                            // Close database connection
                            mysqli_close($connection);
                            ?>
                        </select>
            </div>
             <div class="form-group input-box mb-2">
                    <label for="item-type" class="py-2">Enter item type</label>
                    <select name="item-type" class="select-option">
                        <option value="consumable">አላቂ እቃ</option>
                        <option value="non-consumable">የማያልቅ እቃ</option>
                    </select>
              </div>  

            <div class="form-group input-box mb-2">
                <input required type="text" class="form-control" id="description" name="description">
                <span>መግለጫ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input required type="number" class="form-control" id="measure" name="measure">
                <span>መለኪያ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input required type="number" class="form-control" id="quantity" name="quantity">
                <span>ብዛት</span>
            </div>
            <div class="form-group input-box mb-2">
                <input required type="number" class="form-control" id="price" name="price">
                <span>የአንዱ ዋጋ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input type="number" class="form-control" id="total-price" name="total-price" >
                <span>ጠቅላላ ዋጋ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input required type="text" class="form-control" id="examination" name="examination" >
                <span>ምርመራ</span>
            </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input required type="submit" class="btn btn-success" name="add_item" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>



<!-- modal for bin card -->
<form action="insert_app.php" method="post">
  <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bin Card</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h2 class="fs-3 text-center py-3">ቢን ካርድ</h2>

             <div class="form-group input-box my-2">
                <input required type="date" class="form-control" id="date" name="date">
              </div>
              <div class="form-group input-box my-2">
                <input required type="number" class="form-control" id="Phone" name="income">
                <span>ገቢ</span>
           
              </div>
              <div class="form-group input-box my-2">
                
                <input required type="number" class="form-control" id="age" name="cost">
                <span>ወጪ</span>
              </div>
          
              <div class="form-group input-box my-2">
              
                <input required type="number" class="form-control" id="Phone" name="remain">
                <span>ከወጪ ቀሪ</span>
           
              </div>
              <div class="form-group input-box my-2">
              
                <input required type="number" class="form-control" id="Phone" name="short">
                <span>አጭር ፈር</span>
           
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input required type="submit" class="btn btn-success" name="add_bin" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>
  

<!-- modal for user register -->
  <form action="../includes/user_register.php" method="post">
    <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                    <div class="form-group input-box">
                        <input required type="text" class="form-control" name="username">
                        <span>ስሞትን ያስገቡ| Enter your name|</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                        <select name="gender" class="select-option">
                            <option value="male">ወንድ</option>
                            <option value="female">ሴት</option>
                        </select>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" name="age">
                        <span>አድሜ ያስገቡ |Enter your age|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="email" class="form-control" name="email">
                        <span>ኢሜል ያስገቡ|Enter your email|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" name="Phone">
                        <span>ስልክ ቁጥር ያስገቡ |Enter your phone.no|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
                        <select name="position" class="select-option">
                            <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                            <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                            <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                            <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                        </select>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="password" class="form-control psw" name="passwords">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል |Enter your password|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="password" class="form-control psw" name="confirm">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል አረጋግጥ| Confirm your password|</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input required type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- modal for user register admin page-->
  <!-- <form action="user_register.php" method="post">
    <div class="modal fade" id="Modal8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                    <div class="form-group input-box">
                        <input required type="text" class="form-control" name="username">
                        <span>ስሞትን ያስገቡ| Enter your name|</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                        <select name="gender" class="select-option">
                            <option value="male">ወንድ</option>
                            <option value="female">ሴት</option>
                        </select>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" name="age">
                        <span>አድሜ ያስገቡ |Enter your age|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="email" class="form-control" name="email">
                        <span>ኢሜል ያስገቡ|Enter your email|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" name="Phone">
                        <span>ስልክ ቁጥር ያስገቡ |Enter your phone.no|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
                        <select name="position" class="select-option">
                            <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                            <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                            <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                            <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                        </select>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="password" class="form-control psw" name="passwords">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል |Enter your password|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input required type="password" class="form-control psw" name="confirm">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል አረጋግጥ| Confirm your password|</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input required type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> -->

<!-- modal for Model 19 -->
<form action="insert_app.php" method="post">
 <div class="modal fade" id="Modal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model 19</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <div class="form-group input-box mb-2">
             
                <input required type="text" class="form-control" id="item-type" name="item-type">
                <span>የእቃው አይነት</span>
              </div>
              <div class="form-group input-box mb-2">
                
                <input required type="text" class="form-control" id="model" name="model">
                <span>ሞዴል</span>
              </div>
              <div class="form-group input-box mb-2">
             
                <input required type="number" class="form-control" id="serie" name="serie">
                <span>ሴሪ</span>
              </div>
              <div class="form-group input-box mb-2">
              
                <input required type="number" class="form-control quantity" id="quantity" name="quantity">
                <span>ብዛት</span>
              </div>
             <div class="form-group input-box mb-2">
                <input required type="number" class="form-control price" id="price" name="price">
                <span>የአንዱ ዋጋ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input required type="number" class="form-control total-price" id="total-price" name="total-price" >
                <span>ጠቅላላ ዋጋ</span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input required type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>


<!-- modal for Model 20 -->
<form action="insert_app.php" method="post">
    <div class="modal fade" id="Modal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model 20</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-box mb-2">
                        <input required type="text" class="form-control" id="requested-by" name="requested-by">
                        <span>ስሞትን ያስገቡ| Enter your name|</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" id="quantity" name="quantity">
                        <span>ብዛት</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="text" class="form-control" id="item-type" name="item-type">
                        <span>የእቃው አይነት</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="text" class="form-control" id="model" name="model">
                        <span>ሞዴል</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control" id="update" name="update">
                        <span>ማሻሻያ አምድ</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ዝጋብ</button>
                    <input required type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
                </div>
            </div>
        </div>
    </div>
</form>


  <!-- modal for user register for login page -->

   <form action="./includes/user_register.php" method="post">
        <div class="modal fade" id="Modal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                        <div class="form-group input-box">

                            <input required type="text" class="form-control" name="username">
                                <span>ስሞትን ያስገቡ| Enter your name|</span>
                        </div>
                        <div class="form-group input-box mb-2">
                            <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                            <select name="gender" class="select-option">
                                <option value="male">ወንድ</option>
                                <option value="female">ሴት</option>
                            </select>
                        </div>


                        <div class="form-group input-box mb-2">

                            <input required type="number" class="form-control" name="age">
                            <span>አድሜ ያስገቡ |Enter your age|</span>
                        </div>

                        <div class="form-group input-box mb-2">

                            <input required type="email" class="form-control" name="email">
                            <span>ኢሜል ያስገቡ|Enter your email|</span>
                               
                        </div>

                        <div class="form-group input-box mb-2">

                            <input required type="number" class="form-control" name="Phone">
                                <span>ስልክ ቁጥር ያስገቡ |Enter your phone.no|</span>
                        </div>

                        <div class="form-group input-box mb-2">
                            <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
                            <select name="position" class="select-option">
                                <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                                <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                                <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                                <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                            </select>
                        </div>

                        <div class="form-group input-box mb-2">

                            <input required type="password" class="form-control psw" name="passwords">
                            <i class="fa-solid fa-eye-slash showHideBtn"></i>

                            <span>የይለፍ ቃል |Enter your password|</span>
  
                        </div>

                        <div class="form-group input-box mb-2">

                            <input required type="password" class="form-control psw" name="confirm">
                            <i class="fa-solid fa-eye-slash showHideBtn"></i>
                                <span>የይለፍ ቃል አረጋግጥ| Confirm your password|</span>
 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input required type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<!-- modal for department register -->
<form action="../includes/department_register.php" method="post">
    <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Department</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="fs-3 text-center py-3">የዲፓርትመንት ምዝገባ ቅጽ</h2>
                    <div class="form-group input-box mb-2">
                        <input required type="text" class="form-control" id="username" name="username">
                        <span>ስሞትን ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="email" class="form-control" id="email" name="email">
                        <span>ኢሜል ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" id="age" name="age">
                        <span>አድሜ ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" id="Phone" name="phone">
                        <span>ስልክ ቁጥር ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <div class="form-group input-box mb-2">
                            <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:</label>
                            <select name="position" class="select-option">
                                <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                                <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                                <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                                <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input required type="submit" class="btn btn-success" name="add_department" value="አስገባ"></input>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="Modal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" roll="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content bg-modal-color">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Notification</h1>
                <i class="fas fa-close" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body w-100">
                <div id="notificationContent" class="pb-2">
                    
            <ul class="my-3 ms-3 ps-0">
                    <?php if ($pendingCount > 0) {
                        ?>
                    <?php foreach ($pendingRequestsNotifications as $request): ?>
                        <li class="py-3"><a href="../request/index.php" class="list__group-link list__group-link-rq"><?php echo $request; ?></a></li>
                       
                        </a>
                            <?php endforeach; ?>
                        <?php 
                        } else {
                        echo "<div class=\"text-center text-light fs-3 text-light\">There is no message</div>";
                        } 
                        ?>
                        </ul>
                </div>
                <div class="border"></div>
            <ul class="my-3 ms-3 ps-0">
                    <?php foreach ($lowStockNotifications as $notification): ?>
                        <li class="py-3"><a href="/group-project/<?php echo $link; ?>\" class="list__group-link list__group-link-nt"><?php echo $notification; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- modal for department register for admin page
<form action="department_register.php" method="post">
    <div class="modal fade" id="Modal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Department</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="fs-3 text-center py-3">የዲፓርትመንት ምዝገባ ቅጽ</h2>
                    <div class="form-group input-box mb-2">
                        <input required type="text" class="form-control" id="username" name="username">
                        <span>ስሞትን ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="email" class="form-control" id="email" name="email">
                        <span>ኢሜል ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" id="age" name="age">
                        <span>አድሜ ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input required type="number" class="form-control" id="Phone" name="phone">
                        <span>ስልክ ቁጥር ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <div class="form-group input-box mb-2">
                            <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:</label>
                            <select name="position" class="select-option">
                                <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                                <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                                <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                                <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input required type="submit" class="btn btn-success" name="add_department" value="አስገባ"></input>
                </div>
            </div>
        </div>
    </div>
</form> -->

    

<!-- Modal for deleting user -->
<form action="../includes/delete_user.php" method="post">
  <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group input-box my-2">
            <input required type="text" class="form-control" id="email" name="email">
            <span>Enter your email to delete</span>
          </div>
            <div class="form-group input-box my-2">
                <input required type="password" class="form-control psw" name="password">
                <i class="fa-solid fa-eye-slash showHideBtn"></i>
                <span>Enter your password</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-danger" name="delete_user" value="Delete User">
        </div>
      </div>
    </div>
  </div>
</form>

