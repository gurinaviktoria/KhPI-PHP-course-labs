<?php
if (isset($_POST['delete_cookie'])) {
    setcookie("username", "", time() - 3600); // видаляємо cookie
    header("Location: index.php");
    exit;
}

if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
    setcookie("username", $username, time() + 7*24*60*60); // cookie на 7 днів
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie Example</title>
</head>
<body>
<?php if (isset($_COOKIE['username'])): ?>
    <h2>Привіт, <?= htmlspecialchars($_COOKIE['username']) ?>!</h2>
    <form method="post">
        <button type="submit" name="delete_cookie">Видалити cookie</button>
    </form>
<?php else: ?>
    <form method="post">
        <label>Ваше ім'я: </label>
        <input type="text" name="username" required>
        <button type="submit">Зберегти</button>
    </form>
<?php endif; ?>
</body>
</html>

