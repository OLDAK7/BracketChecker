<?php

// Подключаем автозагрузчик Composer
require '../bracket-validator/vendor/autoload.php';

// Используем класс BracketValidator из библиотеки
use BracketValidator\BracketValidator;

// Проверяем, передан ли путь к файлу в аргументах командной строки
if ($argc < 2) {
    echo "Использование: php cli.php <путь_к_файлу>\n";
    exit(1); // Завершаем программу с кодом ошибки
}

// Получаем путь к файлу из аргументов
$filePath = $argv[1];

// Проверяем, существует ли файл
if (!file_exists($filePath)) {
    echo "Файл не найден: $filePath\n";
    exit(1);
}

// Читаем содержимое файла
$string = file_get_contents($filePath);

// Используем библиотеку для проверки корректности скобок
try {
    $result = BracketValidator::isValid($string);
    echo $result ? "Строка корректна.\n" : "Строка некорректна.\n";
} catch (InvalidArgumentException $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}
