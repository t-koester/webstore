<!DOCTYPE html>
<html lang="de">
<?php include 'head.php' ?>
<body>
    <?php include 'header.php' ?>
<main>
    <div class="content-box">
        <p class="subtitle">Dein Ansprechpatner im Bereich XY</p>
        <p class = "Text1">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam</p>
    </div>
    <div class="button-container">
        <a href="products.html"></a>
        <button class="button" onclick="window.location.href = 'products.php';" >Zum Shop</button>
    </a>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="counter-box">
  <span class="counter">0</span>
  <span class="label-costumers">Happy Customers</span>
</div>
    </div>
    <?php include 'fotter.php' ?>

    <script>
  let counter = 0;
  const counterElement = document.querySelector('.counter');

  setInterval(() => {
    counterElement.textContent = counter;
    if (counter < 999) {
      counter++;
    }
  }, 5);
</script>
</body>
</html>
