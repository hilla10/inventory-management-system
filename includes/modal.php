   



<!-- modal for bin card -->
<form action="insert_app.php" method="post" class="insert-binCard-form">
  <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shake-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bin Card</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h2 class="fs-3 text-center py-3">ቢን ካርድ</h2>

             <div class="form-group input-box my-2">
                <input  type="date" class="form-control" id="date" name="date">
              </div>
              <div class="form-group input-box my-2">
                <input  type="text" class="form-control" id="income" name="income">
                <span>ገቢ</span>
           
              </div>
              <div class="form-group input-box my-2">
                
                <input  type="text" class="form-control" id="cost" name="cost">
                <span>ወጪ</span>
              </div>
          
              <div class="form-group input-box my-2">
              
                <input disabled type="text" class="form-control" id="remain" name="remain">
                <span>ከወጪ ቀሪ</span>
           
              </div>
              <div class="form-group input-box my-2">
              
                <input  type="text" class="form-control" id="short" name="short">
                <span>አጭር ፈር</span>
           
              </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input  type="submit" class="btn btn-success" name="add_bin" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>
  

<!-- modal for user user -->
  <form action="../includes/user_register.php" method="post"  class="userForm">
    <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content form-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                    <div class="form-group input-box">
                        <input  type="text" class="form-control name" name="username">
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
                        <input  type="number" class="form-control age" name="age">
                        <span>አድሜ ያስገቡ |Enter your age|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input  type="email" class="form-control email" name="email">
                        <span>ኢሜል ያስገቡ|Enter your email|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control phone" name="phone">
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
                        <input  type="password" class="form-control validPassword" name="password">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል |Enter your password|</span>
                    </div> 
                    <div class="d-flex message">
                            <div>
                             <p class="char-length">At least 8 characters long</p>
                                    <p class="char-uppercase-letter">At least one uppercase letter</p>
                                    <p class="char-lowercase-letter">At least one lowercase letter</p>
                            </div>

                            <div>
                            <p class="digit">At least one digit</p>
                            <p class="special-char">At least one special character</p>
                            </div>
                        </div>

                    <div class="form-group input-box mb-2">
                        <input  type="password" class="form-control confirm" name="confirm">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል አረጋግጥ| Confirm your password|</span>
                    </div>
                     

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input  type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

  <!-- modal for user user for login page -->

  <form action="./includes/user_users.php" method="post"  class="userForm">
    <div class="modal fade" id="Modal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content form-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                    <div class="form-group input-box">
                        <input  type="text" class="form-control name" name="username">
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
                        <input  type="number" class="form-control age" name="age">
                        <span>አድሜ ያስገቡ |Enter your age|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input  type="email" class="form-control email" name="email">
                        <span>ኢሜል ያስገቡ|Enter your email|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control phone" name="phone">
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
                        <input  type="password" class="form-control validPassword" name="password">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል |Enter your password|</span>
                    </div> 
                    <div class="d-flex message">
                            <div>
                             <p class="char-length">At least 8 characters long</p>
                                    <p class="char-uppercase-letter">At least one uppercase letter</p>
                                    <p class="char-lowercase-letter">At least one lowercase letter</p>
                            </div>

                            <div>
                            <p class="digit">At least one digit</p>
                            <p class="special-char">At least one special character</p>
                            </div>
                        </div>

                    <div class="form-group input-box mb-2">
                        <input  type="password" class="form-control confirm" name="confirm">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል አረጋግጥ| Confirm your password|</span>
                    </div>
                     

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input  type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal for department user -->
<form action="../includes/department_register.php" method="post" class="userForm">
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
                        <input  type="text" class="form-control name" id="username" name="username">
                        <span>ስሞትን ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input  type="email" class="form-control email" name="email">
                        <span>ኢሜል ያስገቡ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input  type="number" class="form-control age" id="age" name="age">
                        <span>አድሜ ያስገቡ</span>
                    </div>
                  <div class="form-group input-box mb-2">
                            <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                            <select name="gender" class="select-option">
                                <option value="male">ወንድ</option>
                                <option value="female">ሴት</option>
                            </select>
                        </div>
                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control phone" id="phone" name="phone">
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
                    <input  type="submit" class="btn btn-success" name="add_department" value="አስገባ"></input>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- modal for Model 19 -->
