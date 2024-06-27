<?php
require 'php/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ваша корзина</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
<style> button {width: 40%; height: 30px; background-color: #8c342c; color: white} </style>

<header>
    <div class="left-side">
        <img src="icon.png" class="logo">
        <a href="main.html"> Гастроном </a>
    </div>

    <div class="right-side">
    <a href="cart.php">Ваша корзина</a>
    <a href="products.php">Товары</a>
        <p class="phone-col"> +7 999 999 99 99</p>
    </div>
    </header>
    <main>


    <h2>Ваша корзина</h2>
    <div id="cart-items">
        <?php
        $stmt = $conn->prepare("SELECT products.id, products.name, products.description, products.price, products.image FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo "<button onclick='removeFromCart(" . $row['id'] . ")'>Удалить</button>";
                echo "</div>";
            }
        } else {
            echo "Ваша корзина пуста.";
        }

        $stmt->close();
        ?>
    </div>


    </main>
    <footer>
        <div class="left-side">
            <img src="icon.png">
            <a href="main.html"> Гастроном </a>
        </div>
    
        <div class="right-side">
            <a href="index2.html">Ваша корзина</a>
            <a href="index3.html">Товары</a>
            <p> +7 999 999 99 99</p>
        </div>
    </footer> 


</body>
</html>
