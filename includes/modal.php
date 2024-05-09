
<!-- modal for item -->

<form action="insert_app.php" method="post">
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
                <input required type="number" class="form-control" id="total-price" name="total-price" >
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
                <span>ቀን</span>
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

   <form action="user_register.php" method="post">
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

                            <input required type="password" class="form-control" name="passwords">
                            <span>የይለፍ ቃል |Enter your password|</span>
  
                        </div>

                        <div class="form-group input-box mb-2">

                            <input required type="password" class="form-control" name="confirm">
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

   <form action="department_register.php" method="post">
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

    

 <!-- modal for deleting user -->
 <form action="delete_user.php" method="post">
 <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bin Card</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <div class="form-group input-box my-2">
            <!-- <label for="username" class="pb-5">Enter username to delete</label> -->
            <input required type="text" class="form-control" name="username">
            <span>ስሞትን ያስገቡ| Enter your name to delete|</span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input required type="submit" class="btn btn-success" name="delete_user" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>

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
              
                <input required type="number" class="form-control" id="quantity" name="quantity">
                <span>ብዛት</span>
              </div>
             <div class="form-group input-box mb-2">
                <input required type="number" class="form-control" id="price" name="price">
                <span>የአንዱ ዋጋ</span>
            </div>
            <div class="form-group input-box mb-2">
                <input required type="number" class="form-control" id="total-price" name="total-price">
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
                
                <input required type="text" class="form-control" id="update"  name="update">
                <span>ማሻሻያ አምድ</span>
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