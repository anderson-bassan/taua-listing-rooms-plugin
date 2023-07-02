<?php


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

  $logFile = plugin_dir_path(__FILE__) . "log.txt";

  $logMessage = <<<EOT
      set_room_cookies function variables at run time %s :

      hotel:  %s
      checkin: %s
      checkout: %s
      adults: %s
      children: %s
      child_age_1: %s
      child_age_2: %s
      roomCode: %s
      rooms: %s
      displayTotalPrice: %s

    EOT;

  error_log(sprintf($logMessage, date('Y-m-d H:i:s'), $hotel, $checkin, $checkout, $adults, $children, $childAge1, $childAge2, $roomCode, $rooms, $totalPrice), 3, $logFile);
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


  $logFile = plugin_dir_path(__FILE__) . "log.txt";

  $logMessage = <<<EOT
      generateURL function variables at run time %s :

      url:  %s


    EOT;

  error_log(sprintf($logMessage, date('Y-m-d H:i:s'), $url), 3, $logFile);

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


  $logFile = plugin_dir_path(__FILE__) . "log.txt";

  $logMessage = <<<EOT
      calculateTotalPrice function variables at run time %s :

      priceValues:  %s
      numberOfRooms: %s
      total: %s

    EOT;

  error_log(sprintf($logMessage, date('Y-m-d H:i:s'), $priceValues, $numberOfRooms, $total), 3, $logFile);

  return $total;
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
}


add_action('rest_api_init', 'register_api_routes');
