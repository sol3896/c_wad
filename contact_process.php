<?php
require_once("dbconnections.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate form data
    if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query
    $query = "INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)";

    // Initialize prepared statement
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        $stmt->bind_param("ssss", $fullname, $email, $subject, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Your message has been sent successfully.";
        } else {
            if ($stmt->errno == 1062) {
                echo "A message with this email already exists.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

