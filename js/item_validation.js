/* ********************  */

// validation item form
export  const itemValidation = () => {
  // Get the form element
  const insertAppForms = document.querySelectorAll('.insert-app-form');

  const shakeContents = document.querySelectorAll('.shake-content');
  const inventoryLists = document.querySelectorAll('.inventory_list');
  const itemTypes = document.querySelectorAll('.item_type');
  const descriptions = document.querySelectorAll('.description');
  const inputQuantities = document.querySelectorAll('.quantity');
  const inputPrices = document.querySelectorAll('.price');
  const examinations = document.querySelectorAll('.examination');

  // Function to validate individual input fields
  const validateInput = (inputElement) => {
    const inputValue = inputElement.value.trim();

    if (inputValue === '') {
      inputElement.classList.add('error');
      return false;
    } else {
      inputElement.classList.remove('error');
      return true;
    }
  };

  const validateNumber = (inputElement) => {
    const inputValue = inputElement.value.trim();
    const regexNumber = /^\d+$/; // This regex matches only whole numbers

    if (!regexNumber.test(inputValue)) {
      inputElement.classList.add('error');
      return false;
    } else {
      inputElement.classList.remove('error');
      return true;
    }
  };


  // Event listener for form submission
  insertAppForms.forEach((insertAppForm) => {
    if (insertAppForm) {
      insertAppForm.addEventListener('submit', (event) => {
        let isValid = true;

        // Validate inventoryList input
        inventoryLists.forEach((inventoryList) => {
          if (!validateInput(inventoryList)) {
            isValid = false;
          }
        });

        // Validate item type input

        itemTypes.forEach((itemType) => {
          if (!validateInput(itemType)) {
            isValid = false;
          }
        });

        // Validate description input
        descriptions.forEach((description) => {
          if (!validateInput(description)) {
            isValid = false;
          }
        });

        // Validate quantity input
        inputQuantities.forEach((inputQuantity) => {
          if (!validateInput(inputQuantity) || !validateNumber(inputQuantity)) {
            isValid = false;
          }
        });

        // Validate price input
        inputPrices.forEach((inputPrice) => {
          if (!validateInput(inputPrice) || !validateNumber(inputPrice)) {
            isValid = false;
          }
        });

        // Validate examination input
        examinations.forEach((examination) => {
          if (!validateInput(examination)) {
            isValid = false;
          }
        });

        // Prevent form submission if validation fails
        if (!isValid) {
          event.preventDefault();
          shakeContents.forEach((shakeContent) => {
            shakeContent.classList.add('shake');
            setTimeout(() => {
              shakeContent.classList.remove('shake');
            }, 500);
          });
        }
      });
    }
  });

  // Event listeners for input fields to validate dynamically
  inventoryLists.forEach((inventoryList) => {
    if (inventoryList) {
      inventoryList.addEventListener('input', () => {
        validateInput(inventoryList);
      });
    }
  });

  itemTypes.forEach((itemType) => {
    if (itemType) {
      itemType.addEventListener('input', () => {
        validateInput(itemType);
      });
    }
  });

  descriptions.forEach((description) => {
    if (description) {
      description.addEventListener('input', () => {
        validateInput(description);
      });
    }
  });

  inputQuantities.forEach((inputQuantity) => {
    if (inputQuantity) {
      inputQuantity.addEventListener('input', () => {
        validateInput(inputQuantity);
        validateNumber(inputQuantity);
      });
    }
  });

  inputPrices.forEach((inputPrice) => {
    if (inputPrice) {
      inputPrice.addEventListener('input', () => {
        validateInput(inputPrice);
        validateNumber(inputPrice);
      });
    }
  });

  examinations.forEach((examination) => {
    if (examination) {
      examination.addEventListener('input', () => {
        validateInput(examination);
      });
    }
  });
};

