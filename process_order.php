<?php
  // Get the form data
  $customer_name = $_POST['customer_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $product = $_POST['product'];
  $quantity = $_POST['quantity'];
  $special_instructions = $_POST['special_instructions'];

  // Create an array to store the form data
  $data = array(
    'customer_name' => $customer_name,
    'email' => $email,
    'phone_number' => $phone_number,
    'address' => $address,
    'product' => $product,
    'quantity' => $quantity,
    'special_instructions' => $special_instructions
  );

  // Get the existing data from the JSON file
  $json_file = 'orders.json';
  if (file_exists($json_file)) {
    $existing_data = json_decode(file_get_contents($json_file), true);
  } else {
    $existing_data = array();
  }

  // Add the new data to the existing data
  $existing_data[] = $data;

  // Encode the data to JSON and save it to the file
  $json_data = json_encode($existing_data, JSON_PRETTY_PRINT);
  file_put_contents($json_file, $json_data);

  // Redirect to a thank-you page
  header("Location: thank_you.php");
  exit();
?>