// Validation user and

export const userValidation = () => {
  // Select all user forms
  const forms = document.querySelectorAll('.userForm');

  // Validation functions
  const isValidEmail = (emailValue) => {
    const emailRegex =
      /^(?!.*?[.]{2})[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(emailValue);
  };
  

  // Regular expression for validating phone number format
  const phoneRegex =
    /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

  // Function to check if a phone number is valid
  const isValidPhone = (phoneValue) => {
    // Allow empty/null phone numbers
    if (!phoneValue) return true;


    // Replace all non-digit characters with empty string
    const numericPhoneValue = phoneValue.replace(/[^\d]/g, '');

    // Check if the phone value matches the regex and is of correct length
    return (
      phoneRegex.test(phoneValue) &&
      (numericPhoneValue.length === 12 || numericPhoneValue.length === 13)
    );
  };



  const isValidAge = (ageValue) => {
    const ageRegex = /^\d+$/;
    return ageRegex.test(ageValue);
  };

  const isValidName = (nameValue) => {
    const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
    return nameRegex.test(nameValue);
  };

  const isValidPassword = (passwordValue) => {
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]).{8,}$/;
    return passwordRegex.test(passwordValue);
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

  const validatePasswordCriteria = (password, form) => {
    const criteriaChecks = {
      'char-length': /.{8,}/.test(password.value),
      'char-lowercase-letter': /[a-z]/.test(password.value),
      'char-uppercase-letter': /[A-Z]/.test(password.value),
      digit: /\d/.test(password.value),
      'special-char': /[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]/.test(password.value),
    };

    for (const [className, isValid] of Object.entries(criteriaChecks)) {
      const element = form.querySelector(`.${className}`);
      if (isValid) {
        element.classList.remove('error');
        element.classList.add('success');
      } else {
        element.classList.remove('success');
        element.classList.add('error');
      }
    }
  };

  // Event listeners for each form and its fields
  forms.forEach((form) => {
    const email = form.querySelector('.email');
    const phone = form.querySelector('.phone');
    const age = form.querySelector('.age');
    const name = form.querySelector('.name');
    const password = form.querySelector('.validPassword');
    const confirmPassword = form.querySelector('.confirm');

    email.addEventListener('input', () => validateField(email, isValidEmail));
    // Initialize phone input with the prefix +251 and validate/format input
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

    age.addEventListener('input', () => validateField(age, isValidAge));
    name.addEventListener('input', () => validateField(name, isValidName));
    password.addEventListener('input', () => {
      validateField(password, isValidPassword);
      validatePasswordCriteria(password, form);
    });
    confirmPassword.addEventListener('input', () =>
      validateField(
        confirmPassword,
        (value) => value === password.value && isValidPassword(value)
      )
    );

    form.addEventListener('submit', (event) => {
      let isFormValid = true;
      [email, phone, age, name, password, confirmPassword].forEach((field) => {
        if (!field.classList.contains('success-input')) {
          isFormValid = false;
          field.classList.add('error-input');
        }
      });
      const formContents = document.querySelectorAll('.form-user-content');
      if (!isFormValid) {
        event.preventDefault();
        formContents.forEach((formContent) => {
          formContent.classList.add('shake');
          setTimeout(() => formContent.classList.remove('shake'), 1000);
        });
      }
    });
  });
};

