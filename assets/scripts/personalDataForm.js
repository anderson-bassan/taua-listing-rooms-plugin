// visual updates


const updatePersonalDataForm = () => {
  const sendButton = document.querySelector('#personal-data-form .buttons-wrapper .send');
  const updateButton = document.querySelector('#personal-data-form .buttons-wrapper .change');
  const guestsForm = document.querySelector('#guests-form');
  const guestsFormSendButton = document.querySelector('#guests-form .buttons-wrapper .send');
  const guestsFormChangeButton = document.querySelector('#guests-form .buttons-wrapper .change');

  sendButton.classList.remove('active');
  updateButton.classList.add('active');

  if (! getCookie('guestFullName')) {
    guestsForm.classList.add('active');
    guestsFormChangeButton.classList.remove('active');
    guestsFormSendButton.classList.add('active');
  } else {
    guestForm.classList.add('active');
    guestsFormSendButton.classList.remove('active');
    guestsFormChangeButton.classList.add('active');
  }
}

const updateGuestsForm = () => {
  const guestsForm = document.querySelector('#guests-form');
  const guestsFormSendButton = document.querySelector('#guests-form .buttons-wrapper .send');
  const guestsFormChangeButton = document.querySelector('#guests-form .buttons-wrapper .change');


  guestsForm.classList.add('active');
  guestsFormSendButton.classList.remove('active');
  guestsFormChangeButton.classList.add('active');
}

const personalDataFormBackEndError = () => {
  const formError = document.querySelector('#user-data-error');

  formError.classList.add('active');
}

const guestsFormBackEndError = () => {
  const formError = document.querySelector('#guests-error');

  formError.classList.add('active');
}


// validations


const validateGuestsFormData = () => {
  const adultsNumber = document.querySelector('#adults-number');
  const childrenNumber = document.querySelector('#children-number');
  const guestFullName = document.querySelector('#guest-full-name');
  const guestEmail = document.querySelector('#guest-email');
  const visitorFullName = document.querySelector('#visitor-full-name');
  const visitorAge = document.querySelector('#visitor-age');
  const visitorEmail = document.querySelector('#visitor-email');

  const adultsNumberError = document.querySelector('#adults-number-wrapper .error');
  const childrenNumberError = document.querySelector('#children-number-wrapper .error');
  const guestFullNameError = document.querySelector('#guest-full-name-wrapper .error');
  const guestEmailError = document.querySelector('#guest-email-wrapper .error');
  const visitorFullNameError = document.querySelector('#visitor-full-name-wrapper .error');
  const visitorAgeError = document.querySelector('#visitor-age-wrapper .error');
  const visitorEmailError = document.querySelector('#visitor-email-wrapper .error');
  let isValid = true;

  if (!validateNumber(adultsNumber.value)) {
    adultsNumberError.classList.add('active');
    isValid = false;
  } else {
    adultsNumberError.classList.remove('active');
  }

  if (!validateNumber(childrenNumber.value)) {
    childrenNumberError.classList.add('active');
    isValid = false;
  } else {
    childrenNumberError.classList.remove('active');
  }

  if (!validateName(guestFullName.value)) {
    guestFullNameError.classList.add('active');
    isValid = false;
  } else {
    guestFullNameError.classList.remove('active');
  }

  if (!validateEMail(guestEmail.value)) {
    guestEmailError.classList.add('active');
    isValid = false;
  } else {
    guestEmailError.classList.remove('active');
  }

  if (!validateName(visitorFullName.value) && visitorFullName.value !== '') {
    visitorFullNameError.classList.add('active');
    isValid = false;
  } else {
    visitorFullNameError.classList.remove('active');
  }

  if (!validateAge(visitorAge.value) && visitorAge.value !== '') {
    visitorAgeError.classList.add('active');
    isValid = false;
  } else {
    visitorAgeError.classList.remove('active');
  }

  if (!validateEMail(visitorEmail.value) && visitorEmail.value !== '') {
    visitorEmailError.classList.add('active');
    isValid = false;
  } else {
    visitorEmailError.classList.remove('active');
  }

  return isValid;
}

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

const validateNumber = (number) => {
  return /^\d*$/.test(number);
};

const validateAge = (number) => {
  return /^\d+$/.test(number) && parseInt(number) > 0;
};



// event listeners


