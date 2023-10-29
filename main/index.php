<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Product Management</h1>
    <form method="POST" action="create_product.php">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>
        <label for="product_price">Product Price:</label>
        <input type="number" name="product_price" id="product_price" required>
        <button type="submit">Create Product</button>
    </form>

    <h2>Delete a Product</h2>
    <form method="POST" action="delete_product.php">
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" id="product_id" required>
        <button type="submit">Delete Product</button>
    </form>

    <h2>Search Products</h2>
    <form method="POST" action="search_products.php">
        <input type="text" name="search" id="searchProduct" placeholder="Search for products...">
        <button type="submit">Search</button>
    </form>

    <ul id="productList">
        <!-- Product list will be displayed here -->

    </ul>
</body>
</html>
