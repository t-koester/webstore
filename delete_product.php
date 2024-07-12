<?php
// Start the session
session_start();

// Include the database connection file (assuming it's in the same directory)
require_once 'connection.php';

// Display the form
if (!isset($_POST['submit'])) {
   ?>
    <h1>Delete Product</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="productId">Select Product:</label>
        <select id="productId" name="productId">
            <?php
            // Query to get all existing products
            $stmt = $conn->prepare("SELECT `Id`, `Name` FROM `products`");
            $stmt->execute();
            $result = $stmt->get_result();

            // Check for errors
            if ($stmt->errno) {
                echo "Error: ". $stmt->error;
            } else {
                // Populate the dropdown menu with product names
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='". $row['Id']. "'>". $row['Name']. "</option>";
                }
            }
           ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Product">
    </form>
    <?php
} else {
    // Get the product ID from the POST request
    $product_id = $conn->real_escape_string($_POST['productId']);

    // Prepare the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM `products` WHERE `Id` =?");

    // Check for errors
    if ($stmt === false) {
        echo "Error: ". $conn->error;
    } else {
        // Bind the parameter
        $stmt->bind_param("i", $product_id);

        // Execute the statement
        $stmt->execute();

        // Check for errors
        if ($stmt->errno) {
            echo "Error: ". $stmt->error;
        } else {
            // Check the number of affected rows
            $affectedRows = $conn->affected_rows;

            if ($affectedRows > 0) {
                echo "Product deleted successfully";
            } else {
                echo "Error: Product not found or deletion failed";
            }
        }
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>