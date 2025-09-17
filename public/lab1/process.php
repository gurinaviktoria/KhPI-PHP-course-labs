<?php

// Перевірка чи дані отримані, та чи коректно отримані дані
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);

    if (empty($firstName) || empty($lastName)) {
        echo "Будь ласка, заповніть всі поля!";
    } elseif (!is_string($firstName) || !is_string($lastName)) {
        echo "Некоректні дані!";
    } else {
        echo "Привіт, " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "!";
    }
} else {
    echo "Дані не були відправлені!";
}

?>
