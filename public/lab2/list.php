<?php
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$files = array_values(array_filter(scandir($uploadDir), function ($f) use ($uploadDir) {
    return $f !== '.' && $f !== '..' && is_file($uploadDir . DIRECTORY_SEPARATOR . $f);
}));
sort($files, SORT_NATURAL | SORT_FLAG_CASE);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список файлів</title>
    <style>
        body { font-family: sans-serif; max-width: 720px; margin: 32px auto; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f2f2f2; text-align: left; }
        a { color: #1976d2; }
    </style>
</head>
<body>
<h1>Список файлів у /uploads</h1>

<?php if (empty($files)): ?>
    <p>Поки що немає завантажених файлів.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Файл</th>
            <th>Розмір (КБ)</th>
            <th>Дія</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($files as $i => $name):
            $path = $uploadDir . DIRECTORY_SEPARATOR . $name;
            $sizeKB = number_format(filesize($path) / 1024, 2, '.', ' ');
            $href = 'uploads/' . rawurlencode($name);
            ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= $sizeKB ?></td>
                <td><a href="<?= $href ?>" download>Завантажити</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p><a href="index.html">← Повернутися</a></p>
</body>
</html>
