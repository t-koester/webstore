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

// Get the product ID from the URL
$product_id = $_GET['product_id'];

// Query to fetch all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Create a dropdown menu with all products
$products = [];
while($row = $result->fetch_assoc()) {
    $products[] = [$row["ID"], $row["Name"]];
}

// Query to fetch product information from the database
$sql = "SELECT * FROM products WHERE ID = '$product_id'";
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows > 0) {
    // Fetch the product information
    $row = $result->fetch_assoc();
    $product_name = $row["Name"];
    $product_price = $row["Price"];

    // Create the order form
  ?>
       <?php include 'header.php'?>
       <?php include 'head.php'?>
    <form action="process_order.php" method="post">
        <h2>Order Form</h2>
        <label for="product">Select a product:</label>
        <select id="product" name="product">
            <?php foreach($products as $product) {?>
                <option value="<?php echo $product[1];?>" <?php if($product[0] == $product_id) echo "selected";?>><?php echo $product[1];?></option>
            <?php }?>
        </select>
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
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1">
        <br><br>
        <label for="special_instructions">Special Instructions:</label>
        <textarea id="special_instructions" name="special_instructions"></textarea>
        <br><br>
        <input type="submit" value="Order Now">

<?php include 'footer.php'?>
    </form>

    <?php
} else {
    echo "<p>Product not found.</p>";
}

// Close the MySQL connection
$conn->close();
?>