window.addEventListener('load', () => {
  // show correct button based on if there's user data or not
  const guestForm = document.querySelector('#guests-form');
  const userDataSendButton = document.querySelector('#personal-data-form button.send');
  const userDataChangeButton = document.querySelector('#personal-data-form button.change');

  const guestsFormSendButton = document.querySelector('#guests-form button.send');
  const guestsFormChangeButton = document.querySelector('#guests-form button.change');


  // send or change button based on cookies for user data
  if (! getCookie('firstName')) {
    userDataChangeButton.classList.remove('active');
    userDataSendButton.classList.add('active');
  } else {
    document.querySelector('#first-name').value = getCookie('firstName');
    document.querySelector('#last-name').value = getCookie('lastName');
    document.querySelector('#email').value = getCookie('email');
    document.querySelector('#cpf').value = getCookie('cpf');
    document.querySelector('#country-code').value = getCookie('countryCode');
    document.querySelector('#ddd').value = getCookie('ddd');
    document.querySelector('#phone').value = getCookie('phone');
    document.querySelector('#address').value = getCookie('address');
    document.querySelector('#house-number').value = getCookie('houseNumber');
    document.querySelector('#house-info').value = getCookie('houseInfo');
    document.querySelector('#country').value = getCookie('country');
    document.querySelector('#state').value = getCookie('state');

    userDataSendButton.classList.remove('active');
    userDataChangeButton.classList.add('active');
  }

  // send or change button based on cookies for user guests
  if (! getCookie('guestFullName')) {
    guestsFormChangeButton.classList.remove('active');
    guestsFormSendButton.classList.add('active');
  } else {
    document.querySelector('#adults-number').value = getCookie('adultsNumber');
    document.querySelector('#children-number').value = getCookie('childrenNumber');
    document.querySelector('#guest-full-name').value = getCookie('guestFullName');
    document.querySelector('#guest-email').value = getCookie('guestEmail');
    document.querySelector('#visitor-full-name').value = getCookie('visitorFullName');
    document.querySelector('#visitor-age').value = getCookie('visitorAge');
    document.querySelector('#visitor-email').value = getCookie('visitorEmail');

    guestForm.classList.add('active');
    guestsFormSendButton.classList.remove('active');
    guestsFormChangeButton.classList.add('active');
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

  const adultsNumber = document.querySelector('#adults-number');
  const childrenNumber = document.querySelector('#children-number');
  const guestFullName = document.querySelector('#guest-full-name');
  const guestEmail = document.querySelector('#guest-email');
  const visitorFullName = document.querySelector('#visitor-full-name');
  const visitorAge = document.querySelector('#visitor-age');
  const visitorEmail = document.querySelector('#visitor-email');

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

      sendPostRequest(url, userData, updatePersonalDataForm, personalDataFormBackEndError);
    }

  });

  userDataChangeButton.addEventListener('click', () => {
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

      sendPostRequest(url, userData, updatePersonalDataForm, personalDataFormBackEndError);
    }

  });


  guestsFormSendButton.addEventListener('click', () => {
    const adultsNumber = document.querySelector('#adults-number').value;
    const childrenNumber = document.querySelector('#children-number').value;
    const guestFullName = document.querySelector('#guest-full-name').value;
    const guestEmail = document.querySelector('#guest-email').value;
    const visitorFullName = document.querySelector('#visitor-full-name').value;
    const visitorAge = document.querySelector('#visitor-age').value;
    const visitorEmail = document.querySelector('#visitor-email').value;

    allErrors.forEach((error) => {
      error.classList.remove('active');
    });

    if (validateGuestsFormData()) {
      const userData = {
        adultsNumber,
        childrenNumber,
        guestFullName,
        guestEmail,
        visitorFullName,
        visitorAge,
        visitorEmail
      };

      url = 'http://localhost/wp-json/lista-quartos-plugin/v1/set-guests-data';

      sendPostRequest(url, userData, updateGuestsForm, guestsFormBackEndError);
    }
  })

  guestsFormChangeButton.addEventListener('click', () => {
    const adultsNumber = document.querySelector('#adults-number').value;
    const childrenNumber = document.querySelector('#children-number').value;
    const guestFullName = document.querySelector('#guest-full-name').value;
    const guestEmail = document.querySelector('#guest-email').value;
    const visitorFullName = document.querySelector('#visitor-full-name').value;
    const visitorAge = document.querySelector('#visitor-age').value;
    const visitorEmail = document.querySelector('#visitor-email').value;

    allErrors.forEach((error) => {
      error.classList.remove('active');
    });

    if (validateGuestsFormData()) {
      const userData = {
        adultsNumber,
        childrenNumber,
        guestFullName,
        guestEmail,
        visitorFullName,
        visitorAge,
        visitorEmail
      };

      url = 'http://localhost/wp-json/lista-quartos-plugin/v1/set-guests-data';

      sendPostRequest(url, userData, updateGuestsForm, guestsFormBackEndError);
    }
  })


  // masks


  initializePhoneInputMask(phoneInput);
  numberOnlyInputMask(dddInput);
  numberOnlyInputMask(houseNumberInput);
  letterAndSpaceOnlyInputMask(firstNameInput);
  letterAndSpaceOnlyInputMask(lastNameInput);
  noSpaceInputMask(emailInput);
  alphanumericAndSpaceOnlyInputMask(addressInput);
  initializeCPFInputMask(cpfInput);
  numberOnlyInputMask(visitorAge);
  numberOnlyInputMask(childrenNumber);
  numberOnlyInputMask(adultsNumber);
  letterAndSpaceOnlyInputMask(visitorFullName);
  letterAndSpaceOnlyInputMask(guestFullName);
  noSpaceInputMask(visitorEmail);
  noSpaceInputMask(guestEmail);


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
