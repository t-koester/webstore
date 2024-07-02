<?php include 'header.php' ?>
<?php include 'head.php' ?>


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
        $product_id = $row["ID"];

        echo "<div class='Product'>";
        echo "<p>$product_name</p>";
        echo "<p>$product_description</p>";
        echo "<p>Price: $product_price</p>";
        echo "<button class='buy-button' data-product-id='$product_id'>Buy</button>";
        echo "</div>";
    }
} else {
    echo "No products found.";
}

// Close the MySQL connection
$conn->close();
?>

<script>
    // Add event listener to the buy buttons
    document.addEventListener("DOMContentLoaded", function() {
        const buyButtons = document.querySelectorAll(".buy-button");
        buyButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                const productId = this.getAttribute("data-product-id");
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "product.php?id=" + productId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.body.innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            });
        });
    });
</script>

<?php include 'fotter.php' ?>ss