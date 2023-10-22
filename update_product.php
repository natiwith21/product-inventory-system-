<?php
// update_product.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the product details from the request
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $available = isset($_POST['available']) ? 1 : 0;

  // Connect to the MySQL database
  $conn = new mysqli('localhost', 'root', '', 'product_inventory');

  // Prepare and execute the SQL query to update the product
  $stmt = $conn->prepare('UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, available = ? WHERE id = ?');
  $stmt->bind_param('ssdiis', $name, $description, $price, $quantity, $available, $id);
  $stmt->execute();

  // Close the database connection
  $stmt->close();
  $conn->close();

  // Redirect back to the product list page
  header('Location: product_list.php');
  exit();
}
?>

<!-- HTML form for updating a product -->
<form action="update_product.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

  <label for="name">Product Name:</label>
  <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

  <label for="description">Description:</label>
  <textarea name="description" required><?php echo $product['description']; ?></textarea>

  <label for="price">Price:</label>
  <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

  <label for="quantity">Quantity in Stock:</label>
  <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>

  <label for="available">Available:</label>
  <input type="checkbox" name="available" <?php if ($product['available']) echo 'checked'; ?>>

  <button type="submit">Update Product</button>
</form>