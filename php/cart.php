<?php
require 'db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'redirect' => '../login.html']);
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = json_decode(file_get_contents('php://input'), true)['product_id'];

$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $product_id);

if ($stmt->execute()) {
    $result = $conn->query("SELECT COUNT(*) as count FROM cart WHERE user_id = $user_id");
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'cart_count' => $row['count']]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
