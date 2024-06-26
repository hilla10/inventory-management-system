// Validation user and department user

import { userValidation } from './user_validation.js';

// validation item form
import {
  itemValidation,
  binCardValidation,
  validationModel19,
  validationModel20,
} from './item_validation.js';

// validation for bin card

document.addEventListener('DOMContentLoaded', function () {
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

  function toggleSidebar() {
    if (mainSidebar) {
      mainSidebar.classList.toggle('display-icon');
    }
    if (mainContent) {
      mainContent.classList.toggle('add-margin');
    }
  }

  function updateSidebarDisplay() {
    if (window.innerWidth <= 768) {
      if (mainSidebar) {
        mainSidebar.classList.add('display-icon');
      }
      if (mainContent) {
        mainContent.classList.add('add-margin');
      }
    } else {
      if (mainSidebar) {
        mainSidebar.classList.remove('display-icon');
      }
      if (mainContent) {
        mainContent.classList.remove('add-margin');
      }
    }
  }

  if (sidebarToggle) {
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
  }

  window.addEventListener('resize', updateSidebarDisplay);

  updateSidebarDisplay();

  const hamburger = document.querySelector('.hamburger');
  const navbar = document.querySelector('.navbar-toggle');
  if (hamburger) {
    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      navbar.classList.toggle('mobile');
    });
  }

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

  // Calculate total price for items
  const quantity = document.getElementById('quantity');
  const price = document.getElementById('price');
  const calculateTotalPrice = () => {
    const totalPrice = quantity.value * price.value;
    document.getElementById('total_price').value = totalPrice.toFixed(2);
  };

  quantity.addEventListener('input', calculateTotalPrice);
  price.addEventListener('input', calculateTotalPrice);

  // calculate total price for model 19

  const insertModelAppForm = document.querySelector('.insert-model-app-form');
  const modelQuantity = insertModelAppForm.querySelector('#quantity');
  const modelPrice = insertModelAppForm.querySelector('#price');

  const calculateModelTotalPrice = () => {
    const totalPrice = modelQuantity.value * modelPrice.value;
    insertModelAppForm.querySelector('#total_price').value =
      totalPrice.toFixed(2);
  };

  modelPrice.addEventListener('input', calculateModelTotalPrice);
  modelQuantity.addEventListener('input', calculateModelTotalPrice);

  // Get dropdown toggle button and dropdown menu
  const dropdownToggle = document.getElementById('dropdownMenuButton');

  const dropdownMenu = dropdownToggle.nextElementSibling;

  // Toggle dropdown menu on button click
  dropdownToggle.addEventListener('click', function () {
    dropdownMenu.classList.toggle('show');
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function (event) {
    if (
      !dropdownToggle.contains(event.target) &&
      !dropdownMenu.contains(event.target)
    ) {
      dropdownMenu.classList.remove('show');
    }
  });

  // calculate remain for bin card

  const income = document.getElementById('income');
  const cost = document.getElementById('cost');

  const calculateRemain = () => {
    const remain = income.value - cost.value;
    document.getElementById('remain').value = remain;
  };

  income.addEventListener('input', calculateRemain);
  cost.addEventListener('input', calculateRemain);

  // for input styling

  document.querySelectorAll('.input-box input').forEach((input) => {
    input.addEventListener('input', () => {
      if (input.value.trim() !== '') {
        input.classList.add('has-content');
      } else {
        input.classList.remove('has-content');
      }
    });
  });

  // Validation user and department user

  userValidation();

  // validation item form
  itemValidation();

  // validation for bin card
  binCardValidation();

  // validation for model 19
  validationModel19();

  // validation for model 19
  validationModel20();
});
