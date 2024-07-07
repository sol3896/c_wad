<?php
// Database connection
require_once("dbconnections.php");

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch product details
    $fetch_product = "SELECT * FROM products WHERE id='$id' LIMIT 1";
    $result = $conn->query($fetch_product);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Update product details
if (isset($_POST['update'])) {
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $update_product = "UPDATE products SET type='$type', model='$model', name='$name', price='$price', image_path='$image_path', description='$description' WHERE id='$id'";

    if ($conn->query($update_product) === TRUE) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Edit Product</h1>
        <?php include_once("templates/nav.php"); ?>
    </header>

    <main>
        <div class="form-container">
            <h2>Edit Product Details</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id; ?>" method="POST">
                <label for="type">Type:</label><br>
                <input type="text" id="type" name="type" value="<?php echo $product['type']; ?>" required><br><br>
                
                <label for="model">Model:</label><br>
                <input type="text" id="model" name="model" value="<?php echo $product['model']; ?>" required><br><br>
                
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br><br>
                
                <label for="price">Price:</label><br>
                <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required><br><br>
                
                <label for="image_path">Image Path:</label><br>
                <input type="text" id="image_path" name="image_path" value="<?php echo $product['image_path']; ?>" required><br><br>
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea><br><br>
                
                <input type="submit" name="update" value="Update Product">
            </form>
        </div>
    </main>

    <?php include_once("templates/footer.php"); ?>
</body>
</html>
