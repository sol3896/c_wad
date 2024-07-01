<?php
require_once("includes/db_connect.php");
include_once("templates/header.php");
include_once("templates/nav.php");

if(isset($_POST["sign_up"])){
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email_address"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $passphrase = mysqli_real_escape_string($conn, $_POST["passphrase"]);
    $confirm_passphrase = mysqli_real_escape_string($conn, $_POST["confirm_passphrase"]);
    $genderId = mysqli_real_escape_string($conn, $_POST["genderId"]);
    $roleId = mysqli_real_escape_string($conn, $_POST["roleId"]);

    // Email format validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: signup.php?error=wrong_email_format");
        exit();
    }

    // Check authorized email domain
    $allowed_domains = ["strathmore.edu", "gmail.com", "yahoo.com", "outlook.com"];
    $email_domain = substr(strrchr($email, "@"), 1);
    if(!in_array($email_domain, $allowed_domains)){
        header("Location: signup.php?error=unauthorized_email_domain");
        exit();
    }

    // Password and confirm password match
    if($passphrase !== $confirm_passphrase){
        header("Location: signup.php?error=password_mismatch");
        exit();
    }

    // Password length validation
    if(strlen($passphrase) < 8 || strlen($passphrase) > 16){
        header("Location: signup.php?error=password_length");
        exit();
    }

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $check_email_res = $conn->query($check_email);
    if($check_email_res->num_rows > 0){
        header("Location: signup.php?error=email_exists");
        exit();
    }

    // Check if username already exists
    $check_username = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $check_username_res = $conn->query($check_username);
    if($check_username_res->num_rows > 0){
        header("Location: signup.php?error=username_exists");
        exit();
    }

    // Validate full name (only letters, spaces, and quotation symbols)
    if(!preg_match("/^[a-zA-Z\s\'\"]+$/", $fullname)){
        header("Location: signup.php?error=invalid_fullname");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($passphrase, PASSWORD_DEFAULT);

    // Insert user into the database
    $insert_user = "INSERT INTO users (fullname, email, username, password, genderId, roleId) VALUES ('$fullname', '$email', '$username', '$hashed_password', '$genderId', '$roleId')";

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

        <form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="Fn">Fullname:</label><br>
            <input type="text" name="fullname" id="Fn" maxlength="50" placeholder="Fullname" required><br><br>

            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email_address" maxlength="50" placeholder="Email address" required><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "wrong_email_format"){ print "<span class='error_form'>Wrong email format</span>"; } ?>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "unauthorized_email_domain"){ print "<span class='error_form'>Unauthorized email domain</span>"; } ?>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "email_exists"){ print "<span class='error_form'>Email already exists</span>"; } ?>
            <br>

            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" maxlength="50" placeholder="Username" required><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "username_exists"){ print "<span class='error_form'>Username already exists</span>"; } ?>
            <br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="passphrase" placeholder="Password" required><br><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "password_length"){ print "<span class='error_form'>Password must be between 8 and 16 characters</span>"; } ?>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_passphrase" placeholder="Confirm Password" required><br>
            <?php if(isset($_GET["error"]) && $_GET["error"] == "password_mismatch"){ print "<span class='error_form'>Passwords do not match</span>"; } ?>
            <br>

            <label for="genderId">Gender:</label><br>
            <select name="genderId" id="genderId" required>
                <option value="">--Select Gender--</option>
                <?php
                $sel_gen = "SELECT * FROM `gender` ORDER BY gender ASC";
                $sel_gen_res = $conn->query($sel_gen);
                while($sel_gen_row = $sel_gen_res->fetch_assoc()) {
                ?>
                    <option value="<?php print $sel_gen_row["genderId"]; ?>"><?php print $sel_gen_row["gender"]; ?></option>
                <?php } ?>
            </select>
            <br>

            <label for="roleId">Role:</label><br>
            <select name="roleId" id="roleId" required>
                <option value="">--Select Role--</option>
                <?php
                $sel_rol = "SELECT * FROM `roles` ORDER BY role ASC";
                $sel_rol_res = $conn->query($sel_rol);
                while($sel_rol_row = $sel_rol_res->fetch_assoc()) {
                ?>
                    <option value="<?php print $sel_rol_row["roleId"]; ?>"><?php print $sel_rol_row["role"]; ?></option>
                <?php } ?>
            </select>
            <br><br>
            <input type="submit" name="sign_up" value="Sign Up">
        </form>
        <p>Already have an account? <a href="signin.html">Sign In</a></p>
        <p>Return to <a href="index.html">Home</a></p>
    </div>
</body>
</html>
