<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder - Product Page</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <?php include 'header.php' ?>

    <div class="ProductBar">
        <div class="Product">
            <p>Product 1</p>
            <a href="products/Product1.php" target="_blank">
                <img src="images/product.jpg" alt="Product 1" class="Product1">
            </a>
        </div>
        <div class="Product">
            <p>Product 2</p>
            <a href="products/Product2.php" target="_blank">
                <img src="images/product.jpg" alt="Product 2" class="Product1">
            </a>
        </div>
        <div class="Product">
            <p>Product 3</p>
            <a href="Products/Product1.php" target="_blank">
                <img src="images/product.jpg" alt="Product 3" class="Product1">
            </a>
        </div>
        <div class="Product">
            <p>Product 4</p>
            <a href="products/Product4.php" target="_blank">
                <img src="images/product.jpg" alt="Product 4" class="Product1">
            </a>
        </div>
    </div>

    <div class="button-container1">
        <button class="button" onclick="window.location.href = 'index.php';">Zurück</button>
    </div>
    <?php include 'fotter.php' ?>
</body>
</html>
