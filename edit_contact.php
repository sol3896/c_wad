<?php
require_once("dbconnections.php"); // Ensure this is the correct path to your database connection file

// Retrieve the specific message ID from the GET request
$messageId = mysqli_real_escape_string($conn, $_GET["id"]);

// Select the message to be edited
$spot_msg = "SELECT * FROM `contact_us` WHERE id = '$messageId' LIMIT 1";
$spot_msg_res = $conn->query($spot_msg);
$spot_msg_row = $spot_msg_res->fetch_assoc();

// Check if the form is submitted
if (isset($_POST["update_message"])) {
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $text_message = mysqli_real_escape_string($conn, $_POST["message"]);
    $messageId = mysqli_real_escape_string($conn, $_POST["id"]);

    // Update the message in the database
    $update_message = "UPDATE contact_us SET name = '$fullname', email = '$email', message = '$text_message' WHERE id = '$messageId' LIMIT 1";

    if ($conn->query($update_message) === TRUE) {
        header("Location: view_messages.php");
        exit();
    } else {
        echo "Error: " . $update_message . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact Us Message - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo" class="logo">
        <h1>Update Contact Us Message</h1>
        <?php include_once("templates/nav.php"); ?>
    </header>

    <main>
        <div class="content">
            <h2>Update Contact Us Message</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form">
                <label for="fn">Full Name:</label>
                <input type="text" name="fullname" id="fn" placeholder="Full Name" required value="<?php echo $spot_msg_row['name']; ?>">

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Email Address" required value="<?php echo $spot_msg_row['email']; ?>">

                <label for="ms">Message:</label>
                <textarea cols="30" rows="7" name="message" id="ms" placeholder="Your Message" required><?php echo $spot_msg_row['message']; ?></textarea>

                <input type="submit" name="update_message" value="Update Message">
                <input type="hidden" name="id" value="<?php echo $spot_msg_row['id']; ?>">
            </form>
        </div>
    </main>

    <?php include_once("templates/footer.php"); ?>
</body>
</html>
