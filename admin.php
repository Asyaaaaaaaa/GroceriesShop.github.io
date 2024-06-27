<?php
require 'php/db.php';
session_start();

// Check if the user is admin, for simplicity, we assume user_id 1 is admin
if ($_SESSION['user_id'] != 1) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="styles2.css">
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


    <h2>Панель администратора</h2>
    <h3 class="admin-h3">Добавление товаров</h3>
    <!-- Add form to add products -->
    <form action="php/admin.php?action=add_product" method="post">
        <label for="name">Название товара:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="description">Описание:</label>
        <textarea id="description" name="description" required></textarea><br>
        
        <label for="price">Цена:</label>
        <input type="number" id="price" name="price" required><br>
        
        <label for="image">URL фотографии:</label>
        <input type="text" id="image" name="image" required><br>
        
        <input type="submit" value="Добавить">
    </form>
    <!-- List all products with options to edit/delete -->
    <div id="products">
        <?php
        $result = $conn->query("SELECT * FROM products");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>Цена: ₽" . $row['price'] . "</p>";
                echo "<form action='php/admin.php?action=delete_product' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Удалить'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>
</body>
</html>
