// visual updates


const updatePersonalDataForm = () => {
  const sendButton = document.querySelector('#personal-data-form .buttons-wrapper .send');
  const updateButton = document.querySelector('#personal-data-form .buttons-wrapper .change');

  sendButton.classList.remove('active');
  updateButton.classList.add('active');
}

const personalDataFormBackEndError = () => {
  const formError = document.querySelector('#user-data-error');

  formError.classList.add('active');
}


// validations


const validatePersonalDataFormData = () => {
  const firstNameInput = document.querySelector('#first-name');
  const lastNameInput = document.querySelector('#last-name');
  const emailInput = document.querySelector('#email');
  const cpfInput = document.querySelector('#cpf');
  const dddInput = document.querySelector('#ddd');
  const phoneInput = document.querySelector('#phone');
  const addressInput = document.querySelector('#address');
  const houseNumberInput = document.querySelector('#house-number');
  const countryInput = document.querySelector('#country');
  const stateInput = document.querySelector('#state');

  const firstNameError = document.querySelector('#first-name-wrapper .error');
  const lastNameError = document.querySelector('#last-name-wrapper .error');
  const emailError = document.querySelector('#email-wrapper .error');
  const cpfError = document.querySelector('#cpf-wrapper .error');
  const dddError = document.querySelector('#ddd-error');
  const phoneError = document.querySelector('#phone-wrapper .error');
  const addressError = document.querySelector('#address-wrapper .error');
  const houseNumberError = document.querySelector('#house-number-error');
  const countryError = document.querySelector('#country-error');
  const stateError = document.querySelector('#state-error');
  let isValid = true;

  if (!validateName(firstNameInput.value)) {
    firstNameError.classList.add('active');
    isValid = false;
  } else {
    firstNameError.classList.remove('active');
  }

  if (!validateLastName(lastNameInput.value)) {
    lastNameError.classList.add('active');
    isValid = false;
  } else {
    lastNameError.classList.remove('active');
  }

  if (!validateEMail(emailInput.value)) {
    emailError.classList.add('active');
    isValid = false;
  } else {
    emailError.classList.remove('active');
  }

  if (!validateCPF(cpfInput.value)) {
    cpfError.classList.add('active');
    isValid = false;
  } else {
    cpfError.classList.remove('active');
  }

  if (!validateDDD(dddInput.value)) {
    dddError.classList.add('active');
    isValid = false;
  } else {
    dddError.classList.remove('active');
  }

  if (!validatePhoneNumber(phoneInput.value)) {
    phoneError.classList.add('active');
    isValid = false;
  } else {
    phoneError.classList.remove('active');
  }

  if (!validateAddress(addressInput.value)) {
    addressError.classList.add('active');
    isValid = false;
  } else {
    addressError.classList.remove('active');
  }

  if (!validateHouseNumber(houseNumberInput.value)) {
    houseNumberError.classList.add('active');
    isValid = false;
  } else {
    houseNumberError.classList.remove('active');
  }

  if (!validateCountry(countryInput.value)) {
    countryError.classList.add('active');
    isValid = false;
  } else {
    countryError.classList.remove('active');
  }

  if (!validateState(stateInput.value)) {
    stateError.classList.add('active');
    isValid = false;
  } else {
    stateError.classList.remove('active');
  }

  return isValid;
}

const validateName = (name) => {
  if (! /^[A-Za-z\s]+$/.test(name)) {

    return false;
  }

  if (! (name.length >= 3)) {

    return false;
  }

  return true;
}

const validateLastName = (lastName) => {
  if (! /^[A-Za-z\s]+$/.test(lastName)) {

    return false;
  }

  if (! (lastName.length >= 2)) {

    return false;
  }

  return true;
}

const validateEMail = (email) => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  return emailPattern.test(email);
}

