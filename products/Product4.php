<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Product Page</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'header.php' ?>
</head>
<body>
<?php include 'head.php' ?>
    <main>
        <div class="product2">
        <img src="https://i.ibb.co/cXjCvW1/product.png" alt="product-image"> 
            </div>
            <div class="product2">
            <p class="subtitle1">Produkt Loren</p>
            <p class = "Text2">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam</p>
            </div>
            <div class="product2">
            <p class="subtitle1">Preis: XY</p>
            </div>
            <div class="buy">
            <div class="button-container">
        <a href="products.html"></a>
        <button class="button1" onclick="window.location.href = 'http://localhost:8000/form.php?product4';" >Jetzt Kaufen!</button>
            </div>
            </div>
            <div class="button-container1">
        <button class="button" onclick="window.location.href = 'http://localhost:8000/index.php';">Zurück</button>
    </div>
        </div>
        <?php include 'fotter.php' ?>
    </main>
</body>
</html>
