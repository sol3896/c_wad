<?php
require_once("dbconnections.php");

if (isset($_POST["add_product"])) {
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $is_featured = isset($_POST["is_featured"]) ? 1 : 0;

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // Check if file already exists
        if (!file_exists($target_file)) {
            // Check file size (limit to 5MB)
            if ($_FILES["image"]["size"] <= 5000000) {
                // Allow certain file formats
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // File is uploaded, now insert into database
                        $image_path = $target_file;
                        $insert_product = "INSERT INTO products (type, model, name, price, image_path, description, is_featured) VALUES ('$type', '$model', '$name', '$price', '$image_path', '$description', '$is_featured')";

                        if ($conn->query($insert_product) === TRUE) {
                            header("Location: view_products.php");
                            exit();
                        } else {
                            echo "Error: " . $insert_product . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                }
            } else {
                echo "Sorry, your file is too large.";
            }
        } else {
            echo "Sorry, file already exists.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Add New Product</h1>
        <?php include_once("templates/nav.php");?>
    </header>

    <main>
        <h2>Add New Product</h2>
        <form action="edit_product.php" method="POST" enctype="multipart/form-data">
            <label for="type">Type:</label><br>
            <input type="text" id="type" name="type" maxlength="50" required><br><br>

            <label for="model">Model:</label><br>
            <input type="text" id="model" name="model" maxlength="50" required><br><br>

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" maxlength="100" required><br><br>

            <label for="price">Price:</label><br>
            <input type="number" step="0.01" id="price" name="price" required><br><br>

            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

            <label for="is_featured">Featured:</label>
            <input type="checkbox" id="is_featured" name="is_featured"><br><br>

            <input type="submit" name="add_product" value="Add Product">
        </form>
    </main>

    <?php include_once("templates/footer.php");?>
</body>
</html>