export const DepartmentValidation = () => {
  // Get the form element by its class
  const formDepartment = document.querySelector('.departmentForm');
  const formDepartmentContent = document.querySelector(
    '.form-department-content'
  );

  if (formDepartment) {
    // Email validation within the department form
    const email = formDepartment.querySelector('.email');
    const isValidEmail = (emailValue) => {
      const emailRegex =
        /^(?!.*?[.]{2})[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return emailRegex.test(emailValue);
    };
    email.addEventListener('input', () => {
      const value = email.value.trim();
      if (isValidEmail(value)) {
        email.classList.remove('error-input');
        email.classList.add('success-input');
      } else {
        email.classList.remove('success-input');
        email.classList.add('error-input');
      }
    });

    /* starting Phone validation */

    // Select the phone input element within the department form
    const phone = formDepartment.querySelector('.phone');

    // Regular expression for validating phone number format
    const phoneRegex =
      /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

    // Function to check if a phone number is valid
    const isValidPhone = (phoneValue) => {
      // Allow empty/null phone numbers
      if (!phoneValue) return true;

      // Replace all non-digit characters with empty string
      const numericPhoneValue = phoneValue.replace(/[^\d]/g, '');

      // Check if the phone value matches the regex and is of correct length
      return (
        phoneRegex.test(phoneValue) &&
        (numericPhoneValue.length === 12 || numericPhoneValue.length === 13)
      );
    };

    // Initialize phone input with the prefix +251 and validate/format input
    phone.value = '+251 ';
    phone.addEventListener('input', () => {
      let value = phone.value.trim(); // Remove leading/trailing whitespace

      // Check if the input starts with +251
      if (!value.startsWith('+251 ')) {
        // If not, reset to +251
        value = '+251 ';
      }

      // Remove all non-digit characters except for allowed ones
      const cleanedValue = value.replace(/[^+\d\s()-]/g, '');
      phone.value = cleanedValue;

      // Perform validation and apply appropriate styling
      if (isValidPhone(cleanedValue)) {
        phone.classList.remove('error-input');
        phone.classList.add('success-input');
      } else {
        phone.classList.remove('success-input');
        phone.classList.add('error-input');
      }
    });

    // Event listener to prevent modification of the prefix and restrict input
    phone.addEventListener('keydown', (event) => {
      const value = phone.value.trim(); // Remove leading/trailing whitespace
      const numericValue = value.replace(/[^\d]/g, '');

      // Allow arrow keys, backspace, delete, and specific special characters
      if (
        event.key === 'ArrowLeft' ||
        event.key === 'ArrowRight' ||
        event.key === 'Backspace' ||
        event.key === 'Delete' ||
        event.key === ' ' ||
        event.key === '-' ||
        event.key === '(' ||
        event.key === ')'
      ) {
        return;
      }
      // Allow tab key to navigate to the next input field
      if (event.key === 'Tab') {
        return;
      }
      // Allow Enter key to submit the form
      if (event.key === 'Enter') {
        return;
      }

      // Prevent modifying the prefix +251 and ensure only numbers are entered
      if (
        phone.selectionStart < 4 ||
        numericValue.length >= 13 ||
        !/^\d$/.test(event.key)
      ) {
        event.preventDefault();
      }
    });

    /* end of phone validation */

    // Age validation
    const age = formDepartment.querySelector('.age');
    const isValidAge = (ageValue) => {
      const ageRegex = /^\d+$/;
      return ageRegex.test(ageValue);
    };
    age.addEventListener('input', () => {
      const value = age.value.trim();
      if (isValidAge(value)) {
        age.classList.remove('error-input');
        age.classList.add('success-input');
      } else {
        age.classList.remove('success-input');
        age.classList.add('error-input');
      }
    });

    // Name validation
    const name = formDepartment.querySelector('.name');
    const isValidName = (nameValue) => {
      const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
      return nameRegex.test(nameValue);
    };
    name.addEventListener('input', () => {
      const value = name.value.trim();
      if (isValidName(value)) {
        name.classList.remove('error-input');
        name.classList.add('success-input');
      } else {
        name.classList.remove('success-input');
        name.classList.add('error-input');
      }
    });

    // Form submission handling
    formDepartment.addEventListener('submit', (event) => {
      let isDepartmentFormValid = true;

      if (!isValidEmail(email.value)) {
        isDepartmentFormValid = false;
        email.classList.add('error-input');
      }

      if (!isValidPhone(phone.value)) {
        isDepartmentFormValid = false;
        phone.classList.add('error-input');
      }

      if (!isValidName(name.value)) {
        isDepartmentFormValid = false;
        name.classList.add('error-input');
      }

      if (!isValidAge(age.value)) {
        isDepartmentFormValid = false;
        age.classList.add('error-input');
      }

      // Prevent default form submission behavior
      event.preventDefault();

      // If form is valid, submit it
      if (isDepartmentFormValid) {
        formDepartment.submit();
      } else {
        event.preventDefault();
        // Add shake animation to the form
        formDepartmentContent.classList.add('shake');

        // Remove shake animation after 0.5s (duration of shake animation)
        setTimeout(() => {
          formDepartmentContent.classList.remove('shake');
        }, 500);
      }
    });
  }
};
