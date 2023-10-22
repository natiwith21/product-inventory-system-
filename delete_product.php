<?php
// delete_product.php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Retrieve the product ID from the request
  $id = $_GET['id'];

  // Connect to the MySQL database
  $conn = new mysqli('localhost', 'root', '', 'product_inventory');

  // Prepare and execute the SQL query to delete the product
  $stmt = $conn->prepare('DELETE FROM products WHERE id = ?');
  $stmt->bind_param('i', $id);
  $stmt->execute();

  // Close the database connection
  $stmt->close();
  $conn->close();

  // Redirect back to the product list page
  header('Location: product_list.php');
  exit();
}