<?php
require_once("dbconnections.php");

$id = mysqli_real_escape_string($conn, $_GET["id"]);
$select_feedback = "SELECT * FROM feedback WHERE id = '$id' LIMIT 1";
$result = $conn->query($select_feedback);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    $update_feedback = "UPDATE feedback SET name = '$name', email = '$email', message = '$message' WHERE id='$id' LIMIT 1";
    
    if ($conn->query($update_feedback) === TRUE) {
        header("Location: view_feedback.php");
        exit();
    } else {
        echo "Error: " . $update_feedback . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feedback - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Edit Feedback</h1>
        <?php include_once("templates/nav.php"); ?>
    </header>

    <main>
        <div class="content">
            <h2>Edit Feedback</h2>
            <form action="edit_feedback.php?id=<?php echo $id; ?>" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?php echo $row["name"]; ?>">
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $row["email"]; ?>">
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required><?php echo $row["message"]; ?></textarea>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </main>

    <?php include_once("templates/footer.php"); ?>
</body>
</html>
