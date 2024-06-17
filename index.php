<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOL TECH SOLUTIONS - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Welcome to SOL TECH SOLUTIONS</h1>
        <?php include_once("templates/nav.php");?>

    </header>

    <main>
        <section class="about">
            <h2>About Us</h2>
            <p>Welcome to SOL TECH SOLUTIONS, where we strive to deliver excellence in every service we provide.</p>
            <a href="about.html" class="btn">Learn More</a>
        </section>
        <section class="featured-services">
            <h2>Our Featured Services</h2>
            <div class="service-item">
                <img src="images/webDev.jpg" alt="Web Development">
                <h3>Web Development</h3>
                <p>Creating responsive and engaging websites.</p>
            </div>
            <div class="service-item">
                <img src="images/mobileDev.jpg" alt="Mobile App Development">
                <h3>Mobile App Development</h3>
                <p>Building user-friendly mobile applications.</p>
            </div>
        </section>
        <section class="testimonials">
            <h2>What Our Clients Say</h2>
            <div class="testimonial">
                <p>"SOL TECH SOLUTIONS transformed our business with their exceptional web development services!"</p>
                <h3>- Jane Doe, CEO of DoeCorp</h3>
            </div>
        </section>
        <section class="latest-news">
            <h2>Latest News</h2>
            <article>
                <h3>New Service Launch</h3>
                <p>We are excited to announce the launch of our new mobile app development service.</p>
                <a href="services.html" class="btn">Learn More</a>
            </article>
        </section>
        
        <section class="our-team">
            <h2>Our Team</h2>
            <p>We have a talented team of professionals dedicated to excellence.</p>
            <img src="images/groupPhoto.jpg" alt="Our Team" class="team-photo">
        </section>
        <section class="newsletter">
            <h2>Subscribe to Our Newsletter</h2>
            <form>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Subscribe</button>
            </form>
        </section>
    </main>

    <?php include_once("templates/footer.php");?>
 
</body>
</html>
