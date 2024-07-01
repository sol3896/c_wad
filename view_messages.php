<?php
// Database connection
require_once("dbconnections.php");

// Delete a record if DelId is set
if (isset($_GET["DelId"])) {
    $DelId = mysqli_real_escape_string($conn, $_GET["DelId"]);
    
    // SQL to delete a record
    $del_msg = "DELETE FROM `contact_us` WHERE id='$DelId' LIMIT 1";
    
    if ($conn->query($del_msg) === TRUE) {
        header("Location: view_messages.php");
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
    <title>Contact Us Messages - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Contact Us Messages</h1>
        <?php include_once("templates/nav.php");?>
    </header>

    <main>
        <div class="content">
            <h2>Contact Us Messages</h2>
            <p>Below are the messages received via the contact form.</p>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
$select_msg = "SELECT * FROM `contact_us` ORDER BY date_created DESC";
$sel_msg_res = $conn->query($select_msg);
$cm = 0;
if ($sel_msg_res->num_rows > 0) {
    // Output data of each row
    while ($sel_msg_row = $sel_msg_res->fetch_assoc()) {
        $cm++;
?>
                    <tr>
                        <td><?php echo $cm; ?>.</td>
                        <td><?php echo $sel_msg_row["name"]; ?></td>
                        <td><?php echo $sel_msg_row["email"]; ?></td>
                        <td><?php echo substr($sel_msg_row["message"], 0, 50) . '...'; ?></td>
                        <td><?php echo date("d-M-Y H:i", strtotime($sel_msg_row["date_created"])); ?></td>
                        <td>[ <a href="edit_contact.php?id=<?php echo $sel_msg_row["id"]; ?>">Edit</a> ] [ <a href="?DelId=<?php echo $sel_msg_row["id"]; ?>">Del</a> ]</td>
                    </tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>No results found.</td></tr>";
}
?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once("templates/footer.php");?>

</body>
</html>
