<?php
// utils
function logMessage($message) {
  $logFile = plugin_dir_path(__FILE__) . "log.txt";
  $logMessage = sprintf("%s: %s\n", date('Y-m-d H:i:s'), $message);
  error_log($logMessage, 3, $logFile);
}


// validators


function validateName($name) {
  if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
    return false;
  }

  if (!(strlen($name) >= 3)) {
    return false;
  }

  return true;
}

function validateLastName($lastName) {
  if (!preg_match('/^[A-Za-z\s]+$/', $lastName)) {
    return false;
  }

  if (!(strlen($lastName) >= 2)) {
    return false;
  }

  return true;
}

function validateEMail($email) {
  $emailPattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';

  return preg_match($emailPattern, $email);
}

function validateCPF($cpf) {
  // Remove non-digit characters from the CPF string
  $cleanedCPF = preg_replace('/\D/', '', $cpf);

  // CPF must have exactly 11 digits
  if (strlen($cleanedCPF) !== 11) {
    return false;
  }

  // Check for repeated digits
  if (preg_match('/^(\d)\1{10}$/', $cleanedCPF)) {
    return false;
  }

  return true;
}

function validateDDD($ddd) {
  return preg_match('/^\d{2,}$/', $ddd);
}

function validatePhoneNumber($phoneNumber) {
  $digitsOnly = preg_replace('/\D/', '', $phoneNumber); // Remove all non-digit characters

  return preg_match('/^\d{8,9}$/', $digitsOnly) && strlen($digitsOnly) >= 8;
}

function validateAddress($address) {
  return preg_match('/^[a-zA-Z0-9\s]+$/', $address);
}

function validateHouseNumber($houseNumber) {
  return preg_match('/\d/', $houseNumber);
}

function validateState($state) {
  return ($state != '');
}

function validateCountry($country) {
  return ($country != '');
}


// api callbacks


function set_room_cookies($request) {
  $hotel = $request['hotel'];
  $checkin = $request['checkin'];
  $checkout = $request['checkout'];
  $adults = $request['adults'];
  $children = $request['children'];
  $childAge1 = $request['child_age_1'];
  $childAge2 = $request['child_age_2'];
  $roomCode = $request['roomcode'];
  $rooms = $request['rooms'];

  setcookie('hotel', $hotel, 0, '/', '', false);
  setcookie('checkin', $checkin, 0, '/', '', false);
  setcookie('checkout', $checkout, 0, '/', '', false);
  setcookie('adults', $adults, 0, '/', '', false);
  setcookie('children', $children, 0, '/', '', false);
  setcookie('childAge1', $childAge1, 0, '/', '', false);
  setcookie('childAge2', $childAge2, 0, '/', '', false);
  setcookie('roomCode', $roomCode, 0, '/', '', false);
  setcookie('rooms', $rooms, 0, '/', '', false);

  $totalPrice = calculateTotalPrice();
  setcookie('displayTotalPrice', $totalPrice, 0, '/', '', false);

  $logMessage = sprintf(
    "set_room_cookies function variables at run time:\n\n
    hotel: %s\n
    checkin: %s\n
    checkout: %s\n
    adults: %s\n
    children: %s\n
    child_age_1: %s\n
    child_age_2: %s\n
    roomCode: %s\n
    rooms: %s\n
    displayTotalPrice: %s\n",
    $hotel, $checkin, $checkout, $adults, $children, $childAge1, $childAge2, $roomCode, $rooms, $totalPrice
  );

  logMessage($logMessage);
}

// Function to create custom URL based on data
function generateURL() {
  $baseURL = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/';
  $hotel = $_COOKIE['hotel'];
  $checkin = $_COOKIE['checkin'];
  $checkout = $_COOKIE['checkout'];
  $adults = $_COOKIE['adults'];
  $children = $_COOKIE['children'];
  $childAge1 = $_COOKIE['childAge1'];
  $childAge2 = $_COOKIE['childAge2'];

  $url = $baseURL . "?hotel=$hotel&checkin=$checkin&checkout=$checkout&adults=$adults&children=$children&child_age_1=$childAge1&child_age_2=$childAge2";


  $logMessage = sprintf(
    "generateURL function variables at run time:\n\n
    url: %s\n",
    $url
  );

  logMessage($logMessage);

  return $url;
}

