<?php include 'head.php' ?>
<?php include 'header.php' ?>
<form action="process_order.php" method="post" class="form">
  <label>Customer Name:</label>
  <input type="text" name="customer_name" value="<?php echo $customer_name;?>" class="form-input"><br>
  <label>E-mail:</label>
  <input type="text" name="email" value="<?php echo $email;?>" class="form-input"><br>
  <label>Phone Number:</label>
  <input type="text" name="phone_number" value="<?php echo $phone_number;?>" class="form-input"><br>
  <label>Address:</label>
  <textarea name="address" rows="5" cols="40" class="form-input"><?php echo $address;?></textarea><br>
  <label>Product:</label>
  <select name="product" class="form-input">
    <option value="Product A">Product A</option>
    <option value="Product B">Product B</option>
    <option value="Product C">Product C</option>
  </select><br>
  <label>Quantity:</label>
  <input type="number" name="quantity" value="<?php echo $quantity;?>" class="form-input"><br>
  <label>Special Instructions:</label>
  <textarea name="special_instructions" rows="5" cols="40" class="form-input"><?php echo $special_instructions;?></textarea><br>
  <input type="submit" value="Place Order" class="form-submit">
</form>

<?php include 'fotter.php' ?>