const validateCPF = (cpf) => {
  // Remove non-digit characters from the CPF string
  const cleanedCPF = cpf.replace(/\D/g, '');

  // CPF must have exactly 11 digits
  if (cleanedCPF.length !== 11) {
    return false;
  }

  // Check for repeated digits
  if (/^(\d)\1{10}$/.test(cleanedCPF)) {
    return false;
  }

  return true;
}

const validateDDD = (ddd) => {
  return /^\d{2,}$/.test(ddd);
}

const validatePhoneNumber = (phoneNumber) => {
  const digitsOnly = phoneNumber.replace(/\D/g, ''); // Remove all non-digit characters

  return /^\d{8,9}$/.test(digitsOnly) && digitsOnly.length >= 8;
};

const validateAddress = (address) => {
  return /^[a-zA-Z0-9\s]+$/.test(address);
};

const validateHouseNumber = (houseNumber) => {
  return /\d/.test(houseNumber);
};

const validateState = (state) => {
  return (state != '');
};

const validateCountry = (country) => {
  return (country != '');
};


// event listeners


window.addEventListener('load', () => {
  // show correct button based on if there's user data or not
  const userDataSendButton = document.querySelector('#personal-data-form button.send');
  const userDataChangeButton = document.querySelector('#personal-data-form button.change');

  if (! getCookie('firtName')) {
    userDataChangeButton.classList.remove('active');
    userDataSendButton.classList.add('active');
  } else {
    userDataSendButton.classList.remove('active');
    userDataChangeButton.classList.add('active');
  }


  // inputs for masks
  const firstNameInput = document.querySelector('#first-name');
  const lastNameInput = document.querySelector('#last-name');
  const emailInput = document.querySelector('#email');
  const cpfInput = document.querySelector('#cpf');
  const dddInput = document.querySelector('#ddd');
  const phoneInput = document.querySelector('#phone');
  const addressInput = document.querySelector('#address');
  const houseNumberInput = document.querySelector('#house-number');
  const countryInput = document.querySelector('#country');
  const stateInput = document.querySelector('#state');

  const allErrors = document.querySelectorAll('#personal-data-form .error');

  userDataSendButton.addEventListener('click', () => {
    // values for sending
    const firstName = document.querySelector('#first-name').value;
    const lastName = document.querySelector('#last-name').value;
    const email = document.querySelector('#email').value;
    const cpf = document.querySelector('#cpf').value;
    const countryCode = document.querySelector('#country-code').value;
    const ddd = document.querySelector('#ddd').value;
    const phone = document.querySelector('#phone').value;
    const address = document.querySelector('#address').value;
    const houseNumber = document.querySelector('#house-number').value;
    const houseInfo = document.querySelector('#house-info').value;
    const country = document.querySelector('#country').value;
    const state = document.querySelector('#state').value;

    allErrors.forEach((error) => {
      error.classList.remove('active');
    });

    if (validatePersonalDataFormData()) {
      const userData = {
        firstName,
        lastName,
        email,
        cpf,
        countryCode,
        ddd,
        phone,
        address,
        houseNumber,
        houseInfo,
        country,
        state
      };

      url = 'http://localhost/wp-json/lista-quartos-plugin/v1/set-user-data';

      console.log(userData);

      sendPostRequest(url, userData, updatePersonalDataForm, personalDataFormBackEndError);
    }

  });


  // masks


  initializePhoneInputMask(phoneInput);
  numberOnlyInputMask(dddInput);
  numberOnlyInputMask(houseNumberInput);
  letterAndSpaceOnlyInputMask(firstNameInput);
  letterAndSpaceOnlyInputMask(lastNameInput);
  noSpaceInputMask(emailInput);
  alphanumericAndSpaceOnlyInputMask(addressInput);
  initializeCPFInputMask(cpfInput);


  // cpf popup
  const cpfPopup = document.querySelector('#cpf-popup');
  const cpfLabel = document.querySelector('#cpf-wrapper span');

  cpfLabel.addEventListener('mouseover', () => {
    cpfPopup.classList.add('active');
  });

  cpfLabel.addEventListener('mouseout', () => {
    cpfPopup.classList.remove('active');
  })
});
