// Validation user and

export const userValidation = () => {
  // Get the form element by its class name
  const formUser = document.querySelectorAll('.userForm');
  // Email validation
  const email = document.querySelector('.userForm .email');

  const isValidEmail = (emailValue) => {
    const emailRegex =
      /^(?!.*?[.]{2})[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(emailValue);
  };

  email.addEventListener('input', () => {
    if (isValidEmail(email.value)) {
      email.classList.remove('error-input');
      email.classList.add('success-input');
    } else {
      email.classList.remove('success-input');
      email.classList.add('error-input');
    }
  });

  /* starting Phone validation */

  // Select the phone input element
  const phone = document.querySelector('.userForm .phone');

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
  const age = document.querySelector('.userForm .age');
  const isValidAge = (ageValue) => {
    const ageRegex = /^\d+$/;
    return ageRegex.test(ageValue);
  };

  age.addEventListener('input', () => {
    if (isValidAge(age.value)) {
      age.classList.remove('error-input');
      age.classList.add('success-input');
    } else {
      age.classList.remove('success-input');
      age.classList.add('error-input');
    }
  });

  // Name validation
  const name = document.querySelector('.userForm .name');
  const isValidName = (nameValue) => {
    const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
    return nameRegex.test(nameValue);
  };

  name.addEventListener('input', () => {
    if (isValidName(name.value)) {
      name.classList.remove('error-input');
      name.classList.add('success-input');
    } else {
      name.classList.remove('success-input');
      name.classList.add('error-input');
    }
  });

  // Password validation
  const password = document.querySelector('.userForm .validPassword');
  const confirmPassword = document.querySelector('.userForm .confirm');

  const isValidPassword = (passwordValue) => {
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]).{8,}$/;
    return passwordRegex.test(passwordValue);
  };

  const validatePassword = () => {
    const passwordValue = password.value;
    const isValid = isValidPassword(passwordValue);

    if (isValid) {
      password.classList.remove('error-input');
      password.classList.add('success-input');
    } else {
      password.classList.remove('success-input');
      password.classList.add('error-input');
    }

    // Validate criteria separately
    const criteriaChecks = {
      'char-length': /.{8,}/.test(passwordValue),
      'char-lowercase-letter': /[a-z]/.test(passwordValue),
      'char-uppercase-letter': /[A-Z]/.test(passwordValue),
      digit: /\d/.test(passwordValue),
      'special-char': /[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]/.test(passwordValue),
    };

    for (const [className, isValid] of Object.entries(criteriaChecks)) {
      const element = formUser.querySelector(`.${className}`);
      if (isValid) {
        element.classList.remove('error');
        element.classList.add('success');
      } else {
        element.classList.remove('success');
        element.classList.add('error');
      }
    }
  };

  password.addEventListener('input', validatePassword);

  confirmPassword.addEventListener('input', () => {
    if (isValidPassword(confirmPassword.value)) {
      confirmPassword.classList.remove('error-input');
      confirmPassword.classList.add('success-input');
    } else {
      confirmPassword.classList.remove('success-input');
      confirmPassword.classList.add('error-input');
    }
  });

  // Form submission handling
  formUser.forEach((formUser) => {
    console.log(formUser);
    formUser.addEventListener('submit', (event) => {
      let isFormValid = true;

      // Validate all fields
      if (!isValidEmail(email.value)) {
        isFormValid = false;
        email.classList.add('error-input');
      }

      if (!isValidPhone(phone.value)) {
        isFormValid = false;
        phone.classList.add('error-input');
      }

      if (!isValidName(name.value)) {
        isFormValid = false;
        name.classList.add('error-input');
      }

      if (!isValidAge(age.value)) {
        isFormValid = false;
        age.classList.add('error-input');
      }

      if (!isValidPassword(password.value)) {
        isFormValid = false;
        password.classList.add('error-input');
      }

      if (!isValidPassword(confirmPassword.value)) {
        isFormValid = false;
        confirmPassword.classList.add('error-input');
      }

      const formUserContents = document.querySelectorAll('.form-user-content');
      formUserContents.forEach((formUserContent) => {
        // If form is valid, submit it
        if (isFormValid) {
          formUser.submit();
        } else {
          event.preventDefault();
          // Add shake animation to the form
          formUserContent.classList.add('shake');

          // Remove shake animation after 0.5s (duration of shake animation)
          setTimeout(() => {
            formUserContent.classList.remove('shake');
          }, 500);
        }
      });
    });
  });
};

// Validation user and Department Register

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
