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

// Query to fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if there are any products
if ($result->num_rows > 0) {
    // Display products
    while($row = $result->fetch_assoc()) {
        $product_name = $row["Name"];
        $product_description = $row["Desc"];
        $product_price = $row["Price"];
        $product_id = $row["ID"]; // assuming you have an ID column in your products table

        $product_html = "<a href='productpage.php?name=$product_name'>"; // link to productpage.php with product name
        $product_html.= "<div class='Product'>";
        $product_html.= "<p>$product_name</p>";
        $product_html.= "<p>$product_description</p>";
        $product_html.= "<p>Price: $product_price</p>";
        $product_html.= "</div>";
        $product_html.= "</a>"; // close the link tag

        $products[] = $product_html;
    }
} else {
    $products[] = "<p>No products found.</p>";
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
<body>
    <?php include 'header.php'?>
    <?php include 'head.php'?>

    <div class="Products">
        <?php foreach($products as $product) { echo $product; }?>
    </div>

    <div class="button-container1">
        <button class="button" onclick="window.location.href = 'index.php';">Zurück</button>
    </div>
    <?php include 'footer.php'?>
</body>
</html>