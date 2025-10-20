<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login_form.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вітаємо</title>
</head>
<body>
<h2>Ласкаво просимо, <?php echo $_SESSION["username"]; ?>!</h2>
<a href="logout.php">Вийти</a>
</body>
</html>

