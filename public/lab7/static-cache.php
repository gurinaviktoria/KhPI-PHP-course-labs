<?php
// Клас зі статичним кешем (працює тільки в межах одного запуску скрипта)
class StaticCache {
    private static $cached = null; // статична змінна для кешу

    public static function getData() {
        // Якщо кеш вже є — повертаємо його
        if (self::$cached !== null) {
            return [
                'data' => self::$cached,
                'source' => 'статичний кеш'
            ];
        }

        sleep(2); //імітація повільної операції

        // Генерація нових даних
        self::$cached = [
            'random_values' => [
                rand(1, 100),
                rand(1, 100),
                rand(1, 100)
            ],
            'time' => date("H:i:s")
        ];

        return [
            'data' => self::$cached,
            'source' => 'нове значення'
        ];
    }
}

$response = StaticCache::getData(); // отримуємо дані

echo "<h2>Static Cache</h2>";
echo "<pre>";
print_r($response);
echo "</pre>";
?>