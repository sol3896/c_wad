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
            <tr>
                <th>Type</th>
                <th>Model</th>
                <th>Name</th>
            </tr>
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
        </table>

        <h2>Featured Products</h2>

        <!-- Product Items -->
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
    </main>

    <?php include_once("templates/footer.php");?>

</body>
</html>
