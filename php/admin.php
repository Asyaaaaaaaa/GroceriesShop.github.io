<?php
require 'db.php';
session_start();

if ($_SESSION['user_id'] != 1) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_GET['action'];

    if ($action == 'add_product') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_POST['image'];

        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $description, $price, $image);

        if ($stmt->execute()) {
            header("Location: ../admin.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif ($action == 'delete_product') {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: ../admin.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
