<?php
require 'php/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Товары</title>
    <link rel="stylesheet" href="styles2.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>


<header>
    <div class="left-side">
        <img src="icon.png" class="logo">
        <a href="index.html"> Гастроном </a>
    </div>

    <div class="right-side">
    <a href="cart.php">Ваша корзина</a>
    <a href="products.php">Товары</a>
        <p class="phone-col"> +7 999 999 99 99</p>
    </div>
    </header>
    <main>
    <h2>Товары</h2>
    <div id="products">
        <?php
        $result = $conn->query("SELECT * FROM products");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>Цена: $" . $row['price'] . "</p>";
                echo "<button onclick='addToCart(" . $row['id'] . ")'>В корзину</button>";
                echo "</div>";
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>
    <div class="cart" id="cart">
    <a href="cart.php"><img class="cart__image" src="korzina.png">
    <div class="cart__num" id="cart-count">0</div></a>
    </div>


    
</main>
    <footer>
        <div class="left-side">
            <img src="icon.png">
            <a href="index.html"> Гастроном </a>
        </div>
    
        <div class="right-side">
            <a href="index2.html">Оформить карту</a>
            <a href="index3.html">Товары</a>
            <p> +7 999 999 99 99</p>
        </div>
    </footer>  
</body>
</html>
