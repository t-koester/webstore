<?php include 'head.php' ?>
<?php include 'header.php' ?>
<?php
$welcome = "Hallo";
if (isset ($_POST["peter"])) {
  $welcome .= " ". $_POST[ "peter"];
}
echo $welcome;

$product_selected = 'Product A'; // default product
if (isset($_GET['product1'])) {
  $product_selected = 'Product A';
} elseif (isset($_GET['product2'])) {
  $product_selected = 'Product B';
} elseif (isset($_GET['product3'])) {
  $product_selected = 'Product C';
}

?>
<form action="process_order.php" method="post" class="form">
  <label>Dein Name:</label>
  <input type="text" name="customer_name" value="<?php echo $customer_name;?>" class="form-input"><br>
  <label>E-mail:</label>
  <input type="email" required name="email" value="<?php echo $email;?>" class="form-input"><br>
  <label>Handy Number:</label>
  <input type="text" name="phone_number" value="<?php echo $phone_number;?>" class="form-input"><br>
  <label>Addresse:</label>
  <textarea name="address" rows="5" cols="40" class="form-input"><?php echo $address;?></textarea><br>
  <label>Produkt:</label>
  <select name="product" class="form-input">
    <option value="Product A" <?php if ($product_selected == 'Product A') echo 'selected'; ?>>Product A</option>
    <option value="Product B" <?php if ($product_selected == 'Product B') echo 'selected'; ?>>Product B</option>
    <option value="Product C" <?php if ($product_selected == 'Product C') echo 'selected'; ?>>Product C</option>
  </select><br>
  <label>Menge:</label>
  <input type="number" name="quantity" value="<?php echo $quantity;?>" class="form-input"><br>
  <label>Sonderwünsche:</label>
  <textarea name="special_instructions" rows="5" cols="40" class="form-input"><?php echo $special_instructions;?></textarea><br>
  <input type="submit" value="Place Order" class="form-submit">
</form>

<?php include 'fotter.php' ?>