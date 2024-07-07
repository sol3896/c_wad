<?php
// Database connection
require_once("dbconnections.php");

// Delete a record if DelId is set
if (isset($_GET["DelId"])) {
    $DelId = mysqli_real_escape_string($conn, $_GET["DelId"]);
    
    // SQL to delete a record
    $del_user = "DELETE FROM `users` WHERE id='$DelId' LIMIT 1";
    
    if ($conn->query($del_user) === TRUE) {
        header("Location: view_users.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Registered Users</h1>
        <?php include_once("templates/nav.php");?>
    </header>

    <main>
        <div class="content">
            <h2>Registered Users</h2>
            <p>Below are the registered users in the system.</p>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
$select_users = "SELECT * FROM `users` ORDER BY id DESC";
$sel_users_res = $conn->query($select_users);
$sn = 0;
if ($sel_users_res->num_rows > 0) {
    // Output data of each row
    while ($sel_users_row = $sel_users_res->fetch_assoc()) {
        $sn++;
?>
                    <tr>
                        <td><?php echo $sn; ?>.</td>
                        <td><?php echo $sel_users_row["username"]; ?></td>
                        <td><?php echo $sel_users_row["email"]; ?></td>
                        <td>[ <a href="edit_user.php?id=<?php echo $sel_users_row["id"]; ?>">Edit</a> ] [ <a href="?DelId=<?php echo $sel_users_row["id"]; ?>">Del</a> ]</td>
                    </tr>
<?php
    }
} else {
    echo "<tr><td colspan='4'>No results found.</td></tr>";
}
?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once("templates/footer.php");?>
</body>
</html>
