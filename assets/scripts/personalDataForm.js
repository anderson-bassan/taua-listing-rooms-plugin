// utils


function getCookie(name) {
  const cookieString = document.cookie;
  const cookies = cookieString.split('; ');

  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i];
    const [cookieName, cookieValue] = cookie.split('=');

    if (cookieName === name) {
      return decodeURIComponent(cookieValue);
    }
  }

  return null;
}


// validations


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
}


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


  // validate data


  const firstNameInput = document.querySelector('#first-name');
  const firstNameError = document.querySelector('#first-name-wrapper .error');
  const lastNameInput = document.querySelector('#last-name');
  const lastNameError = document.querySelector('#last-name-wrapper .error');
  const emailInput = document.querySelector('#email');
  const emailError = document.querySelector('#email-wrapper .error');
  const cpfInput = document.querySelector('#cpf');
  const cpfError = document.querySelector('#cpf-wrapper .error');

  const allErrors = document.querySelectorAll('#personal-data-form .error');

  userDataSendButton.addEventListener('click', () => {
    allErrors.forEach((error) => {
      error.classList.remove('active');
    });

    if (! validateName(firstNameInput.value)) {
      firstNameError.classList.add('active');
    }

    if (! validateLastName(lastNameInput.value)) {
      lastNameError.classList.add('active');
    }

    if (! validateEMail(emailInput.value)) {
      emailError.classList.add('active');
    }

    if (! validateCPF(cpfInput.value)) {
      cpfError.classList.add('active');
    }
  });


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
