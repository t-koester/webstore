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

// Get the product name from the URL
$product_name = $_GET['name'];

// Query to fetch product information from the database
$sql = "SELECT * FROM products WHERE Name = '$product_name'";
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows > 0) {
    // Fetch the product information
    $row = $result->fetch_assoc();
    $product_name = $row["Name"];
    $product_description = $row["Desc"];
    $product_price = $row["Price"];
    $product_id = $row["ID"];



} else {
    echo "<p>Product not found.</p>";
}

// Close the MySQL connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class = productinfo1>
    <?php include 'header.php'?>

    <div class="Product">
        <?php echo $product_name; ?>
        <?php echo $product_description; ?>
        <?php echo "Price: $product_price"; ?>
    </div>

    <div class="button-container1">
        <form action="form.php?product_id=<?php echo $product_id; ?>" method="post">
            <button class="button" type="submit">Buy Now</button>
        </form>
    </div>
    <?php include 'footer.php'?>
</body>
</html>