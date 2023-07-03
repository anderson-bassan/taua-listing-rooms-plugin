const getCookie = (name) => {
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

const sendPostRequest = (url, payLoad, callback, errorCallback) => {
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payLoad)
  })
  .then(response => {
    if (response.ok) {
      callback();
    } else {
      errorCallback();
    }
  })
  .catch(error => {
    console.error('Error sending data:', error);
  });
}


// masks


const initializePhoneInputMask = (input) => {
  input.addEventListener('input', () => {
    let numericValue = input.value.replace(/[^\d]/g, ''); // Remove non-digit characters
    numericValue = numericValue.slice(0, 9); // Limit to 9 digits

    if (numericValue.length === 8) {
      numericValue = numericValue.replace(/(\d{4})(\d{4})/, '$1-$2'); // Format as 8485-1236
    } else if (numericValue.length === 9) {
      numericValue = numericValue.replace(/(\d)(\d{4})(\d{4})/, '$1 $2-$3'); // Format as 9 8485-1236
    }

    input.value = numericValue; // Update input value with formatted value
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace') {
      let numericValue = input.value.replace(/[^\d]/g, ''); // Remove non-digit characters
      numericValue = numericValue.slice(0, -1); // Simulate backspace
      input.value = numericValue; // Update input value
      event.preventDefault();
    }
  });
};



const numberOnlyInputMask = (input) => {
  input.addEventListener('input', () => {
    const numericValue = input.value.replace(/[^\d+]/g, '');
    input.value = numericValue; // Update input value with numeric-only value
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace') {
      const numericValue = input.value.replace(/[^\d+]/g, '');
      const newValue = numericValue.slice(0, -1); // Simulates backspace
      input.value = newValue; // Update input value
      event.preventDefault();
    }
  });
};

const letterAndSpaceOnlyInputMask = (input) => {
  input.addEventListener('input', () => {
    const letterAndSpaceValue = input.value.replace(/[^a-zA-Z\s]/g, '');
    input.value = letterAndSpaceValue; // Update input value with letter and space-only value
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace') {
      const letterAndSpaceValue = input.value.replace(/[^a-zA-Z\s]/g, '');
      const newValue = letterAndSpaceValue.slice(0, -1); // Simulates backspace
      input.value = newValue; // Update input value
      event.preventDefault();
    }
  });
};

const noSpaceInputMask = (input) => {
  input.addEventListener('input', () => {
    const valueWithoutSpaces = input.value.replace(/\s/g, ''); // Remove spaces from the input value
    input.value = valueWithoutSpaces; // Update input value without spaces
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace') {
      const valueWithoutSpaces = input.value.replace(/\s/g, ''); // Remove spaces from the input value
      const newValue = valueWithoutSpaces.slice(0, -1); // Simulates backspace
      input.value = newValue; // Update input value
      event.preventDefault();
    }
  });
};

const alphanumericAndSpaceOnlyInputMask = (input) => {
  input.addEventListener('input', () => {
    const alphanumericAndSpaceValue = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
    input.value = alphanumericAndSpaceValue; // Update input value with alphanumeric and space-only value
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace') {
      const alphanumericAndSpaceValue = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
      const newValue = alphanumericAndSpaceValue.slice(0, -1); // Simulates backspace
      input.value = newValue; // Update input value
      event.preventDefault();
    }
  });
};

const initializeCPFInputMask = (input) => {
  input.addEventListener('input', () => {
    let numericValue = input.value.replace(/[^\d]/g, ''); // Remove non-digit characters
    numericValue = numericValue.slice(0, 11); // Limit to 11 digits

    if (numericValue.length === 9) {
      numericValue = numericValue.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3'); // Format as 089.632.259
    } else if (numericValue.length === 11) {
      numericValue = numericValue.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Format as 089.632.259-92
    }

    input.value = numericValue; // Update input value with formatted value
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace') {
      let numericValue = input.value.replace(/[^\d]/g, ''); // Remove non-digit characters
      numericValue = numericValue.slice(0, -1); // Simulate backspace
      input.value = numericValue; // Update input value
      event.preventDefault();
    }
  });
};
