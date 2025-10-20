<?php
$logFile = __DIR__ . DIRECTORY_SEPARATOR . 'log.txt';
$notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message'] ?? '');
    if ($message !== '') {
        if (!file_exists($logFile)) {
            touch($logFile);
        }
        $line = '[' . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
        file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
        $notice = 'Записано у log.txt';
    } else {
        $notice = 'Порожній текст — нічого не записано.';
    }
}

$contents = file_exists($logFile) ? file_get_contents($logFile) : '';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>log.txt — перегляд</title>
    <style>
        body { font-family: sans-serif; max-width: 720px; margin: 32px auto; }
        pre { background: #f5f5f5; padding: 12px; border: 1px solid #ddd; white-space: pre-wrap; }
        .ok { color: #0a7d32; }
    </style>
</head>
<body>
<h1>Файл log.txt</h1>
<?php if (!empty($notice)): ?>
    <p class="ok"><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<h3>Вміст:</h3>
<pre><?= htmlspecialchars($contents, ENT_QUOTES, 'UTF-8') ?></pre>

<p><a href="index.html">← Повернутися</a></p>
</body>
</html>
