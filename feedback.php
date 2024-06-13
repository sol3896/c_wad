<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo" class="logo">
        <h1>Welcome to SOL TECH SOLUTIONS</h1>
        <?php include_once("templates/nav.php");?>

    </header>

    <main>
        <section class="contact-form">
            <h2>Contact Us</h2>
            <form action="#" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                
                <input type="submit" value="Submit">
            </form>
        </section>
    </main>

    <?php include_once("templates/footer.php");?>

</body>
</html>
