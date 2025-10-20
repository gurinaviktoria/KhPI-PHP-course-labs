<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = md5(trim($_POST["password"]));

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Помилка підготовки запиту: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Реєстрація успішна! <a href='login_form.html'>Увійти</a>";
    } else {
        echo "Помилка виконання запиту: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

