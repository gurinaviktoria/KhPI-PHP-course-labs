<?php
session_start(); // запускаємо сесію

//Перевіряємо, чи є дані та час у кеші
if (isset($_SESSION['cached_data']) && isset($_SESSION['cached_time'])) {

    $age = time() - $_SESSION['cached_time']; // скільки часу минуло з моменту кешування

    if ($age < 600) { // якщо не більше 10 хвилин
        $data = $_SESSION['cached_data']; //беремо дані з кешу
        $source = 'з кешу сесії';
    } else {
        $data = generateData(); // генеруємо нові дані
        $_SESSION['cached_data'] = $data;   // записуємо в кеш
        $_SESSION['cached_time'] = time();  // оновлюємо час
        $source = 'оновлено кеш';
    }

} else {

    $data = generateData(); // створюємо дані вперше
    $_SESSION['cached_data'] = $data; // кладемо в сесію
    $_SESSION['cached_time'] = time(); // записуємо час
    $source = 'створено новий кеш';

}

//функція генерації даних(затримує завантаження на 2 сек)
function generateData() {
    sleep(2); // затримка 2 секунди
    return [
        'usd' => rand(35, 40),
        'eur' => rand(38, 43)
    ];
}

//вивід інформації
echo "<h2>Кешування у сесії</h2>";
echo "<p><b>Дані:</b> " . json_encode($data) . "</p>";
echo "<p><b>Джерело:</b> $source</p>";
echo "<p><b>Час кешування:</b> " . date("H:i:s", $_SESSION['cached_time']) . "</p>";
?>