<form action="insert_app.php" method="post" class="insert-model-app-form">
 <div class="modal fade" id="Modal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shake-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model 19</h1>
        <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control" id="added-by" name="added-by">
                        <span>ስሞትን ያስገቡ| Enter your name|</span>
                    </div>
              <div class="form-group input-box mb-2">
             
                <input  type="text" class="form-control" id="item_type" name="item_type">
                <span>የእቃው አይነት</span>
              </div>
              <div class="form-group input-box mb-2">
                        <label for="item_category" class="py-2">Enter item category</label>
                        <select name="item_category" class="select-option">
                            <option value="consumable">አላቂ እቃ</option>
                            <option value="non-consumable">የማያልቅ እቃ</option>
                        </select>
                </div>  
              <div class="form-group input-box mb-2">
                
                <input  type="text" class="form-control" id="model" name="model">
                <span>ሞዴል</span>
              </div>
              <div class="form-group input-box mb-2">
             
                <input  type="text" class="form-control" id="serie" name="serie">
                <span>ሴሪ</span>
              </div>
              <div class="form-group input-box mb-2">
              
                <input  type="text" class="form-control quantity" id="quantity" name="quantity">
                <span>ብዛት</span>
              </div>
             <div class="form-group input-box mb-2">
                <input  type="text" class="form-control price" id="price" name="price">
                <span>የአንዱ ዋጋ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input  type="text" class="form-control total_price" id="total_price" name="total_price" disabled>
                <span>ጠቅላላ ዋጋ</span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input  type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>


<!-- modal for Model 20 -->
<form action="insert_app.php" method="post" class="insert-model20-app-form">
    <div class="modal fade" id="Modal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shake-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model 20</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control" id="requested-by" name="requested-by">
                        <span>ስሞትን ያስገቡ| Enter your name|</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control quantity" id="quantity" name="quantity">
                        <span>ብዛት</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control" id="item_type" name="item_type">
                        <span>የእቃው አይነት</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <label for="item_category" class="py-2">Enter item category</label>
                        <select name="item_category" class="select-option">
                            <option value="consumable">አላቂ እቃ</option>
                            <option value="non-consumable">የማያልቅ እቃ</option>
                        </select>
                </div>  
                    <div class="form-group input-box mb-2">
                        <input  type="text" class="form-control" id="model" name="model">
                        <span>ሞዴል</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control" id="update" name="update">
                        <span>ማሻሻያ አምድ</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                    <input  type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- modal for item -->

