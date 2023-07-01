<?php
function get_room_price($request) {
  // Retrieve the required data from the request
  $hotel = $request['hotel'];
  $checkin = $request['checkin'];
  $checkout = $request['checkout'];
  $adults = $request['adults'];
  $children = $request['children'];
  $childAge1 = $request['child_age_1'];
  $childAge2 = $request['child_age_2'];
  $rooms = $request['rooms'];

  // Generate the URL
  $url = generateURL($hotel, $checkin, $checkout, $adults, $children, $childAge1, $childAge2);

  // Get the price values from the URL
  $startDate = '2023-08-03';
  $endDate = '2023-08-09';
  $priceValues = getPriceValues($url, $startDate, $endDate);

  $totalPrice = calculateTotalPrice($priceValues, 1);

  // Create an associative array with the price values
  $data = array('total_price' => $totalPrice);

  // Convert the array to JSON
  $jsonData = json_encode($data);

  // Return the JSON response
  return rest_ensure_response($jsonData);
}

// Function to generate the URL
function generateURL($hotel, $checkin, $checkout, $adults, $children, $childAge1, $childAge2) {
  $baseURL = 'https://74eubmkfx45x2cethdv23m6usm0jypcu.lambda-url.us-east-1.on.aws/';
  $url = $baseURL . "?hotel=$hotel&checkin=$checkin&checkout=$checkout&adults=$adults&children=$children&child_age_1=$childAge1&child_age_2=$childAge2";

  return $url;
}

// Function to get the price values from the URL
function getPriceValues($url, $startDate, $endDate) {
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

function calculateTotalPrice($priceValues, $numberOfRooms) {
  $total = 0;
  foreach ($priceValues as $price) {
    $total += $price * $numberOfRooms;
  }
  return $total;
}


function register_api_routes() {
    register_rest_route('lista-quartos-plugin/v1', '/get-room-price', array(
        'methods' => 'POST',
        'callback' => 'get_room_price',
    ));
}

add_action('rest_api_init', 'register_api_routes');
