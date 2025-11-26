<?php

// шлях до файлу кешу
$cacheFile = "cache/report.html";

// час життя кешу у секундах (10 хв)
$cacheTime = 600;

if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
    // файл існує і ще не прострочений то повертаємо його одразу
    echo file_get_contents($cacheFile);
    exit;
}

sleep(3); // 3 секунди в перший раз вантажиться

// генеруємо HTML таблицю з 1000 рядків з рандомними значеннями
$html = "<h2>Генерований звіт</h2><table border='1' cellpadding='5'>";
for ($i = 0; $i < 1000; $i++) {
    $html .= "<tr>
                <td>Рядок #$i</td>
                <td>" . rand(100, 999) . "</td>
                <td>" . date("Y-m-d") . "</td>
              </tr>";
}
$html .= "</table>";

//створюємо парку якщо вона не створена
if (!is_dir('cache')) {
    // mkdir(шлях, права доступу, рекурсивне створення)
    mkdir('cache', 0777, true);
}

// збереження HTML-звіту у файл кешу
file_put_contents($cacheFile, $html);
//виводить звіт у браузер
echo $html;

?>
