<?php
require_once("dbconnections.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Messages - SOL TECH SOLUTIONS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/SOL TECH SOLUTIONS.png" alt="SolTech Solutions Logo">
        <h1>Feedback Messages</h1>
        <?php include_once("templates/nav.php"); ?>
    </header>

    <main>
        <div class="content">
            <h2>Feedback Messages</h2>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
$select_feedback = "SELECT * FROM feedback ORDER BY datecreated DESC";
$result = $conn->query($select_feedback);
$sn = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sn++;
?>
                    <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo substr($row["message"], 0, 50) . '...'; ?></td>
                        <td><?php echo date("d-M-Y H:i", strtotime($row["datecreated"])); ?></td>
                        <td>
                            [ <a href="edit_feedback.php?id=<?php echo $row["id"]; ?>">Edit</a> ]
                            [ <a href="?DelId=<?php echo $row["id"]; ?>">Delete</a> ]
                        </td>
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

    <?php include_once("templates/footer.php"); ?>
</body>
</html>

<?php
if (isset($_GET["DelId"])) {
    $DelId = mysqli_real_escape_string($conn, $_GET["DelId"]);
    
    $del_feedback = "DELETE FROM feedback WHERE id='$DelId' LIMIT 1";
    
    if ($conn->query($del_feedback) === TRUE) {
        header("Location: view_feedback.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
