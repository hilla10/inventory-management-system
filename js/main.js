document.addEventListener('DOMContentLoaded', function () {
  const passwords = document.querySelectorAll('.psw');
  const showHideBtns = document.querySelectorAll('.showHideBtn');

  showHideBtns.forEach((showHideBtn) => {
    showHideBtn.addEventListener('click', (event) => {
      const sibling = event.target.previousElementSibling;
      if (showHideBtn.classList.contains('fa-eye-slash')) {
        showHideBtn.classList.remove('fa-eye-slash');
        showHideBtn.classList.add('fa-eye');
        sibling.type = 'text';
      } else {
        showHideBtn.classList.add('fa-eye-slash');
        showHideBtn.classList.remove('fa-eye');
        sibling.type = 'password';
      }
    });
  });

  const sidebarToggle = document.querySelector('.sidebar-toggle');
  const mainSidebar = document.querySelector('.main-sidebar');
  const mainContent = document.querySelector('.main-content');
  const footer = document.querySelector('.footer');

  function toggleSidebar() {
    mainSidebar.classList.toggle('display-icon');
    mainContent.classList.toggle('add-margin');
  }

  function updateSidebarDisplay() {
    if (window.innerWidth <= 768) {
      mainSidebar.classList.add('display-icon');
      mainContent.classList.add('add-margin');
    } else {
      mainSidebar.classList.remove('display-icon');
      mainContent.classList.remove('add-margin');
    }
  }

  sidebarToggle.addEventListener('click', (e) => {
    e.preventDefault();
    if (window.innerWidth > 768) {
      toggleSidebar();
      mainSidebar.classList.remove('hidden');
      mainContent.classList.remove('full-width');
    } else {
      mainSidebar.classList.toggle('hidden');
      mainContent.classList.toggle('full-width');
    }
  });

  window.addEventListener('resize', updateSidebarDisplay);

  updateSidebarDisplay();

  const hamburger = document.querySelector('.hamburger');
  const navbar = document.querySelector('.navbar-toggle');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navbar.classList.toggle('mobile');
  });

  const accordionItems = document.querySelectorAll('.accordion-item');

  accordionItems.forEach((item) => {
    const header = item.querySelector('.accordion-header');
    const content = item.querySelector('.accordion-content');
    const icon = header.querySelector('.accordion-icon');

    header.addEventListener('click', () => {
      // Check if the current item is already active
      const isActive = item.classList.contains('active');
      // Close all other accordion items
      accordionItems.forEach((otherItem) => {
        otherItem.classList.remove('active');
        otherItem
          .querySelector('.accordion-content')
          .classList.remove('active');
        otherItem.querySelector('.accordion-icon').classList.remove('rotate');
      });

      // Toggle the current accordion item
      if (!isActive) {
        item.classList.add('active');
        content.classList.add('active');
        icon.classList.add('rotate');
      }
    });
  });


});