// validation for bin card
 export const binCardValidation = () => {
   const insertBinCardAppForms = document.querySelectorAll(
     '.insert-binCard-form'
   );
   const shakeBinContents = document.querySelectorAll('.shake-bin-content');
   const incomes = document.querySelectorAll('.income');
   const costs = document.querySelectorAll('.cost');
   const shorts = document.querySelectorAll('.short');
   const dateInputs = document.querySelectorAll('.date');

   // Function to validate individual input fields
   const validateInput = (inputElement) => {
     const inputValue = inputElement.value.trim();

     if (inputValue === '') {
       inputElement.classList.add('error');
       return false;
     } else {
       inputElement.classList.remove('error');
       return true;
     }
   };

   // Function to validate numeric fields
   const validateNumber = (inputElement) => {
     const inputValue = inputElement.value.trim();
     const regexNumber = /^\d+$/; // This regex matches only whole numbers

     if (!regexNumber.test(inputValue)) {
       inputElement.classList.add('error');
       return false;
     } else {
       inputElement.classList.remove('error');
       return true;
     }
   };

   // Function to validate date format (YYYY-MM-DD)
   const isValidDateFormat = (dateString) => {
     const regex = /^\d{4}-\d{2}-\d{2}$/;
     return regex.test(dateString);
   };

   insertBinCardAppForms.forEach((insertBinCardAppForm) => {
     if (insertBinCardAppForm) {
       // Event listener for form submission
       insertBinCardAppForm.addEventListener('submit', (event) => {
         let isValid = true;

         // Validate short input
         shorts.forEach((short) => {
           if (!validateInput(short)) {
             isValid = false;
           }
         });

         // Validate income and cost inputs (both required and numeric)
         incomes.forEach((income) => {
           if (!validateInput(income) || !validateNumber(income)) {
             isValid = false;
           }
         });

         costs.forEach((cost) => {
           if (!validateInput(cost) || !validateNumber(cost)) {
             isValid = false;
           }
         });

         // Validate date input
         dateInputs.forEach((dateInput) => {
           if (
             !validateInput(dateInput) ||
             !isValidDateFormat(dateInput.value)
           ) {
             isValid = false;
           }
         });

         // Prevent form submission if validation fails
         if (!isValid) {
           event.preventDefault();
           shakeBinContents.forEach((shakeBinContent) => {
             shakeBinContent.classList.add('shake');
             setTimeout(() => {
               shakeBinContent.classList.remove('shake');
             }, 500);
           });
         }
       });
     }
   });

   // Event listeners for input fields to validate dynamically
   incomes.forEach((income) => {
     if (income) {
       income.addEventListener('input', () => {
         validateInput(income);
         validateNumber(income);
         console.log(income.value);
       });
     }
   });

   costs.forEach((cost) => {
     if (cost) {
       cost.addEventListener('input', () => {
         validateInput(cost);
         validateNumber(cost);
         console.log(cost.value);
       });
     }
   });

   shorts.forEach((short) => {
     if (short) {
       short.addEventListener('input', () => {
         validateInput(short);
         console.log(short.value);
       });
     }
   });

   dateInputs.forEach((dateInput) => {
     if (dateInput) {
       dateInput.addEventListener('input', () => {
         if (!isValidDateFormat(dateInput.value)) {
           dateInput.classList.add('error');
           console.log(dateInput.value);
         } else {
           dateInput.classList.remove('error');
           const dateObject = new Date(dateInput.value);
         }
       });
     }
   });
 };
/* ********************  */

// validation for model 19
export  const validationModel19 = () => {
  const insertModel19AppForms = document.querySelectorAll(
    '.insert-model19-app-form'
  );
  const shakeModel19Contents = document.querySelectorAll(
    '.shake-model19-content'
  );
  const names = document.querySelectorAll('.insert-model19-app-form .added-by');
  const itemTypes = document.querySelectorAll(
    ' .insert-model19-app-form .item_type'
  );
  const models = document.querySelectorAll('.insert-model19-app-form .model');
  const series = document.querySelectorAll('.insert-model19-app-form .serie');
  const inputQuantities = document.querySelectorAll(
    '.insert-model19-app-form .quantity'
  );
  const inputPrices = document.querySelectorAll(
    '.insert-model19-app-form .price'
  );

  // Function to validate individual input fields
  const validateInput = (inputElement) => {
    const inputValue = inputElement.value.trim();

    if (inputValue === '') {
      inputElement.classList.add('error');
      return false;
    } else {
      inputElement.classList.remove('error');
      return true;
    }
  };

  // Function to validate numeric fields
  const validateNumber = (inputElement) => {
    const inputValue = inputElement.value.trim();
    const regexNumber = /^\d+$/; // This regex matches only whole numbers

    if (!regexNumber.test(inputValue)) {
      inputElement.classList.add('error');
      return false;
    } else {
      inputElement.classList.remove('error');
      return true;
    }
  };

  const isValidName = (nameValue) => {
    const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
    return nameRegex.test(nameValue);
  };

  const validName = (name) => {
    if (isValidName(name.value)) {
      name.classList.remove('error-input');
      name.classList.add('success-input');
    } else {
      name.classList.remove('success-input');
      name.classList.add('error-input');
    }
  };

  // Event listener for form submission

  insertModel19AppForms.forEach((insertModel19AppForm) => {
    if (insertModel19AppForm) {
      insertModel19AppForm.addEventListener('submit', (event) => {
        let isValid = true;

        // Validate item type input
        names.forEach((name) => {
          if (!validateInput(name)) {
            isValid = false;
          }
        });

        // Validate item type input
        itemTypes.forEach((itemType) => {
          if (!validateInput(itemType)) {
            isValid = false;
          }
        });

        // Validate model input
        models.forEach((model) => {
          if (!validateInput(model)) {
            isValid = false;
          }
        });

        // Validate serie input
        series.forEach((serie) => {
          if (!validateInput(serie)) {
            isValid = false;
          }
        });

        // Validate quantity input
        inputQuantities.forEach((inputQuantity) => {
          if (!validateInput(inputQuantity) || !validateNumber(inputQuantity)) {
            isValid = false;
          }
        });

        // Validate price input
        inputPrices.forEach((inputPrice) => {
          if (!validateInput(inputPrice) || !validateNumber(inputPrice)) {
            isValid = false;
          }
        });

        // Prevent form submission if validation fails
        if (!isValid) {
          event.preventDefault();
          shakeModel19Contents.forEach((shakeModel19Content) => {
            shakeModel19Content.classList.add('shake');
            setTimeout(() => {
              shakeModel19Content.classList.remove('shake');
            }, 500);
          });
        }
      });
    }
  });

  // Event listeners for input fields to validate dynamically
  names.forEach((name) => {
    if (name) {
      name.addEventListener('input', () => {
        validName(name);
        validateInput(name);
      });
    }
  });

  itemTypes.forEach((itemType) => {
    if (itemType) {
      itemType.addEventListener('input', () => {
        validateInput(itemType);
      });
    }
  });

  models.forEach((model) => {
    if (model) {
      model.addEventListener('input', () => {
        validateInput(model);
      });
    }
  });

  series.forEach((serie) => {
    if (serie) {
      serie.addEventListener('input', () => {
        validateInput(serie);
      });
    }
  });

  inputQuantities.forEach((inputQuantity) => {
    if (inputQuantity) {
      inputQuantity.addEventListener('input', () => {
        validateInput(inputQuantity);
        validateNumber(inputQuantity);
      });
    }
  });

  inputPrices.forEach((inputPrice) => {
    if (inputPrice) {
      inputPrice.addEventListener('input', () => {
        validateInput(inputPrice);
        validateNumber(inputPrice);
      });
    }
  });
};

