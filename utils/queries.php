<?php

// Function to get admin credentials from the database
function getAdminCredentials($conn) {
    $sql = "SELECT * FROM admin_users";
    $result = $conn->query($sql);
    $admin_credentials = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $admin_credentials[] = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            );
        }
    }
    return $admin_credentials;
}

// Function to authenticate admin login
function authenticateAdminLogin($username, $password, $conn) {
    $admin_credentials = getAdminCredentials($conn);
    foreach ($admin_credentials as $credential) {
        if ($credential['username'] == $username && $credential['password'] == $password) {
            return true;
        }
    }
    return false;
}

// Function to create a new product
function createProduct($name, $description, $price, $conn) {
    $sql = "INSERT INTO products (name, description, price) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $description, $price);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a product
function deleteProduct($id, $conn) {
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
