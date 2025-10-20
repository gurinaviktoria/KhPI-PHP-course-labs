<?php
declare(strict_types=1);

$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
$maxSize   = 2 * 1024 * 1024; //2МБ
$allowedExt = ['png', 'jpg', 'jpeg'];
$allowedMime = ['image/png', 'image/jpeg'];

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}


//правильне ім'я файлу
function sanitize_filename(string $name): string {
    $name = basename($name);
    $name = preg_replace('/\s+/u', '_', $name);
    $name = preg_replace('/[^\p{L}\p{N}._-]+/u', '_', $name);
    return mb_substr($name, 0, 200);
}

$notice = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $notice = 'Файл не надіслано.';
} elseif (!isset($_FILES['file'])) {
    $notice = 'Файл не знайдено у запиті.';
} else {
    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $notice = 'Помилка завантаження (код ' . (int)$file['error'] . ').';
    } elseif (!is_uploaded_file($file['tmp_name'])) {
        $notice = 'Файл не є завантаженим через HTTP POST.';
    } elseif ($file['size'] > $maxSize) {
        $notice = 'Файл занадто великий. Максимум 2 МБ.';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $origNameRaw = $file['name'];
        $origName = sanitize_filename($origNameRaw);
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt, true) || !in_array($mime, $allowedMime, true)) {
            $notice = 'Дозволено лише зображення PNG або JPG/JPEG.';
        } else {
            // унікальне ім'я якщо вже існує
            $targetName = $origName;
            $targetPath = $uploadDir . DIRECTORY_SEPARATOR . $targetName;
            if (file_exists($targetPath)) {
                $nameOnly = pathinfo($origName, PATHINFO_FILENAME);
                $suffix   = date('Ymd_His') . '_' . substr(bin2hex(random_bytes(3)), 0, 6);
                $targetName = $nameOnly . '__' . $suffix . '.' . $ext;
                $targetPath = $uploadDir . DIRECTORY_SEPARATOR . $targetName;
            }

            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                $notice = 'Не вдалося зберегти файл на сервері.';
            } else {
                // Успішно
                $sizeKB = number_format(filesize($targetPath) / 1024, 2, '.', ' ');
                $downloadHref = 'uploads/' . rawurlencode($targetName);
                // Показати результат — виведемо HTML нижче
                $saved = [
                    'orig' => $origNameRaw,
                    'saved' => $targetName,
                    'mime' => $mime,
                    'sizeKB' => $sizeKB,
                    'href' => $downloadHref
                ];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Результат завантаження</title>
    <style>
        body { font-family: sans-serif; max-width: 720px; margin: 32px auto; }
        .ok { color: #0a7d32; }
        .err { color: #c62828; }
        a { color: #1976d2; }
    </style>
</head>
<body>
<h1>Результат завантаження</h1>

<?php if (!empty($notice)): ?>
    <p class="err"><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?></p>
<?php elseif (!empty($saved)): ?>
    <p class="ok"><strong>Файл завантажено</strong></p>
    <ul>
        <li>Оригінальне імʼя: <?= htmlspecialchars($saved['orig'], ENT_QUOTES, 'UTF-8') ?></li>
        <li>Збережене імʼя: <?= htmlspecialchars($saved['saved'], ENT_QUOTES, 'UTF-8') ?></li>
        <li>MIME-тип: <?= htmlspecialchars($saved['mime'], ENT_QUOTES, 'UTF-8') ?></li>
        <li>Розмір: <?= htmlspecialchars($saved['sizeKB'], ENT_QUOTES, 'UTF-8') ?> КБ</li>
    </ul>
    <p><a href="<?= $saved['href'] ?>" download>Завантажити файл</a></p>
<?php else: ?>
    <p class="err">Невідома помилка.</p>
<?php endif; ?>

<p><a href="index.html">← Повернутися</a> • <a href="list.php">Список файлів</a></p>
</body>
</html>
