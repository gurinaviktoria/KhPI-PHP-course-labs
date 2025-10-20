<?php
session_start();

// Ініціалізація корзини
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Збереження попередніх покупок у cookie
$previous = isset($_COOKIE['previous_cart']) ? json_decode($_COOKIE['previous_cart'], true) : [];
?>

<h2>Корзина покупок</h2>
<form method="post" action="add_to_cart.php">
    <label>Назва товару: </label>
    <input type="text" name="item" required>
    <button type="submit">Додати</button>
</form>

<h3>Поточні товари:</h3>
<ul>
    <?php foreach ($_SESSION['cart'] as $item) echo "<li>$item</li>"; ?>
</ul>

<h3>Попередні покупки:</h3>
<ul>
    <?php foreach ($previous as $item) echo "<li>$item</li>"; ?>
</ul>

