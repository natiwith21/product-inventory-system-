<?php
// create_product.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the product details from the request
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];

  // Connect to the MySQL database
  $conn = new mysqli('localhost', 'root', '', 'product_inventory');

  // Prepare and execute the SQL query to insert a new product
  $stmt = $conn->prepare('INSERT INTO products (name, description, price, quantity) VALUES (?, ?, ?, ?)');
  $stmt->bind_param('ssdi', $name, $description, $price, $quantity);
  $stmt->execute();

  // Close the database connection
  $stmt->close();
  $conn->close();

  // Redirect back to the product list page
  header('Location: product_list.php');
  exit();
}
?>

<!-- HTML form for creating a new product -->
<form action="create_product.php" method="POST">
  <label for="name">Product Name:</label>
  <input type="text" name="name" required>

  <label for="description">Description:</label>
  <textarea name="description" required></textarea>

  <label for="price">Price:</label>
  <input type="number" name="price" step="0.01" required>

  <label for="quantity">Quantity in Stock:</label>
  <input type="number" name="quantity" required>

  <button type="submit">Create Product</button>
</form>