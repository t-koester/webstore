<?php
// Start the session
session_start();

// Include the database connection file (assuming it's in the same directory)
require_once 'connection.php';

// Display the form
if (!isset($_POST['submit'])) {
    ?>
    <h1>Create Product</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName"><br><br>
        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription"></textarea><br><br>
        <label for="productPrice">Product Price:</label>
        <input type="number" id="productPrice" name="productPrice"><br><br>
        <input type="submit" name="submit" value="Create Product">
    </form>
    <?php
} else {
    // Get the product data from the POST request
    $product_name = $conn->real_escape_string($_POST['productName']);
    $product_description = $conn->real_escape_string($_POST['productDescription']);
    $product_price = $conn->real_escape_string($_POST['productPrice']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO products (`Name`, `Desc`, `Price`) VALUES (?,?,?)");

    // Bind the parameters
    $stmt->bind_param("ssd", $product_name, $product_description, $product_price);

    // Execute the statement
    $result = $stmt->execute();

    // Check for errors
    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        echo "Product created successfully";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>