// Function to get the price values from the URL
function getPriceValues() {
  $url = generateURL();
  $startDate =   $_COOKIE['checkin'];
  $endDate = $_COOKIE['checkout'];

  // Fetch JSON response from the URL
  $jsonResponse = file_get_contents($url);

  // Parse the JSON response into an associative array
  $data = json_decode($jsonResponse, true);

  // Initialize an array to store the price values
  $priceValues = array();

  // Loop through the datePrices in the JSON data
  foreach ($data[0]['rates'][0]['datePrices'] as $datePrice) {
    $date = $datePrice['date'];

    // Check if the date falls within the specified range
    if ($date >= $startDate && $date <= $endDate) {
      $price = $datePrice['price'];

      // Add the price value to the array
      $priceValues[] = $price;
    }
  }

  // Return the array of price values
  return $priceValues;
}

function calculateTotalPrice() {
  $priceValues = getPriceValues();
  $numberOfRooms = $_COOKIE['rooms'];

  $total = 0;
  foreach ($priceValues as $price) {
    $total += $price * $numberOfRooms;
  }


  $logMessage = sprintf(
    "calculateTotalPrice function variables at run time:\n\n
    priceValues: %s\n
    numberOfRooms: %s\n
    total: %s\n",
    $priceValues, $numberOfRooms, $total
  );

  logMessage($logMessage);

  return $total;
}


// personal data form end-points


function set_user_data($request) {
  $firstName = $request['firstName'];
  $lastName = $request['lastName'];
  $email = $request['email'];
  $cpf = $request['cpf'];
  $countryCode = $request['countryCode'];
  $ddd = $request['ddd'];
  $phone = $request['phone'];
  $address = $request['address'];
  $houseNumber = $request['houseNumber'];
  $houseInfo = $request['houseInfo'];
  $country = $request['country'];
  $state = $request['state'];

  $logMessage = sprintf(
    "set_user_data function variables at run time:\n\n
    firstName: %s\n
    lastName: %s\n
    email: %s\n
    cpf: %s\n
    countryCode: %s\n
    ddd: %s\n
    phone: %s\n
    address: %s\n
    houseNumber: %s\n
    houseInfo: %s\n
    country: %s\n
    state: %s\n",
    $firstName, $lastName, $email, $cpf, $countryCode, $ddd, $phone, $address, $houseNumber, $houseInfo, $country, $state
  );

  logMessage($logMessage);

  if (validatePersonalData($request)) {
    setcookie('firstName', $firstName, 0, '/', '', false);
    setcookie('lastName', $lastName, 0, '/', '', false);
    setcookie('email', $email, 0, '/', '', false);
    setcookie('cpf', $cpf, 0, '/', '', false);
    setcookie('countryCode', $countryCode, 0, '/', '', false);
    setcookie('ddd', $ddd, 0, '/', '', false);
    setcookie('phone', $phone, 0, '/', '', false);
    setcookie('address', $address, 0, '/', '', false);
    setcookie('houseNumber', $houseNumber, 0, '/', '', false);
    setcookie('houseInfo', $houseInfo, 0, '/', '', false);
    setcookie('country', $country, 0, '/', '', false);
    setcookie('state', $state, 0, '/', '', false);

    return ['ok' => true];
  } else {
    return ['ok' => false];
  }
}

function validatePersonalData($request) {
  if (!validateName($request['firstName'])) {
    return false;
  }

  if (!validateLastName($request['lastName'])) {
    return false;
  }

  if (!validateEMail($request['email'])) {
    return false;
  }

  if (!validateCPF($request['cpf'])) {
    return false;
  }

  if (!validateDDD($request['ddd'])) {
    return false;
  }

  if (!validatePhoneNumber($request['phone'])) {
    return false;
  }

  if (!validateAddress($request['address'])) {
    return false;
  }

  if (!validateHouseNumber($request['houseNumber'])) {
    return false;
  }

  if (!validateCountry($request['country'])) {
    return false;
  }

  if (!validateState($request['state'])) {
    return false;
  }

  return true;
}


// API endpoints


function register_api_routes() {
    register_rest_route('lista-quartos-plugin/v1', '/get-room-price', array(
        'methods' => 'POST',
        'callback' => 'get_room_price',
    ));


    register_rest_route('lista-quartos-plugin/v1', '/set-room-cookies', array(
        'methods' => 'POST',
        'callback' => 'set_room_cookies',
    ));

    register_rest_route('lista-quartos-plugin/v1', '/get-total-price', array(
        'methods' => 'GET',
        'callback' => 'calculateTotalPrice',
    ));

    register_rest_route('lista-quartos-plugin/v1', '/set-user-data', array(
        'methods' => 'POST',
        'callback' => 'set_user_data',
    ));
}


add_action('rest_api_init', 'register_api_routes');
