  </div>

  <footer class="text-center p-3" style="margin-top: 8rem;">
    <p class="fs-5 text-light">© 2024 Entoto Polytechnic College. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>


const passwords = document.querySelectorAll('.psw');
const showHideBtns = document.querySelectorAll('.showHideBtn');

showHideBtns.forEach(showHideBtn => {
  showHideBtn.addEventListener('click', (event) => {
  const sibling =   event.target.previousElementSibling
    if (showHideBtn.classList.contains('fa-eye-slash')) {
      showHideBtn.classList.remove('fa-eye-slash');
      showHideBtn.classList.add('fa-eye');
      sibling.type = 'text'
    } else {
      showHideBtn.classList.add('fa-eye-slash');
      showHideBtn.classList.remove('fa-eye');
       sibling.type = 'password'
    }
  });

})
</script>

</body>
</html>