<form action="../includes/insert_app.php" method="post" class="insert-app-form">
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shake-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="fs-3 text-center py-3">የግዥ መጠየቂያ ፎርም</h2>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control inventory_list" id="inventory_list" name="inventory_list">
                        <span>የእቃው ዝርዝር</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <label for="department" class="py-2">Select Department:</label>
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

                                    // Function to determine current department from the URL
                                    function determineCurrentPageDep($currentUrl)
                                    {
                                        $path = parse_url($currentUrl, PHP_URL_PATH);
                                        // Remove any double slashes to ensure correct path segmentation
                                        $path = str_replace('//', '/', $path);
                                        $segments = explode('/', trim($path, '/'));
                                        $allowedDepartments = fetchDepartments();

                                        foreach ($segments as $key => $segment) {
                                            if (in_array(strtoupper($segment), $allowedDepartments)) {
                                                return strtoupper($segment); // Return the department found
                                            }
                                        }
                                        return ''; // Return empty if no valid department found
                                    }

                                    // Fetch departments
                                    $departments = fetchDepartmentsAndDisplay($connection);

                                    // Determine current department from the current URL
                                    $requestUri = $_SERVER['REQUEST_URI'];
                                    $currentDepartment = determineCurrentPageDep($requestUri);

                                    // Output select dropdown options
                                    echo '<select name="department" id="department" class="select-option">';
                                    // Output the current department as the first option if it exists in the fetched departments
                                    if (!empty($currentDepartment) && in_array($currentDepartment, $departments)) {
                                        echo '<option value="' . htmlspecialchars($currentDepartment) . '">' . htmlspecialchars($currentDepartment) . '</option>';
                                    }
                                    // Output other departments
                                    foreach ($departments as $dept) {
                                        if ($dept !== $currentDepartment) {
                                            echo '<option value="' . htmlspecialchars($dept) . '">' . htmlspecialchars($dept) . '</option>';
                                        }
                                    }
                                    echo '</select>';

                                    // Close database connection
                                    mysqli_close($connection);
                                    ?>
                        </select>
                    </div>
                      <div class="form-group input-box mb-2">
                        <input type="text" class="form-control item_type" id="item_type" name="item_type">
                        <span>የእቃው አይነት</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <label for="item_category" class="py-2">Enter item category</label>
                        <select name="item_category" class="select-option">
                            <option value="consumable">አላቂ እቃ</option>
                            <option value="non-consumable">የማያልቅ እቃ</option>
                        </select>
                    </div>  
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control description" id="description" name="description">
                        <span>መግለጫ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control measure" id="measure" name="measure">
                        <span>መለኪያ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control quantity" id="quantity" name="quantity">
                        <span>ብዛት</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control price" id="price" name="price" step="0.1">
                        <span>የአንዱ ዋጋ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="number" class="form-control" id="total_price" name="total_price" disabled>
                        <span>ጠቅላላ ዋጋ</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control examination" id="examination" name="examination">
                        <span>ምርመራ</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_item" value="አስገባ"></input>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- notification modal -->
<div class="modal fade" id="Modal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content bg-modal-color">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Notification</h1>
                <i class="fas fa-close" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body w-100">
                <?php if($totalNotifications > 0): ?>
                    <!-- Display pending requests notifications -->
                    <?php if ($pendingCount > 0): ?>
                        <div id="notificationContent" class="pb-2">
                            <p class="text-light">Requested Items</p>
                            <ul class="my-3 ms-3 ps-0">
                                <?php foreach ($pendingRequestsNotifications as $request): ?>
                                    <li class="py-1"><a href="../request/index.php" class="list__group-link "><?php echo $request; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="border"></div>
                    <?php endif; ?>
                    
                    <!-- Display pending added notifications -->
                    <?php if ($pendingAddedCount > 0): ?>
                        <div id="notificationContent" class="pb-2">
                            <p class="text-light">Added Items</p>
                            <ul class="my-3 ms-3 ps-0">
                                <?php foreach ($pendingAddedNotifications as $added): ?>
                                    <li class="py-1"><a href="../added/index.php" class="list__group-link "><?php echo $added; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="border"></div>
                    <?php endif; ?>
                    
                    <!-- Display low stock notifications -->
                    <ul class="my-3 ms-3 ps-0">
                            <p class="text-light">Out of Items</p>
                        <?php foreach ($lowStockNotifications as $notification): ?>
                            <li class="py-1"><a href="/group-project/<?php echo $link; ?>\" class="list__group-link "><?php echo $notification; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="text-center text-light fs-3">There are no notifications.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<!-- Modal for deleting user -->
<form action="../includes/delete_user.php" method="post" class="userForm">
  <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group input-box my-2">
            <input  type="text" class="form-control email" name="email">
            <span>Enter your email to delete</span>
          </div>
            <div class="form-group input-box my-2">
                <input  type="password" class="form-control validPassword" name="password">
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
