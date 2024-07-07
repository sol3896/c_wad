<?php
// Database connection
require_once("dbconnections.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Welcome to SOL TECH SOLUTIONS</h1>
        <?php include_once("templates/nav.php");?>
    </header>

    <main>
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <!-- Static Product Entries -->
                <tr>
                    <td>LCD</td>
                    <td>S1227i</td>
                    <td>Desktop</td>
                </tr>
                <tr>
                    <td>Single processor</td>
                    <td>Dell</td>
                    <td>Notebook</td>
                </tr>
                <tr>
                    <td>Usb port</td>
                    <td>L11H23</td>
                    <td>Keyboard</td>
                </tr>
                <tr>
                    <td>LED</td>
                    <td>I2!g2</td>
                    <td>Monitor</td>
                </tr>
                
                <!-- Dynamic Product Entries -->
                <?php
                // Fetch products from the database
                $fetch_products = "SELECT * FROM products ORDER BY date_added DESC";
                $result = $conn->query($fetch_products);

                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $product['type'] . "</td>";
                        echo "<td>" . $product['model'] . "</td>";
                        echo "<td>" . $product['name'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Featured Products</h2>
        <div class="product-list">
            <!-- Static Featured Products -->
            <div class="product-item">
                <img src="images/cameraHolder.jpg" alt="Camera Holder">
                <h3>Camera Holder - $20,000</h3>
            </div>
            <div class="product-item">
                <img src="images/Canon lens.jpg" alt="Canon Lens">
                <h3>Canon Lens - $55,000</h3>
            </div>
            <div class="product-item">
                <img src="images/Mackbook pro.jpg" alt="Macbook">
                <h3>Macbook - $250,000</h3>
                <div class="reviews">
                    <h4>Customer Reviews</h4>
                    <p>"This Macbook is fantastic! Highly recommend." - Alice</p>
                </div>
            </div>
            <div class="product-item">
                <img src="images/NikonCamera.jpg" alt="Nikon Camera">
                <h3>Nikon Camera - $90,000</h3>
            </div>
            <div class="product-item">
                <img src="images/RecordingCam.jpg" alt="Recording Camera">
                <h3>Recording Camera - $150,000</h3>
            </div>
            <div class="product-item">
                <img src="images/SonyHeadphones.jpg" alt="Sony Headphones">
                <h3>Sony Headphones - $14,000</h3>
            </div>

            <!-- Dynamic Featured Products -->
            <?php
            // Fetch featured products
            $fetch_featured_products = "SELECT * FROM products WHERE is_featured = 1 ORDER BY date_added DESC";
            $result_featured = $conn->query($fetch_featured_products);

            if ($result_featured->num_rows > 0) {
                while ($featured_product = $result_featured->fetch_assoc()) {
                    echo '<div class="product-item">';
                    echo '<img src="' . $featured_product['image_path'] . '" alt="' . $featured_product['name'] . '">';
                    echo '<h3>' . $featured_product['name'] . ' - $' . $featured_product['price'] . '</h3>';
                    echo '<div class="reviews">';
                    echo '<h4>Customer Reviews</h4>';
                    echo '<p>' . $featured_product['description'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No featured products found.</p>";
            }
            ?>
        </div>
    </main>

    <?php include_once("templates/footer.php");?>
</body>
</html>
