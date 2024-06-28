<?php include 'head.php'; ?>
<?php include 'header.php'; ?>

<form action="process_order.php" method="post" class="form">
  <label>Dein Name:</label>
  <input type="text" name="customer_name" value="<?php echo isset($customer_name) ? $customer_name : ''; ?>" class="form-input"><br>
  <label>E-mail:</label>
  <input type="email" required name="email" value="<?php echo isset($email) ? $email : ''; ?>" class="form-input"><br>
  <label>Handy Number:</label>
  <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" class="form-input"><br>
  <label>Addresse:</label>
  <textarea name="address" rows="5" cols="40" class="form-input"><?php echo isset($address) ? $address : ''; ?></textarea><br>
  <label>Produkt:</label>
  <select name="product" class="form-input">
    <option value="Product A" <?php if (isset($product) && $product == 'Product A') echo 'selected'; ?>>Product A</option>
    <option value="Product B" <?php if (isset($product) && $product == 'Product B') echo 'selected'; ?>>Product B</option>
    <option value="Product C" <?php if (isset($product) && $product == 'Product C') echo 'selected'; ?>>Product C</option>
  </select><br>
  <label>Menge:</label>
  <input type="number" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>" class="form-input"><br>
  <label>Sonderwünsche:</label>
  <textarea name="special_instructions" rows="5" cols="40" class="form-input"><?php echo isset($special_instructions) ? $special_instructions : ''; ?></textarea><br>
  <input type="submit" value="Place Order" class="form-submit">
</form>

<?php include 'footer.php'; ?>