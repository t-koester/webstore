<?php
// Include header and head files
include 'header.php';
include 'head.php';

// Include connection to database
include 'connection.php';

// Start the session
session_start();

// Check if the user has submitted the add product form
if (isset($_POST['add_product'])) {
    $product_id = $_POST['add_product'];
    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = array();
    }
    if (!in_array($product_id, $_SESSION['products'])) {
        $_SESSION['products'][] = $product_id;
    }
    // Save product quantity in session
    if (!isset($_SESSION['product_quantities'])) {
        $_SESSION['product_quantities'] = array();
    }
    $_SESSION['product_quantities'][$product_id] = 1;
}

// Check if the user has submitted the remove product form
if (isset($_POST['remove_product'])) {
    $product_id = $_POST['remove_product'];
    if (isset($_SESSION['products'])) {
        $key = array_search($product_id, $_SESSION['products']);
        if ($key!== false) {
            unset($_SESSION['products'][$key]);
            unset($_SESSION['product_quantities'][$product_id]);
        }
    }
}

// Check if the user has submitted the place order form
if (isset($_POST['place_order'])) {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Redirect to process_order page
    header('Location: process_order.php');
    exit;
}

?>

<div class="content-box" style="max-width: 800px; margin: 40px auto; padding: 20px; display: flex; justify-content: space-between;">
    <div style="width: 40%; margin: 20px;">
        <h2 class="subtitle" style="font-size: 18px;">Selected Products:</h2>
        <?php if (isset($_SESSION['products'])):?>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <?php foreach ($_SESSION['products'] as $product_id):?>
                    <?php
                    $sql = "SELECT * FROM products WHERE ID = '$product_id'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                  ?>
                    <li style="padding: 10px; border-bottom: 1px solid #ddd;">
                        <span style="font-size: 14px;"><?php echo $row["Name"];?></span>
                        <span style="font-size: 14px; float: right;"><?php echo $row["Price"];?></span>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" style="float: right; margin-right: 10px;">
                            <input type="hidden" name="remove_product" value="<?php echo $product_id;?>">
                            <button class="button" type="submit" style="padding: 5px 10px; font-size: 12px; background-color: #ff0000; color: #fff;">Remove</button>
                        </form>
                        <!-- Display product quantity -->
                        <span style="font-size: 14px; float: right; margin-right: 10px;">Quantity: <?php echo $_SESSION['product_quantities'][$product_id];?></span>
                    </li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
    </div>
    <div style="width: 40%; margin: 20px;">
        <h2 class="subtitle" style="font-size: 18px;">Select Product:</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label for="add_product" style="font-size: 14px;">Select Product:</label>
            <select name="add_product" style="width: 100%; padding: 10px; font-size: 14px;">
                <?php
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='". $row["ID"]. "'>". $row["Name"]. "</option>";
                }
              ?>
            </select>
            <br><br>
            <button class="button" type="submit" style="padding: 10px 20px; font-size: 12px; background-color: #008000; color: #fff;">Add Product</button>
        </form>
        <?php if (isset($_SESSION['products'])):?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <label for="customer_name" style="font-size: 14px;">Name:</label>
                <input type="text" id="customer_name" name="customer_name" required style="width: 100%; padding: 10px; font-size: 14px;">
                <br><br>
                <label for="email" style="font-size: 14px;">Email:</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; font-size: 14px;">
                <br><br>
                <label for="phone_number" style="font-size: 14px;">Telephone:</label>
                <input type="tel" id="phone_number" name="phone_number" required style="width: 100%; padding: 10px; font-size: 14px;">
                <br><br>
                <label for="address" style="font-size: 14px;">Address:</label>
                <textarea id="address" name="address" required style="width: 100%; padding: 10px; font-size: 14px;"></textarea>
                <br><br>
                <button class="button" type="submit" name="place_order" style="padding: 10px 20px; font-size: 14px; background-color: #008000; color: #fff;">Place Order</button>
            </form>
        <?php endif;?>
    </div>
</div>

<?php
// Include footer file
include 'footer.php';
?>