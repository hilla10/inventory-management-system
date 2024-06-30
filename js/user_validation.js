// validate user form

export 

  const userValidation = () => {
    // Select all user forms
    const forms = document.querySelectorAll('.userForm');

    // Validation functions
    const isValidEmail = (emailValue) => {
      if (emailValue.trim() === '') {
        return true;
      } else {
        const emailRegex =
          /^(?!.*?[.]{2})[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(emailValue);
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
        return (
          phoneRegex.test(phoneValue) &&
          (numericPhoneValue.length === 12 || numericPhoneValue.length === 13)
        );
      }
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
      if (field && isValid(field.value)) {
        field.classList.remove(errorClass);
        field.classList.add(successClass);
      } else if (field) {
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
        'special-char': /[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]/.test(
          password.value
        ),
      };

      for (const [className, isValid] of Object.entries(criteriaChecks)) {
        const element = form.querySelector(`.${className}`);
        if (element) {
          if (isValid) {
            element.classList.remove('error');
            element.classList.add('success');
          } else {
            element.classList.remove('success');
            element.classList.add('error');
          }
        }
      }
    };

    // Event listeners for each form and its fields
    forms.forEach((form) => {
      const email = form.querySelector('.email');
      const phone = form.querySelector('.phone');
      const updatePhone = form.querySelector('.update_phone');
      const age = form.querySelector('.age');
      const name = form.querySelector('.name');
      const password = form.querySelector('.validPassword');
      const confirmPassword = form.querySelector('.confirm');

      if (email) {
        email.addEventListener('input', () =>
          validateField(email, isValidEmail)
        );
      }

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
          ) {
            event.preventDefault();
          }
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
        age.addEventListener('input', () => validateField(age, isValidAge));
      }

      if (name) {
        name.addEventListener('input', () => validateField(name, isValidName));
      }

      if (password) {
        password.addEventListener('input', () => {
          validateField(password, isValidPassword);
          validatePasswordCriteria(password, form);
        });
      }

      if (confirmPassword) {
        confirmPassword.addEventListener('input', () =>
          validateField(
            confirmPassword,
            (value) => value === password.value && isValidPassword(value)
          )
        );
      }

      form.addEventListener('submit', (event) => {
        let isFormValid = true;
        [
          email,
          phone,
          updatePhone,
          age,
          name,
          password,
          confirmPassword,
        ].forEach((field) => {
          if (field) {
            if (
              (field.classList.contains('email') &&
                !isValidEmail(field.value)) ||
              (field.classList.contains('phone') &&
                !isValidPhone(field.value)) ||
              (field.classList.contains('update_phone') &&
                !isValidPhone(field.value)) ||
              (field.classList.contains('age') && !isValidAge(field.value)) ||
              (field.classList.contains('name') && !isValidName(field.value)) ||
              (field.classList.contains('validPassword') &&
                !isValidPassword(field.value)) ||
              (field.classList.contains('confirm') &&
                !isValidPassword(field.value))
            ) {
              isFormValid = false;
              field.classList.add('error-input');
            } else {
              field.classList.remove('error-input');
            }
          }
        });

        if (!isFormValid) {
          event.preventDefault();
          const formContents = document.querySelectorAll('.form-user-content');
          formContents.forEach((formContent) => {
            formContent.classList.add('shake');
            setTimeout(() => formContent.classList.remove('shake'), 500);
          });
        }
      });
    });
  };


export const DepartmentValidation = () => {
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
    const age = form.querySelector('.age');
    const name = form.querySelector('.name');

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

    form.addEventListener('submit', (event) => {

      let isFormValid = true;
      [email, phone, age, name].forEach((field) => {
        
        if (
          (field.classList.contains('email') && !isValidEmail(field.value)) ||
          (field.classList.contains('phone') && !isValidPhone(field.value)) ||
          (field.classList.contains('age') && !isValidAge(field.value)) ||
          (field.classList.contains('name') && !isValidName(field.value))
        ) {
          isFormValid = false;
          field.classList.add('error-input');
        } else {
          field.classList.remove('error-input');
        }
      });

      const formDepartmentContent = document.querySelector(
        '.form-department-content'
      );
      if (!isFormValid) {
        event.preventDefault();
        formDepartmentContent.classList.add('shake');
        setTimeout(() => formDepartmentContent.classList.remove('shake'), 500);
      }
    });
  });
};


