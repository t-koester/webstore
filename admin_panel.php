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

// Start the session
session_start();

// Login credentials
$admin_username = 'admin';
$admin_password = 'password'; // You should store hashed passwords in a secure way

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $logged_in = true;
} else {
    // Check if the login form is submitted
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == $admin_username && $password == $admin_password) {
            // Login successful, set the session variable
            $_SESSION['logged_in'] = true;
            $logged_in = true;
        } else {
            $error = "Invalid username or password";
        }
    }
}

// If not logged in, show the login form
if (!isset($logged_in) || !$logged_in) {
    ?>
    <h1>Admin Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </form>
    <?php
    exit; // Stop executing the script if not logged in
}

// If logged in, show the admin panel
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class="admin-panel">
    <h1>Admin Panel</h1>

    <!-- Create Product Form -->
    <h2>Create Product</h2>
    <form id="create-product-form">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name"><br><br>
        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description"></textarea><br><br>
        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price"><br><br>
        <button id="create-product-btn">Create Product</button>
        <div id="product-create-response"></div>
    </form>

    <!-- Delete Product Form -->
    <h2>Delete Product</h2>
    <form id="delete-product-form">
        <label for="product_name">Select Product:</label>
        <select id="product_name" name="product_name">
            <?php
            $sql = "SELECT Name FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["Name"]."'>".$row["Name"]."</option>";
                }
            }
            ?>
        </select><br><br>
        <button id="delete-product-btn">Delete Product</button>
        <div id="product-delete-response"></div>
    </form>

    <script>
        const createProductForm = document.getElementById('create-product-form');
        const createProductBtn = document.getElementById('create-product-btn');
        const productCreateResponse = document.getElementById('product-create-response');

        createProductBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent page reload

            const productName = document.getElementById('product_name').value;
            const productDescription = document.getElementById('product_description').value;
            const productPrice = document.getElementById('product_price').value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'create_product.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`productName=${productName}&productDescription=${productDescription}&productPrice=${productPrice}`);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    productCreateResponse.innerHTML = 'Product created successfully!';
                } else {
                    productCreateResponse.innerHTML = 'Error creating product: ' xhr.statusText;
                }
            };
        });

        const deleteProductForm = document.getElementById('delete-product-form');
        const deleteProductBtn = document.getElementById('delete-product-btn');
        const productDeleteResponse = document.getElementById('product-delete-response');

        deleteProductBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent page reload

            const productName = document.getElementById('product_name').value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_product.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`productName=${productName}`);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    productDeleteResponse.innerHTML = 'Product deleted successfully!';
                } else {
                    productDeleteResponse.innerHTML = 'Error deleting product: ' xhr.statusText;
                }
            };
        });
    </script>
</body>
</html>