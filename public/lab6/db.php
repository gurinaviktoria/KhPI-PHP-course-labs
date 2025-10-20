<?php
$host = 'mysql';
$user = 'started-user';
$password = 'started-password';
$dbname = 'started';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}
?>




