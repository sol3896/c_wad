<?php require_once("dbconnections.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo" class="logo">
        <h1>Contact Us</h1>
        <?php include_once("templates/nav.php");?>

    </header>

    <main>
        <section class="contact-info">
            <h2>Contact Information</h2>
            <p>Feel free to reach out to us through the following channels:</p>
            <ul>
                <li>Email: info@soltech.com</li>
                <li>Phone: +2545633798</li>
                <li>Address: 4667 Ngong Road, Nairobi, Nairobi</li>
            </ul>
        </section>

        <section class="contact-form">
            <h2>Contact Form</h2>
            <form action="dbconnections.php" method="POST" class="form">
                <label for="fn">Full Name:</label>
                <input type="text" id="fn" name="fullname" placeholder="Full Name">

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Email Address">

                <label for="sb">Subject:</label>
                <select name="subject" id="sb">
                    <option value="">--- Select Subject ---</option>
                    <option value="1">Email Support</option>
                    <option value="2">Inquiries</option>
                    <option value="3">Purchases and Returns</option>
                </select>

                <label for="ms">Message:</label>
                <textarea cols="30" rows="7" name="message" id="ms" placeholder="Your Message"></textarea>

                <input type="submit" value="Send Message">
            </form>
        </section>

        <section class="faq">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <h3>How can I contact support?</h3>
                <p>You can reach us via email at support@soltech.com or call us at +2545633798.</p>
            </div>
        </section>
        
        <img src="images/contact.jpg" alt="Contact Us" class="contact-image">
    </main>
    <?php include_once("templates/footer.php");?>

</body>
</html>
