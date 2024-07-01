<?php
require_once("dbconnections.php");

if (isset($_POST["sign_up"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=wrong_email_format");
        exit();
    }

    // Validate password and confirm password match
    if ($password !== $confirm_password) {
        header("Location: signup.php?error=password_mismatch");
        exit();
    }

    // Validate password length (between 8 and 16 characters)
    if (strlen($password) < 8 || strlen($password) > 16) {
        header("Location: signup.php?error=password_length");
        exit();
    }

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $check_email_res = $conn->query($check_email);
    if ($check_email_res->num_rows > 0) {
        header("Location: signup.php?error=email_exists");
        exit();
    }

    // Check if username already exists
    $check_username = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $check_username_res = $conn->query($check_username);
    if ($check_username_res->num_rows > 0) {
        header("Location: signup.php?error=username_exists");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $insert_user = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($insert_user) === TRUE) {
        header("Location: view_users.php");
        exit();
    } else {
        echo "Error: " . $insert_user . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
    </header>
    <div class="container">
        <h1>Join us today!</h1>
        <h1>Sign Up</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" maxlength="50" placeholder="Username" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" maxlength="50" placeholder="Email address" required><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "wrong_email_format"){ echo "<span class='error_form'>Wrong email format</span>"; } ?>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "email_exists"){ echo "<span class='error_form'>Email already exists</span>"; } ?>
            <br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "password_length"){ echo "<span class='error_form'>Password must be between 8 and 16 characters</span>"; } ?>
            <br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "password_mismatch"){ echo "<span class='error_form'>Passwords do not match</span>"; } ?>
            <br><br>

            <input type="submit" name="sign_up" value="Sign Up">
        </form>
        <p>Already have an account? <a href="signin.html">Sign In</a></p>
        <p>Return to <a href="index.html">Home</a></p>
    </div>
</body>
</html>

