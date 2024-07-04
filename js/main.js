// validation item form

import {
  itemValidation,
  binCardValidation,
  validationModel19,
  validationModel20,
} from './item_validation.js';

// Validation user and department user

import {
  userValidation,
  //DepartmentValidation
} from './user_validation.js';

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
  const price = document.querySelector('#price') || '';

  const calculateTotalPrice = () => {
    const totalPrice = quantity.value * price.value;
    const total = document.querySelector('#total_price');
    if (total) {
      total.value = totalPrice.toFixed(2);
    }
  };

  if (quantity) {
    quantity.addEventListener('input', calculateTotalPrice);
  }

  if (price) {
    price.addEventListener('input', calculateTotalPrice);
  }

  // calculate total price for model 19

  const insertModelAppForm = document.querySelector('.insert-model19-app-form');

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

  const DepartmentValidation = () => {
    // Select all user forms
    const formDepartment = document.querySelectorAll('.departmentForm');

    // Validation functions
    const isValidEmail = (emailValue) => {
      if (emailValue.trim() === '') {
        return true;
      } else {
        const emailRegex =
          /^(?!.*?[.]{2})[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const isValid = emailRegex.test(emailValue);

        return isValid;
      }
    };

    // Regular expression for validating phone number format
    const phoneRegex =
      /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

    // Function to check if a phone number is valid
    const isValidPhone = (phoneValue) => {
      // Allow empty/null phone numbers
      if (phoneValue.trim() === '+251' || phoneValue.trim() === '') {
        return true;
      } else {
        // Replace all non-digit characters with empty string
        const numericPhoneValue = phoneValue.replace(/[^\d]/g, '');
        const isValid =
          phoneRegex.test(phoneValue) &&
          (numericPhoneValue.length === 12 || numericPhoneValue.length === 13);

        return isValid;
      }
    };

    const isValidAge = (ageValue) => {
      const ageRegex = /^\d+$/;
      const isValid = ageRegex.test(ageValue);

      return isValid;
    };

    const isValidName = (nameValue) => {
      const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
      const isValid = nameRegex.test(nameValue);

      return isValid;
    };

    const validateField = (
      field,
      isValid,
      successClass = 'success-input',
      errorClass = 'error-input'
    ) => {
      if (isValid(field.value)) {
        field.classList.remove(errorClass);
        field.classList.add(successClass);
      } else {
        field.classList.remove(successClass);
        field.classList.add(errorClass);
      }
    };

    // Event listeners for each form and its fields
    formDepartment.forEach((form) => {
      const email = form.querySelector('.email');
      const phone = form.querySelector('.phone');
      const updatePhone = form.querySelector('.update_phone');
      const age = form.querySelector('.age');
      const name = form.querySelector('.name');

      email.addEventListener('input', () => validateField(email, isValidEmail));
      // Initialize phone input with the prefix +251 and validate/format input
      if (phone) {
        phone.value = '+251 ';
        phone.addEventListener('input', () => {
          let value = phone.value.trim(); // Remove leading/trailing whitespace
          // Check if the input starts with +251
          if (!value.startsWith('+251 ')) {
            // If not, reset to +251
            value = '+251 ';
          }

          phone.value = value.replace(/[^+\d\s()-]/g, '');
          validateField(phone, isValidPhone);
        });
        phone.addEventListener('keydown', (event) => {
          const value = phone.value.trim();
          const numericValue = value.replace(/[^\d]/g, '');
          if (
            [
              'ArrowLeft',
              'ArrowRight',
              'Backspace',
              'Delete',
              'Tab',
              'Enter',
              ' ',
              '-',
              '(',
              ')',
            ].includes(event.key)
          )
            return;
          if (
            phone.selectionStart < 4 ||
            numericValue.length >= 13 ||
            !/^\d$/.test(event.key)
          )
            event.preventDefault();
        });
      }

      if (updatePhone) {
        updatePhone.addEventListener('input', () => {
          let value = updatePhone.value.trim(); // Remove leading/trailing whitespace
          // Check if the input starts with +251
          if (!value.startsWith('+251 ')) {
            // If not, reset to +251
            value = '+251 ';
          }
          updatePhone.value = value.replace(/[^+\d\s()-]/g, '');
          validateField(updatePhone, isValidPhone);
        });

        updatePhone.addEventListener('keydown', (event) => {
          const value = updatePhone.value.trim();
          const numericValue = value.replace(/[^\d]/g, '');
          if (
            [
              'ArrowLeft',
              'ArrowRight',
              'Backspace',
              'Delete',
              'Tab',
              'Enter',
              ' ',
              '-',
              '(',
              ')',
            ].includes(event.key)
          )
            return;
          if (
            updatePhone.selectionStart < 4 ||
            numericValue.length >= 13 ||
            !/^\d$/.test(event.key)
          ) {
            event.preventDefault();
          }
        });
      }

           if (age) {
             age.addEventListener('input', () =>
               validateField(age, isValidAge)
             );
           }

      if (name) {
        name.addEventListener('input', () => validateField(name, isValidName));
      }

      form.addEventListener('submit', (event) => {
        let isFormValid = true;
        [email, phone, updatePhone, age, name].forEach((field) => {
          if (field) {
            if (
              (field.classList.contains('email') &&
                !isValidEmail(field.value)) ||
              (field.classList.contains('phone') &&
                !isValidPhone(field.value)) ||
              (field.classList.contains('update_phone') &&
                !isValidPhone(field.value)) ||
              (field.classList.contains('age') && !isValidAge(field.value)) ||
              (field.classList.contains('name') && !isValidName(field.value))
            ) {
              isFormValid = false;
              field.classList.add('error-input');
            } else {
              field.classList.remove('error-input');
            }
          }
        });

        const formDepartmentContent = document.querySelector(
          '.form-department-content'
        );
        if (!isFormValid) {
          event.preventDefault();
          formDepartmentContent.classList.add('shake');
          setTimeout(
            () => formDepartmentContent.classList.remove('shake'),
            500
          );
        }
      });
    });
  };

  // validation for bin card
  binCardValidation();

  // validation item form
  itemValidation();

  // validation for model 20
  validationModel20();

  // Validation department users
  DepartmentValidation();

  // Initialize validation for user
  userValidation();

  // validation modal for model 19

  validationModel19();
});
