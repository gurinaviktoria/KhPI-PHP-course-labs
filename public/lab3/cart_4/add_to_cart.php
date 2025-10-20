<?php
session_start();
if (isset($_POST['item'])) {
    $item = htmlspecialchars($_POST['item']);
    $_SESSION['cart'][] = $item;

    // Зберігаємо попередні покупки у cookie
    $previous = isset($_COOKIE['previous_cart']) ? json_decode($_COOKIE['previous_cart'], true) : [];
    $previous[] = $item;
    setcookie("previous_cart", json_encode($previous), time() + 30*24*3600); // на 30 днів
}

header("Location: 1index.php");
exit;