/* ********************  */

// validation for model 20
export const validationModel20 = () => {
  const insertModel20AppForms = document.querySelectorAll(
    '.insert-model20-app-form'
  );

  insertModel20AppForms.forEach((insertModel20AppForm) => {
    if (insertModel20AppForm) {
      const shakeModel20Content = document.querySelector(
        '.shake-model20-content'
      );
      const name = insertModel20AppForm.querySelector('#requested-by');
      const itemType = insertModel20AppForm.querySelector('#item_type');
      const model = insertModel20AppForm.querySelector('#model');
      const update = insertModel20AppForm.querySelector('#update');
      const inputQuantity = insertModel20AppForm.querySelector('#quantity');

      // Function to validate individual input fields
      const validateInput = (inputElement) => {
        const inputValue = inputElement.value.trim();

        if (inputValue === '') {
          inputElement.classList.add('error');
          return false;
        } else {
          inputElement.classList.remove('error');
          return true;
        }
      };

      // Function to validate numeric fields
      const validateNumber = (inputElement) => {
        const inputValue = parseFloat(inputElement.value.trim());

        if (isNaN(inputValue) || inputValue <= 0) {
          inputElement.classList.add('error');
          return false;
        } else {
          inputElement.classList.remove('error');
          return true;
        }
      };

      const isValidName = (nameValue) => {
        const nameRegex = /^[A-Za-z][A-Za-z\s'-]+$/;
        return nameRegex.test(nameValue);
      };

      const validName = (name) => {
        if (isValidName(name.value)) {
          name.classList.remove('error-input');
          name.classList.add('success-input');
          ('Name is valid');
        } else {
          name.classList.remove('success-input');
          name.classList.add('error-input');
          ('Name is NOT valid');
        }
      };

      // Event listener for form submission
      insertModel20AppForm.addEventListener('submit', (event) => {
        let isValid = true;

        // Validate item type input
        if (!validateInput(name)) {
          isValid = false;
        }

        // Validate item type input
        if (!validateInput(itemType)) {
          isValid = false;
        }

        // Validate model input
        if (!validateInput(model)) {
          isValid = false;
        }

        // Validate update input
        if (!validateInput(update)) {
          isValid = false;
        }

        // Validate quantity input
        if (!validateInput(inputQuantity) || !validateNumber(inputQuantity)) {
          isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
          event.preventDefault();
          shakeModel20Content.classList.add('shake');
          setTimeout(() => {
            shakeModel20Content.classList.remove('shake');
          }, 500);
        }
      });

      // Event listeners for input fields to validate dynamically

      name.addEventListener('input', () => {
        validName(name);
        validateInput(name);
      });

      itemType.addEventListener('input', () => {
        validateInput(itemType);
      });

      model.addEventListener('input', () => {
        validateInput(model);
      });

      update.addEventListener('input', () => {
        validateInput(update);
      });

      inputQuantity.addEventListener('input', () => {
        validateInput(inputQuantity);
        validateNumber(inputQuantity);
      });
    }
  });

};
