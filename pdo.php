<?php

$host="localhost";
$port=3306;
$user="root";
$password="root";
$dbname="webshop_project";

try {
    $dbn = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
    return $dbn ;
} catch (PDOException $e) {
    die( 'Connection failed: ' . $e->getMessage());
}