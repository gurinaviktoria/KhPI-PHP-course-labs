<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $script_name = $_SERVER['PHP_SELF'];
    $request_method = $_SERVER['REQUEST_METHOD'];
    $script_path = __FILE__;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Server Info</title>
    </head>
    <body>
    <h2>Інформація про сервер та запит</h2>
    <p>IP клієнта: <?= $client_ip ?></p>
    <p>Браузер: <?= htmlspecialchars($user_agent) ?></p>
    <p>Назва скрипта: <?= $script_name ?></p>
    <p>Метод запиту: <?= $request_method ?></p>
    <p>Шлях до файлу: <?= $script_path ?></p>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Форма</title>
</head>
<body>
<h2>Отримати інформацію про сервер</h2>
<form method="post">
    <button type="submit">Показати</button>
</form>
</body>
</html>
