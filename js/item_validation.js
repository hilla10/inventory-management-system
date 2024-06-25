// validation item form
export const itemValidation = () => {
  // Get the form element
  const insertAppForm = document.querySelector('.insert-app-form');
  const shakeContent = document.querySelector('.shake-content');
  const inventoryList = document.getElementById('inventory-list');
  const description = document.getElementById('description');
  const measure = document.getElementById('measure');
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
  insertAppForm.addEventListener('submit', (event) => {
    let isValid = true;

    // Validate inventoryList input
    if (!validateInput(inventoryList)) {
      isValid = false;
    }

    // Validate description input
    if (!validateInput(description)) {
      isValid = false;
    }

    // Validate measure input
    if (!validateInput(measure)) {
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

  // Event listeners for input fields to validate dynamically
  inventoryList.addEventListener('input', () => {
    validateInput(inventoryList);
  });

  description.addEventListener('input', () => {
    validateInput(description);
  });

  measure.addEventListener('input', () => {
    validateInput(measure);
  });

  inputQuantity.addEventListener('input', () => {
    validateInput(inputQuantity);
    validateNumber(inputQuantity);
  });

  inputPrice.addEventListener('input', () => {
    validateInput(inputPrice);
    validateNumber(inputPrice);
  });

  examination.addEventListener('input', () => {
    validateInput(examination);
  });
};

/* ********************  */

// validation for bin card
export const binCardValidation = () => {
  const insertAppForm = document.querySelector('.insert-binCard-form');
  const shakeContent = document.querySelector('.shake-content');
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

  // Event listener for form submission
  insertAppForm.addEventListener('submit', (event) => {
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
      shakeContent.classList.add('shake');
      setTimeout(() => {
        shakeContent.classList.remove('shake');
      }, 500);
    }
  });

  // Event listeners for input fields to validate dynamically
  income.addEventListener('input', () => {
    validateInput(income);
    validateNumber(income);
  });

  cost.addEventListener('input', () => {
    validateInput(cost);
    validateNumber(cost);
  });

  short.addEventListener('input', () => {
    validateInput(short);
  });

  dateInput.addEventListener('input', () => {
    if (!isValidDateFormat(dateInput.value)) {
      dateInput.classList.add('error');
    } else {
      dateInput.classList.remove('error');
      const dateObject = new Date(dateInput.value);
      console.log('Parsed Date:', dateObject);
    }
  });
};

/* ********************  */

// validation for model 19
export const validationModel19 = () => {
  const insertAppForm = document.querySelector('.insert-model-app-form');
  const shakeContent = document.querySelector('.shake-content');
  const name = document.getElementById('added-by');
  const itemType = document.getElementById('item-type');
  const model = document.getElementById('model');
  const serie = document.getElementById('serie');
  const inputQuantity = insertAppForm.querySelector('#quantity');
  const inputPrice = insertAppForm.querySelector('#price');

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
  insertAppForm.addEventListener('submit', (event) => {
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
      shakeContent.classList.add('shake');
      setTimeout(() => {
        shakeContent.classList.remove('shake');
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

  serie.addEventListener('input', () => {
    validateInput(serie);
  });

  inputQuantity.addEventListener('input', () => {
    validateInput(inputQuantity);
    validateNumber(inputQuantity);
  });

  inputPrice.addEventListener('input', () => {
    validateInput(inputPrice);
    validateNumber(inputPrice);
  });
};


/* ********************  */

// validation for model 20
export const validationModel20 = () => {
  const insertAppForm = document.querySelector('.insert-model20-app-form');
  const shakeContent = insertAppForm.querySelector('.shake-content');
  const name = insertAppForm.querySelector('#requested-by');
  const itemType = insertAppForm.querySelector('#item-type');
  const model = insertAppForm.querySelector('#model');
  const update = insertAppForm.querySelector('#update');
  const inputQuantity = insertAppForm.querySelector('#quantity');

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
  insertAppForm.addEventListener('submit', (event) => {
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
      shakeContent.classList.add('shake');
      setTimeout(() => {
        shakeContent.classList.remove('shake');
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

};
