<?php
require_once("dbconnections.php");

if (isset($_POST["sign_up"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Store inputs in session
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "wrong_email_format";
        header("Location: signup.php");
        exit();
    }

    // Validate email domain
    $allowed_domains = ["strathmore.edu", "gmail.com", "yahoo.com"];
    $email_domain = substr(strrchr($email, "@"), 1);
    if (!in_array($email_domain, $allowed_domains)) {
        $_SESSION["error"] = "invalid_email_domain";
        header("Location: signup.php");
        exit();
    }

    // Validate password and confirm password match
    if ($password !== $confirm_password) {
        $_SESSION["error"] = "password_mismatch";
        header("Location: signup.php");
        exit();
    }

    // Validate password length (between 8 and 16 characters)
    if (strlen($password) < 8 || strlen($password) > 16) {
        $_SESSION["error"] = "password_length";
        header("Location: signup.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION["error"] = "email_exists";
        header("Location: signup.php");
        exit();
    }
    $stmt->close();

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION["error"] = "username_exists";
        header("Location: signup.php");
        exit();
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION["success"] = "User registered successfully!";
        session_unset();
        header("Location: view_users.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
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
            <input type="text" id="username" name="username" maxlength="50" placeholder="Username" required value="<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ''; ?>"><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" maxlength="50" placeholder="Email address" required value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ''; ?>"><br>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "wrong_email_format"){ echo "<span class='error_form'>Wrong email format</span>"; unset($_SESSION["error"]); } ?>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "invalid_email_domain"){ echo "<span class='error_form'>Invalid email domain</span>"; unset($_SESSION["error"]); } ?>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "email_exists"){ echo "<span class='error_form'>Email already exists</span>"; unset($_SESSION["error"]); } ?>
            <br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "password_length"){ echo "<span class='error_form'>Password must be between 8 and 16 characters</span>"; unset($_SESSION["error"]); } ?>
            <br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "password_mismatch"){ echo "<span class='error_form'>Passwords do not match</span>"; unset($_SESSION["error"]); } ?>
            <br><br>

            <input type="submit" name="sign_up" value="Sign Up">
        </form>
        <p>Already have an account? <a href="signin.html">Sign In</a></p>
        <p>Return to <a href="index.html">Home</a></p>
    </div>
</body>
</html>
