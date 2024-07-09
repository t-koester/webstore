<?php
// Configuration for MySQL database
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'webshop_project';

// Create a connection to the MySQL database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Start the session
session_start();

// Get the product ID from the URL
$product_id = $_GET['product_id'];

// Query to fetch product information from the database
$sql = "SELECT * FROM products WHERE ID = '$product_id'";
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows > 0) {
    // Fetch the product information
    $row = $result->fetch_assoc();
    $product_name = $row["Name"];
    $product_description = $row["Desc"];
    $product_price = $row["Price"];

    // Create the product selector
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $product_selector = '<select name="product_id" id="product_id">';
    while ($row = $result->fetch_assoc()) {
        $selected = ($row["ID"] == $product_id) ? ' selected' : '';
        $product_selector .= '<option value="' . $row["ID"] . '"' . $selected . '>' . $row["Name"] . '</option>';
    }
    $product_selector .= '</select>';

    // Create the order form
    ?>
       <?php include 'header.php'?>
       <?php include 'head.php'?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Order Form</h2>
        <label for="product_name">Product Name:</label>
        <p><?php echo $product_name;?></p>
        <br>
        <label for="product_description">Product Description:</label>
        <p><?php echo $product_description;?></p>
        <br>
        <label for="product_price">Product Price:</label>
        <p><?php echo $product_price;?></p>
        <br><br>
        <label for="product_id">Select Product:</label>
        <?php echo $product_selector; ?>
        <br><br>
        <button class="button" type="submit" name="add_product">Add Product</button>
        <br><br>
        <label for="customer_name">Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="phone_number">Telephone:</label>
        <input type="tel" id="phone_number" name="phone_number" required>
        <br><br>
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        <br><br>
        <label for="special_instructions">Special Instructions:</label>
        <textarea id="special_instructions" name="special_instructions"></textarea>
        <br><br>
        <button class="button" type="submit" name="buy_now">Buy Now</button>

<?php include 'footer.php'?>
    </form>

    <?php
} else {
    echo "<p>Product not found.</p>";
}

// Add product to form
if (isset($_POST['add_product'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['products'][] = $product_id;
    header("Location: " . $_SERVER['PHP_SELF'] . "?product_id=" . $product_id);
    exit;
}

// Display the selected products
if (isset($_SESSION['products'])) {
    echo "<h2>Selected Products:</h2>";
    foreach ($_SESSION['products'] as $product_id) {
        $sql = "SELECT * FROM products WHERE ID = '$product_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo "<p>" . $row["Name"] . "</p>";
    }
}

// Buy now functionality
if (isset($_POST['buy_now'])) {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $special_instructions = $_POST['special_instructions'];
}

// Insert customer information into the database
$sql = "INSERT INTO customers (name, email, phone_number, address) VALUES ('$customer_name', '$email', '$phone_number', '$address')";
$conn->query($sql);

// Get the customer ID
$customer_id = $conn->insert_id;

// Insert order information into the database
foreach ($_SESSION['products'] as $product_id) {
    $sql = "INSERT INTO orders (customer_id, product_id, special_instructions) VALUES ('$customer_id', '$product_id', '$special_instructions')";
    $conn->query($sql);
}

// Clear the session
unset($_SESSION['products']);

// Close the MySQL connection
$conn->close();

// Redirect to a success page
header("Location: process_order.php");
exit;