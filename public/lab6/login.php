<?php
require_once "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = md5(trim($_POST["password"])); // Хешуємо введений пароль

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $passwordFromDb);
        $stmt->fetch();

        if ($password === $passwordFromDb) {
            $_SESSION["user_id"] = $userId;
            $_SESSION["username"] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            echo " Невірний пароль.";
        }
    } else {
        echo " Користувача не знайдено.";
    }

    $stmt->close();
    $conn->close();
}
?>
