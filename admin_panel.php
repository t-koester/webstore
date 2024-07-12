<!-- admin.php -->

<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: authenticate.php');
    exit;
}

// Check if the user is an admin
if ($_SESSION['username'] != 'admin') {
    echo 'Access denied';
    exit;
}

// Include the database connection file
require_once 'connection.php';

// Query the database to get the order overview
$query = "SELECT * FROM costumer_data";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$orders = array();
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <button class="button" onclick="location.href='create_product.php'">Add Product</button>
    <button class="button" onclick="location.href='delete_product.php'">Delete Product</button>
    <br><br>
    <h2>Order Overview</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Date</th>
        </tr>
        <?php foreach ($orders as $order) {?>
            <tr>
                <td><?php echo $order['id'];?></td>
                <td><?php echo $order['customer_name'];?></td>
                <td><?php echo $order['order_date'];?></td>
            </tr>
        <?php }?>
    </table>
    <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
</body>
</html>