
<!-- modal for department user -->

<div class="modal fade" id="ModalDepartment" tabindex="-1" aria-labelledby="ModalDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-department-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalDepartmentLabel">Add Department</h1>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../includes/department_register.php" method="POST" class="departmentForm">
                    <h2 class="fs-3 text-center py-3">የዲፓርትመንት ምዝገባ ቅጽ</h2>

                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control name" id="username" name="username">
                        <span>ስሞትን ያስገቡ</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input type="email" class="form-control email" name="email">
                        <span>ኢሜል ያስገቡ</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control age" id="age" name="age">
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
                        <input type="text" class="form-control phone" id="phone" name="phone">
                        <span>ስልክ ቁጥር ያስገቡ</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <label for="position" class="py-2">ያሉበትን ሁኔታ ይምረጡ:</label>
                        <select name="position" class="select-option">
                            <option value="it head">የአይቲ ዲፓርትመንት ሄድ</option>
                            <option value="business head">የቢዝነስ ዲፓርትመንት ሄድ</option>
                            <option value="art head">የአርት ዲፓርትመንት ሄድ</option>
                            <option value="auto head">የአውቶ ዲፓርትመንት ሄድ</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <input type="submit" class="btn btn-success" name="add_department" value="አስገባ"> -->
                        <input type="hidden" name="add_department" value="1">
                    <!-- other form fields -->
                    <button type="submit" class="btn btn-success">አስገባ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- modal for user register -->
    <div class="modal fade" id="ModalUser" tabindex="-1" aria-labelledby="ModalUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content form-user-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalUserLabel">Add User</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/user_register.php" method="post" class="userForm">
                    <h2 class="fs-3 text-center py-3">ዋናው መመዝገቢያ ቅጽ</h2>

                    <div class="form-group input-box">
                        <input type="text" class="form-control name" name="username">
                        <span>ስሞትን ያስገቡ | Enter your name|</span>
                    </div>
                    <div class="form-group input-box mb-2">
                        <label for="gender" class="py-2">ጾታ አስገባ |Enter your gender|:</label>
                        <select name="gender" class="select-option">
                            <option value="male">ወንድ</option>
                            <option value="female">ሴት</option>
                        </select>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control age" name="age">
                        <span>አድሜ ያስገቡ |Enter your age|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input type="email" class="form-control email" name="email">
                        <span>ኢሜል ያስገቡ|Enter your email|</span>
                    </div>

                    <div class="form-group input-box mb-2">
                        <input type="text" class="form-control phone" name="phone">
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
                        <input type="password" class="form-control validPassword" name="password">
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
                        <input type="password" class="form-control confirm" name="confirm">
                        <i class="fa-solid fa-eye-slash showHideBtn"></i>
                        <span>የይለፍ ቃል አረጋግጥ| Confirm your password|</span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="add_user" value="አስገባ"></input>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



  <!-- modal for user register for login page -->

    <div class="modal fade" id="ModalUserLogin" tabindex="-1" aria-labelledby="ModalUserLoginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content form-user-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalUserLoginLabel">Add User</h1>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- signInForm -->
                <div class="modal-body">
                    <form action="./includes/user_register.php" method="post"  class=" userForm">
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
                        <input  type="text" class="form-control age" name="age">
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
                    </form>
                </div>
            </div>
        </div>
    </div>


