<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO users (full_name, username, password, phone, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $username, $password, $phone, $email);

    if ($stmt->execute()) {
        header("Location: ../login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
