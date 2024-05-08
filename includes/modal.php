
<!-- modal for item -->

<form action="insert_app.php" method="post">
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
           <h2 class="fs-3 text-center py-3">የግዥ መጠየቂያ ፎርም</h2>

            <div class="form-group mb-2">
                <input type="text" class="form-control" id="inventory-list" name="inventory-list" placeholder="የእቃው ዝርዝር">
            </div>
            <div class="form-group mb-2">
                <input type="text" class="form-control" id="description" name="description" placeholder=" መግለጫ">
            </div>
            <div class="form-group mb-2">
                <input type="number" class="form-control" id="measure" name="measure" placeholder="መለኪያ">
            </div>
            <div class="form-group mb-2">
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="ብዛት">
            </div>
            <div class="form-group mb-2">
                <input type="number" class="form-control" id="price" name="price" placeholder="የአንዱ ዋጋ">
            </div>
            <div class="form-group mb-2">
                <input type="number" class="form-control" id="total-price" name="total-price" placeholder="ጠቅላላ ዋጋ">
            </div>
            <div class="form-group mb-2">
                <input type="text" class="form-control" id="examination" name="examination" placeholder="ምርመራ">
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


  
 <!-- modal for bin card -->
 <form action="insert_app.php" method="post">
 <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bin Card</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h2 class="fs-3 text-center py-3">ቢን ካርድ</h2>

             <div class="form-group my-2">
          
                <input type="date" class="form-control" id="date" name="date" placeholder="ቀን">
              </div>
              <div class="form-group my-2">
              
                <input type="number" class="form-control" id="Phone" name="income" placeholder=" ገቢ">
           
              </div>
              <div class="form-group my-2">
                
                <input type="number" class="form-control" id="age" name="cost" placeholder="ወጪ">
              </div>
          
              <div class="form-group my-2">
              
                <input type="number" class="form-control" id="Phone" name="remain" placeholder="ከወጪ ቀሪ">
           
              </div>
              <div class="form-group my-2">
              
                <input type="number" class="form-control" id="Phone" name="short" placeholder="አጭር ፈር">
           
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="add_bin" value="አስገባ"></input>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                        <div class="form-group">

                            <input type="text" class="form-control" name="username"
                                placeholder="ስሞትን ያስገቡ| Enter your name|">
                        </div>
                        <div class="form-group mb-2">
                            <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                            <select name="gender" class="form-select">
                                <option value="male">ወንድ</option>
                                <option value="female">ሴት</option>
                            </select>
                        </div>


                        <div class="form-group mb-2">

                            <input type="number" class="form-control" name="age"
                                placeholder="አድሜ ያስገቡ |Enter your age|">
                        </div>

                        <div class="form-group mb-2">

                            <input type="email" class="form-control" name="email"
                                placeholder="ኢሜል ያስገቡ|Enter your email|">
                               
                        </div>

                        <div class="form-group mb-2">

                            <input type="number" class="form-control" name="Phone"
                                placeholder=" ስልክ ቁጥር ያስገቡ |Enter your phone.no|">
                        </div>

                        <div class="form-group mb-2">
                            <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:|Enter your position|</label>
                            <select name="position" class="form-select">
                                <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                                <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                                <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                                <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">

                            <input type="password" class="form-control" name="passwords"
                                placeholder=" የይለፍ ቃል |Enter your password|">
  
                        </div>

                        <div class="form-group mb-2">

                            <input type="password" class="form-control" name="confirm"
                                placeholder=" የይለፍ ቃል አረጋግጥ| Confirm your password|">
 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h2 class="fs-3 text-center py-3">የዲፓርትመንት ምዝገባ ቅጽ</h2>

                        <div class="form-group mb-2">

                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="ስሞትን ያስገቡ">
                        </div>
                        <div class="form-group mb-2">

                            <input type="email" class="form-control" id="email" name="email" placeholder="ኢሜል ያስገቡ">
                        </div>
                        <div class="form-group mb-2">

                            <input type="number" class="form-control" id="age" name="age" placeholder="አድሜ ያስገቡ">
                        </div>
                        <div class="form-group mb-2">

                            <input type="number" class="form-control" id="Phone" name="phone"
                                placeholder=" ስልክ ቁጥር ያስገቡ">
                        </div>
                        <div class="form-group mb-2">

                            <div class="form-group mb-2">
                                <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:</label>
                                <select name="position" class="form-select">
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
                        <input type="submit" class="btn btn-success" name="add_department" value="አስገባ"></input>
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
           <div class="form-group">
            <label for="username" class="py-2">Enter username to delete</label>
            <input type="text" class="form-control" name="username" placeholder="ስሞትን ያስገቡ| Enter your name|">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="delete_user" value="አስገባ"></input>
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <div class="form-group mb-2">
             
                <input type="text" class="form-control" id="item-type" name="item-type" placeholder="የእቃው አይነት">
              </div>
              <div class="form-group mb-2">
                
                <input type="text" class="form-control" id="model" name="model" placeholder="ሞዴል">
              </div>
              <div class="form-group mb-2">
             
                <input type="number" class="form-control" id="serie" name="serie" placeholder=" ሴሪ">
              </div>
              <div class="form-group mb-2">
              
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder=" ብዛት">
           
              </div>
             <div class="form-group mb-2">
                <input type="number" class="form-control" id="price" name="price" placeholder="የአንዱ ዋጋ">
            </div>
            <div class="form-group mb-2">
                <input type="number" class="form-control" id="total-price" name="total-price" placeholder="ጠቅላላ ዋጋ">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="form-group mb-2">
              
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder=" ብዛት">
           
              </div>

              <div class="form-group mb-2">
             
                <input type="text" class="form-control" id="item-type" name="item-type" placeholder="የእቃው አይነት">
              </div>
              <div class="form-group mb-2">
                
                <input type="text" class="form-control" id="model" name="model" placeholder="ሞዴል">
              </div>
          
              <div class="form-group mb-2">
                
                <input type="text" class="form-control" id="update"  name="update" placeholder="ማሻሻያ አምድ">
              </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="add_model" value="አስገባ"></input>
      </div>
    </div>
  </div>
</div>
</form>