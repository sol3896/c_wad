<?php
// Database connection
require_once("dbconnections.php");

// Delete a product if DelId is set
if (isset($_GET["DelId"])) {
    $DelId = mysqli_real_escape_string($conn, $_GET["DelId"]);
    
    // SQL to delete a product
    $del_product = "DELETE FROM `products` WHERE id='$DelId' LIMIT 1";
    
    if ($conn->query($del_product) === TRUE) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Insert a new product
if (isset($_POST["submit"])) {
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $image_path = mysqli_real_escape_string($conn, $_POST["image_path"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    $insert_product = "INSERT INTO products (type, model, name, price, image_path, description) VALUES ('$type', '$model', '$name', '$price', '$image_path', '$description')";

    if ($conn->query($insert_product) === TRUE) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "Error: " . $insert_product . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Product List</h1>
        <?php include_once("templates/nav.php"); ?>
    </header>

    <main>
        <div class="content">
            <h2>Product List</h2>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Type</th>
                        <th>Model</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
$select_product = "SELECT * FROM `products` ORDER BY date_added DESC";
$sel_product_res = $conn->query($select_product);
$cm = 0;
if ($sel_product_res->num_rows > 0) {
    // Output data of each row
    while ($sel_product_row = $sel_product_res->fetch_assoc()) {
        $cm++;
?>
                    <tr>
                        <td><?php echo $cm; ?>.</td>
                        <td><?php echo $sel_product_row["type"]; ?></td>
                        <td><?php echo $sel_product_row["model"]; ?></td>
                        <td><?php echo $sel_product_row["name"]; ?></td>
                        <td><?php echo $sel_product_row["price"]; ?></td>
                        <td><img src="<?php echo $sel_product_row["image_path"]; ?>" alt="<?php echo $sel_product_row["name"]; ?>" width="50"></td>
                        <td><?php echo substr($sel_product_row["description"], 0, 50) . '...'; ?></td>
                        <td><?php echo date("d-M-Y H:i", strtotime($sel_product_row["date_added"])); ?></td>
                        <td>[ <a href="edit_product.php?id=<?php echo $sel_product_row["id"]; ?>">Edit</a> ] [ <a href="?DelId=<?php echo $sel_product_row["id"]; ?>">Del</a> ]</td>
                    </tr>
<?php
    }
} else {
    echo "<tr><td colspan='9'>No products found.</td></tr>";
}
?>
                </tbody>
            </table>
        </div>

        <div class="form-container">
            <h2>Add New Product</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="type">Type:</label><br>
                <input type="text" id="type" name="type" required><br><br>
                
                <label for="model">Model:</label><br>
                <input type="text" id="model" name="model" required><br><br>
                
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="price">Price:</label><br>
                <input type="text" id="price" name="price" required><br><br>
                
                <label for="image_path">Image Path:</label><br>
                <input type="text" id="image_path" name="image_path" required><br><br>
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" required></textarea><br><br>
                
                <input type="submit" name="submit" value="Add Product">
            </form>
        </div>
    </main>

    <?php include_once("templates/footer.php"); ?>
</body>
</html>
