<?php
// -----------------ЗАВДАННЯ 1-6------------------

//----------Завдання 1---------------
echo "Hello World!<br><br>"; //виводить на екран текст
//<br> для того щоб наступна строка була з нового рядку
//два тега <br>, щоб відділити завдання візуально
//---------Завдання 2--------------

$stringVar = "Змінна string";
$intVar = 28;
$boolVar = true;
$floatVar = 12.679;

echo "Змінні" . "<br>";
echo $stringVar . "<br>";
echo $intVar . "<br>";
echo $boolVar . "<br>";
echo $floatVar . "<br><br>";

echo "Типи змінних" . "<br>";

var_dump($intVar);
echo "<br>";
var_dump($boolVar);
echo "<br>";
var_dump($floatVar);
echo "<br>";
var_dump($stringVar);
echo "<br><br>";

//----------Завдання 3----------
$firstVar = "Hello";
$secondVar = "World";
$thirdVar = $firstVar . " " . $secondVar;// " " - пробіл
echo $thirdVar . "<br><br>";

//--------Завдання 4--------------
$myVar = 8;
if ( $myVar % 2 == 0){
    echo "парне" . "<br>";
}else{
    echo "непарне";
}
echo "<br><br>";
//-------------Завдання 5---------------

echo "Числа від 1 до 10 (for):<br>";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br><br>";

echo "Числа від 10 до 1 (while):<br>";
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br><br>";

//----------------Завдання 6----------------

$student = [
    "name" => "Вікторія",
    "surname" => "Гуріна",
    "age" => 19,
    "specialty" => "Комп’ютерні науки"
];

// вивід масиву
echo "Інформація про студента:<br>";
foreach ($student as $key => $value) {
    echo ucfirst($key) . ": " . $value . "<br>";
}

// додавання нового елемента
$student["average_grade"] = 85;

echo "<br>Оновлений масив:<br>";
print_r($student);

?>




