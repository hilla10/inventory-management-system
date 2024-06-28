// validation item form

import {
  itemValidation,
  binCardValidation,
  validationModel19,
  validationModel20,
} from './item_validation.js';

// Validation user and department user

import { userValidation, DepartmentValidation } from './user_validation.js';

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
  const insertAppForm = document.querySelector('.insert-app-form');
  const quantity = document.querySelector('#quantity');
  const price = document.querySelector('#price');

  const calculateTotalPrice = () => {
    const totalPrice = quantity.value * price.value;
    document.querySelector('#total_price').value = totalPrice.toFixed(2);
  };

  if (quantity) {
    quantity.addEventListener('input', calculateTotalPrice);
  }

  if (price) {
    price.addEventListener('input', calculateTotalPrice);
  }

  // calculate total price for model 19

  const insertModelAppForm = document.querySelector('.insert-model-app-form');

  if (insertModelAppForm) {
    const modelQuantity = insertModelAppForm.querySelector('#quantity');
    const modelPrice = insertModelAppForm.querySelector('#price');

    const calculateModelTotalPrice = () => {
      const totalPrice = modelQuantity.value * modelPrice.value;
      insertModelAppForm.querySelector('#total_price').value =
        totalPrice.toFixed(2);
    };

    modelPrice.addEventListener('input', calculateModelTotalPrice);
    modelQuantity.addEventListener('input', calculateModelTotalPrice);
  }

  // Get dropdown toggle button and dropdown menu
  const dropdownToggle = document.getElementById('dropdownMenuButton');

  if (dropdownToggle) {
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
  }
  // calculate remain for bin card

  const income = document.getElementById('income');
  const cost = document.getElementById('cost');

  const calculateRemain = () => {
    const remain = income.value - cost.value;
    document.getElementById('remain').value = remain;
  };

  if (income) {
    income.addEventListener('input', calculateRemain);
  }

  if (cost) {
    cost.addEventListener('input', calculateRemain);
  }

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

  // validation for bin card
  binCardValidation();

  // validation item form
  itemValidation();

  // validation for model 19
  // validationModel19();

  // validation for model 20
  validationModel20();

  // Validation department users
  DepartmentValidation();

  // Validation user
  userValidation();

  // validation modal for model 19

  // const validationModel19 = () => {
  //   const insertModel19AppForm = document.querySelector(
  //     '.insert-model-app-form'
  //   );
  //   const shakeContent = document.querySelector('.shake-19-content');
  //   const name = document.querySelector('.insert-model-app-form #added-by');
  //   const itemType = document.querySelector(
  //     ' .insert-model-app-form .item_type'
  //   );
  //   const model = document.querySelector('.insert-model-app-form #model');
  //   const serie = document.querySelector('.insert-model-app-form #serie');
  //   const inputQuantity = document.querySelector(
  //     '.insert-model-app-form .quantity'
  //   );
  //   const inputPrice = document.querySelector('.insert-model-app-form .price');

  //   // Function to validate individual input fields
  //   const validateInput = (inputElement) => {
  //     const inputValue = inputElement.value.trim();

  //     if (inputValue === '') {
  //       inputElement.classList.add('error');
  //       return false;
  //     } else {
  //       inputElement.classList.remove('error');
  //       return true;
  //     }
  //   };

  //   // Function to validate numeric fields
  //   const validateNumber = (inputElement) => {
  //     const inputValue = parseFloat(inputElement.value.trim());

  //     if (isNaN(inputValue) || inputValue <= 0) {
  //       inputElement.classList.add('error');
  //       return false;
  //     } else {
  //       inputElement.classList.remove('error');
  //       return true;
  //     }
  //   };

  //   const isValidName = (nameValue) => {
  //     const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
  //     return nameRegex.test(nameValue);
  //   };

  //   const validName = (name) => {
  //     if (isValidName(name.value)) {
  //       name.classList.remove('error-input');
  //       name.classList.add('success-input');
  //       ('Name is valid');
  //     } else {
  //       name.classList.remove('success-input');
  //       name.classList.add('error-input');
  //       ('Name is NOT valid');
  //     }
  //   };

  //   // Event listener for form submission
  //   if (insertModel19AppForm) {
  //     insertModel19AppForm.addEventListener('submit', (event) => {
  //       let isValid = true;

  //       // Validate item type input
  //       if (!validateInput(name)) {
  //         isValid = false;
  //       }

  //       // Validate item type input
  //       if (!validateInput(itemType)) {
  //         isValid = false;
  //       }

  //       // Validate model input
  //       if (!validateInput(model)) {
  //         isValid = false;
  //       }
  //       // Validate serie input
  //       if (!validateInput(serie)) {
  //         isValid = false;
  //       }

  //       // Validate quantity input
  //       if (!validateInput(inputQuantity) || !validateNumber(inputQuantity)) {
  //         isValid = false;
  //       }

  //       // Validate price input
  //       if (!validateInput(inputPrice) || !validateNumber(inputPrice)) {
  //         isValid = false;
  //       }

  //       // Prevent form submission if validation fails
  //       if (!isValid) {
  //         event.preventDefault();
  //         shakeContent.classList.add('shake');
  //         setTimeout(() => {
  //           shakeContent.classList.remove('shake');
  //         }, 500);
  //       }
  //     });
  //   }

  //   // Event listeners for input fields to validate dynamically
  //   if (name) {
  //     name.addEventListener('input', () => {
  //       validName(name);
  //       validateInput(name);
  //     });
  //   }

  //   if (itemType) {
  //     itemType.addEventListener('input', () => {
  //       validateInput(itemType);
  //     });
  //   }

  //   if (model) {
  //     model.addEventListener('input', () => {
  //       validateInput(model);
  //     });
  //   }

  //   if (serie) {
  //     serie.addEventListener('input', () => {
  //       validateInput(serie);
  //     });
  //   }

  //   if (inputQuantity) {
  //     inputQuantity.addEventListener('input', () => {
  //       validateInput(inputQuantity);
  //       validateNumber(inputQuantity);
  //     });
  //   }

  //   if (inputPrice) {
  //     inputPrice.addEventListener('input', () => {
  //       validateInput(inputPrice);
  //       validateNumber(inputPrice);
  //     });
  //   }
  // };

  validationModel19();
});
