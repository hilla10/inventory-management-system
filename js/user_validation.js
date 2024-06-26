// Validation user and department users

export const userValidation = () => {
  // Get the form element by its ID
  const formUser = document.querySelectorAll('.userForm');

  formUser.forEach((formUser) => {
    // Email validation
    const emails = formUser.querySelectorAll('.email');

    const isValidEmail = (emailValue) => {
      const emailRegex =
        /^(?!.*?[.]{2})[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return emailRegex.test(emailValue);
    };

    emails.forEach((email) => {
      email.addEventListener('input', () => {
        'Email input value:', email.value;
        if (isValidEmail(email.value)) {
          email.classList.remove('error-input');
          email.classList.add('success-input');
          ('Email is valid');
        } else {
          email.classList.remove('success-input');
          email.classList.add('error-input');
          ('Email is NOT valid');
        }
      });
    });

    // Phone validation
    // const phones = document.querySelectorAll('.phone');

    // const isValidPhone = (phoneValue) => {
    //   // Allow empty/null phone numbers
    //   if (!phoneValue) return true;

    //   const phoneRegex =
    //     /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

    //   console.log('phone Regex ' + phoneRegex.test(phoneValue));
    //   return phoneRegex.test(phoneValue);
    //   };

    // phones.forEach((phone) => {
    //   phone.addEventListener('input', () => {
    //     const value = phone.value.trim(); // Remove leading/trailing whitespace

    //     if (isValidPhone(value)) {
    //       phone.classList.remove('error-input');
    //       phone.classList.add('success-input');
    //       console.log('Phone is valid');
    //     } else {
    //       phone.classList.remove('success-input');
    //       phone.classList.add('error-input');
    //       console.log('Phone is NOT valid');
    //     }
    //   });

    //   // Set initial value and handle user input for prefix +251
    //   phone.value = '+251 ';
    //   phone.addEventListener('input', () => {
    //     const value = phone.value.trim(); // Remove leading/trailing whitespace

    //     // Check if the input starts with +251
    //     if (value && !value.startsWith('+251 ')) {
    //       // If not, reset to +251
    //       phone.value = '+251 ';
    //     }
    //   });

    //   // Prevent user from removing the prefix +251
    //   phone.addEventListener('keydown', (event) => {
    //     const value = phone.value.trim(); // Remove leading/trailing whitespace
    //     console.log('value ' + value);

    //     // Allow arrow keys and backspace
    //     if (
    //       event.key === 'ArrowLeft' ||
    //       event.key === 'ArrowRight' ||
    //       event.key === 'Backspace'
    //     ) {
    //       return;
    //     }

    //     // Prevent modifying the prefix +251
    //     if (phone.selectionStart < 5) {
    //       console.log('select error');
    //       event.preventDefault();
    //     } else {
    //       console.log('select success');
    //     }
    //   });
    // });

    // Phone validation
    // const phones = formUser.querySelectorAll('.phone');

    // const isValidPhone = (phoneValue) => {
    //   // Allow empty/null phone numbers
    //   if (!phoneValue) return true;

    //   const PhoneRegex =
    //     /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
    //   return PhoneRegex.test(phoneValue);
    // };

    // phones.forEach((phone) => {
    //   phone.addEventListener('input', () => {
    //     'Phone input value:', phone.value;
    //     if (isValidPhone(phone.value)) {
    //       phone.classList.remove('error-input');
    //       phone.classList.add('success-input');
    //       ('Phone is valid');
    //     } else {
    //       phone.classList.remove('success-input');
    //       phone.classList.add('error-input');
    //       ('Phone is NOT valid');
    //     }
    //   });
    // });

    // const phoneNumberInput = document.querySelectorAll('.phone');

    // // Initial value
    // phoneNumberInput.value = '+251 ';

    // // Handle user input
    // phoneNumberInput.forEach((phone) => {
    //   phone.value = '+251 ';
    //   phone.addEventListener('input', () => {
    //     // Check if the input starts with +251
    //     if (!phone.value.startsWith('+251 ')) {
    //       // If not, reset to +251
    //       phone.value = '+251 ';
    //     }
    //   });
    // });

    // // Prevent user from removing the prefix
    // phoneNumberInput.forEach((phone) => {
    //   phone.addEventListener('keydown', function (event) {
    //     // Allow arrow keys and backspace
    //     if (
    //       event.key === 'ArrowLeft' ||
    //       event.key === 'ArrowRight' ||
    //       event.key === 'Backspace'
    //     ) {
    //       return;
    //     }

    //     // Prevent modifying the prefix
    //     if (phoneNumberInput.selectionStart < 6) {
    //       event.preventDefault();
    //     }
    //   });
    // });

    // // Name validation
    // const names = formUser.querySelectorAll('.name');

    // const isValidName = (nameValue) => {
    //   const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
    //   return nameRegex.test(nameValue);
    // };

    // names.forEach((name) => {
    //   name.addEventListener('input', () => {
    //     'Name input value:', name.value;
    //     if (isValidName(name.value)) {
    //       name.classList.remove('error-input');
    //       name.classList.add('success-input');
    //       ('Name is valid');
    //     } else {
    //       name.classList.remove('success-input');
    //       name.classList.add('error-input');
    //       ('Name is NOT valid');
    //     }
    //   });
    // });


   const phones = document.querySelectorAll('.phone');

   const isValidPhone = (phoneValue) => {
     // Allow empty/null phone numbers
     if (!phoneValue) return true;

     const PhoneRegex =
       /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{2,3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
     const numericPhoneValue = phoneValue.replace(/[^\d]/g, '');

     return (
       PhoneRegex.test(phoneValue) &&
       (numericPhoneValue.length === 12 || numericPhoneValue.length === 13)
     );
   };

   phones.forEach((phone) => {
     phone.addEventListener('input', () => {
       const value = phone.value.trim(); // Remove leading/trailing whitespace

       if (isValidPhone(value)) {
         phone.classList.remove('error-input');
         phone.classList.add('success-input');
       } else {
         phone.classList.remove('success-input');
         phone.classList.add('error-input');
       }
     });

     // Set initial value and handle user input for prefix +251
     phone.value = '+251 ';
     phone.addEventListener('input', () => {
       const value = phone.value.trim(); // Remove leading/trailing whitespace

       // Check if the input starts with +251
       if (value && !value.startsWith('+251 ')) {
         // If not, reset to +251
         phone.value = '+251 ';
       }

       // Remove all non-digit characters except for allowed ones
       const cleanedValue = phone.value.replace(/[^+\d\s()-]/g, '');
       phone.value = cleanedValue;
     });

     // Prevent user from removing the prefix +251 and ensure only numbers are entered
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

       // Prevent modifying the prefix +251
       if (
         phone.selectionStart < 5 ||
         numericValue.length >= 13 ||
         !/^\d$/.test(event.key)
       ) {
         event.preventDefault();
       }
     });
   });

    /* end of phone validation */
    
    // Age validation
    const ages = formUser.querySelectorAll('.age');

    const isValidAge = (ageValue) => {
      const ageRegex = /^\d+$/;
      return ageRegex.test(ageValue);
    };

    ages.forEach((age) => {
      age.addEventListener('input', () => {
        'Age input value:', age.value;
        if (isValidAge(age.value)) {
          age.classList.remove('error-input');
          age.classList.add('success-input');
          ('Age is valid');
        } else {
          age.classList.remove('success-input');
          age.classList.add('error-input');
          ('Age is NOT valid');
        }
      });
    });

    // Password validation
    const passwords = formUser.querySelectorAll('.validPassword');
    const confirmPasswords = formUser.querySelectorAll('.confirm');
    const charLength = formUser.querySelectorAll('.char-length');
    const charLowercaseLetter = formUser.querySelectorAll(
      '.char-lowercase-letter'
    );
    const charUppercaseLetter = formUser.querySelectorAll(
      '.char-uppercase-letter'
    );
    const digit = formUser.querySelectorAll('.digit');
    const specialChar = formUser.querySelectorAll('.special-char');

    const isValidPassword = (passwordValue) => {
      const passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]).{8,}$/;
      const charLengthRegex = /.{8,}/;
      const charLowercaseLetterRegex = /[a-z]/;
      const charUppercaseLetterRegex = /[A-Z]/;
      const digitRegex = /\d/;
      const specialCharRegex = /[!@#$%^&*()\-_=\[\]{};:'",.<>\/?]/;

      return {
        isValid: passwordRegex.test(passwordValue),
        charLength: charLengthRegex.test(passwordValue),
        charLowercaseLetter: charLowercaseLetterRegex.test(passwordValue),
        charUppercaseLetter: charUppercaseLetterRegex.test(passwordValue),
        digit: digitRegex.test(passwordValue),
        specialChar: specialCharRegex.test(passwordValue),
      };
    };

    const validatePasswords = (password) => {
      const validationResult = isValidPassword(password.value);

      if (validationResult.isValid) {
        password.classList.remove('error-input');
        password.classList.add('success-input');
      } else {
        password.classList.remove('success-input');
        password.classList.add('error-input');
      }

      charLength.forEach((elem) => {
        if (validationResult.charLength) {
          elem.classList.remove('error');
          elem.classList.add('success');
        } else {
          elem.classList.remove('success');
          elem.classList.add('error');
        }
      });

      charLowercaseLetter.forEach((elem) => {
        if (validationResult.charLowercaseLetter) {
          elem.classList.remove('error');
          elem.classList.add('success');
        } else {
          elem.classList.remove('success');
          elem.classList.add('error');
        }
      });

      charUppercaseLetter.forEach((elem) => {
        if (validationResult.charUppercaseLetter) {
          elem.classList.remove('error');
          elem.classList.add('success');
        } else {
          elem.classList.remove('success');
          elem.classList.add('error');
        }
      });

      digit.forEach((elem) => {
        if (validationResult.digit) {
          elem.classList.remove('error');
          elem.classList.add('success');
        } else {
          elem.classList.remove('success');
          elem.classList.add('error');
        }
      });

      specialChar.forEach((elem) => {
        if (validationResult.specialChar) {
          elem.classList.remove('error');
          elem.classList.add('success');
        } else {
          elem.classList.remove('success');
          elem.classList.add('error');
        }
      });
    };

    passwords.forEach((password) => {
      password.addEventListener('input', () => {
        validatePasswords(password);
      });
    });

    // validate confirm password
    const validateConfirmPasswords = (confirmPassword) => {
      const validationResult = isValidPassword(confirmPassword.value);

      confirmPasswords.forEach((confirmPassword) => {
        if (validationResult.isValid) {
          confirmPassword.classList.remove('error-input');
          confirmPassword.classList.add('success-input');
        } else {
          confirmPassword.classList.remove('success-input');
          confirmPassword.classList.add('error-input');
        }
      });
    };

    confirmPasswords.forEach((confirmPassword) => {
      confirmPassword.addEventListener('input', () => {
        validateConfirmPasswords(confirmPassword);
      });
    });

    // Form submission handling
    formUser.addEventListener('submit', (event) => {
      let isFormValid = true;

      // Validate all fields
      emails.forEach((email) => {
        if (!isValidEmail(email.value)) {
          isFormValid = false;
          email.classList.add('error-input');
          console.log('email error');
        } else {
          console.log('email succcess');
        }
      });

      phones.forEach((phone) => {
        if (!isValidPhone(phone.value)) {
          isFormValid = false;
          phone.classList.add('error-input');
          console.log('phone error');
        } else {
          console.log('phone succcess');
        }
      });

      names.forEach((name) => {
        if (!isValidName(name.value)) {
          isFormValid = false;
          name.classList.add('error-input');
        }
      });

      ages.forEach((age) => {
        if (!isValidAge(age.value)) {
          isFormValid = false;
          age.classList.add('error-input');
          console.log('age error');
        } else {
          console.log('age succcess');
        }
      });

      passwords.forEach((password) => {
        const validationResult = isValidPassword(password.value);
        if (!validationResult.isValid) {
          isFormValid = false;
          password.classList.add('error-input');
          console.log('password error');
        } else {
          console.log('password succcess');
        }
      });

      const formContents = formUser.querySelectorAll('.form-content');
      // If form is valid, submit it
      if (isFormValid) {
        formUser.submit();
      } else {
        event.preventDefault();
        // Add shake animation to the form
        formContents.forEach((formContent) => {
          formContent.classList.add('shake');

          // Remove shake animation after 0.5s (duration of shake animation)
          setTimeout(() => {
            formContent.classList.remove('shake');
          }, 500);
        });
      }
    });
  });
};
