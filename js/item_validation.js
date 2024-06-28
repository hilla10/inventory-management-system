/* ********************  */

// validation item form
export const itemValidation = () => {
  // Get the form element
  const insertAppForm = document.querySelector('.insert-app-form');
  const shakeContent = document.querySelector('.shake-content');
  const inventoryList = document.getElementById('inventory_list');
  const itemType = document.getElementById('item_type');
  const description = document.getElementById('description');
  const inputQuantity = document.getElementById('quantity');
  const inputPrice = document.getElementById('price');
  const examination = document.getElementById('examination');

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

  // Event listener for form submission
  if (insertAppForm) {
    insertAppForm.addEventListener('submit', (event) => {
      let isValid = true;

      // Validate inventoryList input
      if (!validateInput(inventoryList)) {
        isValid = false;
      }

      // Validate item type input
      if (!validateInput(itemType)) {
        isValid = false;
      }

      // Validate description input
      if (!validateInput(description)) {
        isValid = false;
      }

      // Validate quantity input
      if (!validateInput(inputQuantity) || !validateNumber(inputQuantity)) {
        isValid = false;
      }

      // Validate price input
      if (!validateInput(inputPrice) || !validateNumber(inputPrice)) {
        isValid = false;
      }

      // Validate examination input
      if (!validateInput(examination)) {
        isValid = false;
      }

      // Prevent form submission if validation fails
      if (!isValid) {
        event.preventDefault();
        shakeContent.classList.add('shake');
        setTimeout(() => {
          shakeContent.classList.remove('shake');
        }, 500);
      }
    });
  }

  // Event listeners for input fields to validate dynamically
  if (inventoryList) {
    inventoryList.addEventListener('input', () => {
      validateInput(inventoryList);
    });
  }

  if (itemType) {
    itemType.addEventListener('input', () => {
      validateInput(itemType);
    });
  }

  if (description) {
    description.addEventListener('input', () => {
      validateInput(description);
    });
  }

  if (inputQuantity) {
    inputQuantity.addEventListener('input', () => {
      validateInput(inputQuantity);
      validateNumber(inputQuantity);
    });
  }

  if (inputPrice) {
    inputPrice.addEventListener('input', () => {
      validateInput(inputPrice);
      validateNumber(inputPrice);
    });
  }

  if (examination) {
    examination.addEventListener('input', () => {
      validateInput(examination);
    });
  }
};

// validation for bin card
export const binCardValidation = () => {
  const insertBinCardAppForm = document.querySelector('.insert-binCard-form');
  const shakeBinContent = document.querySelector('.shake-bin-content');
  const income = document.getElementById('income');
  const cost = document.getElementById('cost');
  const short = document.getElementById('short');
  const dateInput = document.getElementById('date');
  
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

  // Function to validate date format (YYYY-MM-DD)
  const isValidDateFormat = (dateString) => {
    const regex = /^\d{4}-\d{2}-\d{2}$/;
    return regex.test(dateString);
  };

  if (insertBinCardAppForm) {
    // Event listener for form submission
    insertBinCardAppForm.addEventListener('submit', (event) => {
      let isValid = true;

      // Validate short input
      if (!validateInput(short)) {
        isValid = false;
      }

      // Validate income and cost inputs (both required and numeric)
      if (!validateInput(income) || !validateNumber(income)) {
        isValid = false;
      }

      if (!validateInput(cost) || !validateNumber(cost)) {
        isValid = false;
      }

      // Validate date input
      if (!validateInput(dateInput) || !isValidDateFormat(dateInput.value)) {
        isValid = false;
      }

      // Prevent form submission if validation fails
      if (!isValid) {
        event.preventDefault();
        shakeBinContent.classList.add('shake');
        setTimeout(() => {
          shakeBinContent.classList.remove('shake');
        }, 500);
      }
    });
  }

  // Event listeners for input fields to validate dynamically
  if (income) {
    income.addEventListener('input', () => {
      validateInput(income);
      validateNumber(income);
    });
  }

  if (cost) {
    cost.addEventListener('input', () => {
      validateInput(cost);
      validateNumber(cost);
    });
  }
  if (short) {
    short.addEventListener('input', () => {
      validateInput(short);
    });
  }

  if (dateInput) {
    dateInput.addEventListener('input', () => {
      if (!isValidDateFormat(dateInput.value)) {
        dateInput.classList.add('error');
      } else {
        dateInput.classList.remove('error');
        const dateObject = new Date(dateInput.value);
      }
    });
  }
};

/* ********************  */

// validation for model 19
export const validationModel19 = () => {
  const insertModel19AppForm = document.querySelector('.insert-model-app-form');
  const shakeModel19Content = document.querySelector('.shake-model19-content');
  const name = document.querySelector('.insert-model-app-form #added-by');
  const itemType = document.querySelector(' .insert-model-app-form .item_type');
  const model = document.querySelector('.insert-model-app-form #model');
  const serie = document.querySelector('.insert-model-app-form #serie');
  const inputQuantity = document.querySelector(
    '.insert-model-app-form .quantity'
  );
  const inputPrice = document.querySelector('.insert-model-app-form .price');

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
  if (insertModel19AppForm) {
    insertModel19AppForm.addEventListener('submit', (event) => {
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
      // Validate serie input
      if (!validateInput(serie)) {
        isValid = false;
      }

      // Validate quantity input
      if (!validateInput(inputQuantity) || !validateNumber(inputQuantity)) {
        isValid = false;
      }

      // Validate price input
      if (!validateInput(inputPrice) || !validateNumber(inputPrice)) {
        isValid = false;
      }

      // Prevent form submission if validation fails
      if (!isValid) {
        event.preventDefault();
        shakeModel19Content.classList.add('shake');
        setTimeout(() => {
          shakeModel19Content.classList.remove('shake');
        }, 500);
      }
    });
  }

  // Event listeners for input fields to validate dynamically
  if (name) {
    name.addEventListener('input', () => {
      validName(name);
      validateInput(name);
    });
  }

  if (itemType) {
    itemType.addEventListener('input', () => {
      validateInput(itemType);
    });
  }

  if (model) {
    model.addEventListener('input', () => {
      validateInput(model);
    });
  }

  if (serie) {
    serie.addEventListener('input', () => {
      validateInput(serie);
    });
  }

  if (inputQuantity) {
    inputQuantity.addEventListener('input', () => {
      validateInput(inputQuantity);
      validateNumber(inputQuantity);
    });
  }

  if (inputPrice) {
    inputPrice.addEventListener('input', () => {
      validateInput(inputPrice);
      validateNumber(inputPrice);
    });
  }
};

/* ********************  */

// validation for model 20
export const validationModel20 = () => {
  const insertModel20AppForm = document.querySelector('.insert-model20-app-form');
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
};
