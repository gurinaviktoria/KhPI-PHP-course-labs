<?php
session_start();

// Масив користувачів
$users = [
        'admin' => '1234',
        'user' => 'password'
];

if (isset($_SESSION['user'])) {
    $timeout = 5 * 60;//5 хвилин не активності
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
    $_SESSION['last_activity'] = time();

    echo "<h2>Привіт, {$_SESSION['user']}!</h2>";
    echo '<a href="logout.php">Вихід</a>';
    exit;
}

// Обробка надсилання форми
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$login]) && $users[$login] === $password) {
        $_SESSION['user'] = $login;
        $_SESSION['last_activity'] = time();
        header("Location: index.php");
        exit;
    } else {
        $error = "Неправильний логін або пароль";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login </title>
</head>
<body>
<form method="post">
    <label>Логін: </label><input type="text" name="login" required><br>
    <label>Пароль: </label><input type="password" name="password" required><br>
    <button type="submit">Увійти</button>
</form>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>

