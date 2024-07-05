<!-- notification modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content bg-modal-color">
            <div class="modal-header d-flex justify-content-between">
                <h1 class="modal-title fs-5" id="exampleModalLabel" tabindex="0" aria-label="Notification">Notification</h1>
                <i class="fas fa-close" data-bs-dismiss="modal" aria-label="Close" tabindex="0"></i>
            </div>
            <div class="modal-body w-100">
                <?php if($totalNotifications > 0): ?>
                    <!-- Display pending requests notifications -->
                    <?php if ($pendingCount > 0): ?>
                        <div id="notificationContent" class="pb-2">
                            <p class="text-light" aria-label="Requested Items" tabindex="0">Requested Items</p>
                            <ul class="my-3 ms-3 ps-0">
                                <?php foreach ($pendingRequestsNotifications as $request): ?>
                                    <li class="py-1"><a href="../request/index.php" class="list__group-link " tabindex="0"><?php echo $request; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="border"></div>
                    <?php endif; ?>
                    
                    <!-- Display pending added notifications -->
                    <?php if ($pendingAddedCount > 0): ?>
                        <div id="notificationContent" class="pb-2">
                            <p class="text-light" aria-label="Added Items" tabindex="0">Added Items</p>
                            <ul class="my-3 ms-3 ps-0">
                                <?php foreach ($pendingAddedNotifications as $added): ?>
                                    <li class="py-1"><a href="../added/index.php" class="list__group-link "tabindex="0"><?php echo $added; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="border"></div>
                    <?php endif; ?>
                    
                    <!-- Display low stock notifications -->
                    <ul class="my-3 ms-3 ps-0">
                            <p class="text-light" aria-label="Out of Items" tabindex="0">Out of Items</p>
                        <?php foreach ($lowStockNotifications as $notification): ?>
                            <li class="py-1"><a href="/inventory-management-system/<?php echo $link; ?>\" class="list__group-link "tabindex="0"><?php echo $notification; ?></a></li>
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

  <div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                  <button tabindex="0" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="../includes/delete_user.php" method="post">
                    <div class="form-group input-box my-2">
                        <input type="text" class="form-control" name="email_or_username">
                        <span>Enter your username or email to delete</span>
                    </div>


                      <div class="form-group input-box my-2">
                          <input type="password" class="form-control validPassword" name="password">
                          <i class="fa-solid fa-eye-slash showHideBtn"></i>
                          <span>Enter your password</span>
                      </div>
                      <div class="modal-footer">
                          <button tabindex="0" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="hidden" name="delete_user" value="1"></input>
                        <button tabindex="0" type="submit"  class="btn btn-danger">Delete User</button>
                      </div>

                  </form>
              </div>
          </div>
      </div>
  </div>

<!-- modal for item -->


<div class="modal fade" id="ModalItem" tabindex="-1" aria-labelledby="ModalItemLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shake-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalItemLabel">Add Item</h1>
                    <button tabindex="0" type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../includes/insert_app.php" method="post" class="insert-app-form">
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
                    <div class="modal-footer">
                        <button tabindex="0" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <input type="hidden" name="add_item" value="1"></input>
                        <button tabindex="0" type="submit"  class="btn btn-success">አስገባ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- modal for bin card -->
<div class="modal fade" id="ModalBinCard" tabindex="-1" aria-labelledby="ModalBinCardLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shake-bin-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalBinCardLabel">Add Bin Card</h1>
                <button tabindex="0" type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="insert_app.php" method="post" class="insert-binCard-form">
                    <h2 class="fs-3 text-center py-3">ቢን ካርድ</h2>

                    <div class="form-group input-box my-2">
                        <input type="date" class="form-control date" id="date" name="date">
                    </div>
                    <div class="form-group input-box my-2">
                        <input type="text" class="form-control income" id="income" name="income">
                        <span>ገቢ</span>
                    </div>
                    <div class="form-group input-box my-2">
                        <input type="text" class="form-control cost" id="cost" name="cost">
                        <span>ወጪ</span>
                    </div>
                    <div class="form-group input-box my-2">
                        <input disabled type="text" class="form-control remain" id="remain" name="remain">
                        <span>ከወጪ ቀሪ</span>
                    </div>
                    <div class="form-group input-box my-2">
                        <input type="text" class="form-control short" id="short" name="short">
                        <span>አጭር ፈር</span>
                    </div>
                    <div class="modal-footer">
                        <button tabindex="0" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <input type="hidden" name="add_bin" value="1"></input>
                        <button tabindex="0" type="submit"  class="btn btn-success">አስገባ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- modal for Model 19 -->
  <div class="modal fade" id="ModalModel19" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content shake-model19-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model 19</h1>
                 <button tabindex="0" type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="insert_app.php" method="post" class="insert-model19-app-form">
                     <div class="form-group input-box mb-2">
                         <input type="text" class="form-control added-by" id="added-by" name="added-by">
                         <span>ስሞትን ያስገቡ| Enter your name|</span>
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

                         <input type="text" class="form-control model" id="model" name="model">
                         <span>ሞዴል</span>
                     </div>
                     <div class="form-group input-box mb-2">

                         <input type="text" class="form-control serie" id="serie" name="serie">
                         <span>ሴሪ</span>
                     </div>
                     <div class="form-group input-box mb-2">

                         <input type="text" class="form-control quantity" id="quantity" name="quantity">
                         <span>ብዛት</span>
                     </div>
                     <div class="form-group input-box mb-2">
                         <input type="text" class="form-control price" id="price" name="price">
                         <span>የአንዱ ዋጋ</span>
                     </div>
                     <div class="form-group input-box mb-2">
                         <input type="text" class="form-control total_price" id="total_price" name="total_price"
                             disabled>
                         <span>ጠቅላላ ዋጋ</span>
                     </div>
                     <div class="modal-footer">
                         <button tabindex="0" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <!-- <input type="hidden" name="add_model" value="1"></input>
                         <button tabindex="0" type="submit" class="btn btn-success">አስገባ</button> -->
                         <input type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>


<!-- modal for Model 20 -->
<div class="modal fade" id="ModalModel20" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shake-model20-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model 20</h1>
                <button tabindex="0" type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="insert_app.php" method="post" class="insert-model20-app-form">
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control requested-by" id="requested-by" name="requested-by">
                        <span>ስሞትን ያስገቡ| Enter your name|</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control quantity" id="quantity" name="quantity">
                        <span>ብዛት</span>
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
                        <input type="text" class="form-control model" id="model" name="model">
                        <span>ሞዴል</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control update" id="update" name="update">
                        <span>ማሻሻያ አምድ</span>
                    </div>
                    <div class="modal-footer">
                        <button tabindex="0" type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <input type="hidden" name="add_model" value="1"></input>
                        <button tabindex="0" type="submit" class="btn btn-success">አስገባ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>






