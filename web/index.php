<html lang="ru">
<head>
    <title>Тестовое задание</title>
</head>
<body style='background-color: #282a38; color: #ffffff;'>
<?php

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

use classes\DTO;
use classes\Handler;

$context = new DTO();
$hand = new Handler();
$context->firstNumber = rand(0, 1000);
$context->secondNumber = rand(0, 1000);
$hand->handle($context);
if (empty($context->logAccept)) {
    echo("Последовательность для чисел {$context->firstNumber} и {$context->secondNumber} не найдена.");
}

if (!empty($context->logAccept)) {
    echo("Найдена удачная комбинация:<br>");
    echo("Число 1 — {$context->firstNumber}<br>");
    echo("Число 2 — {$context->secondNumber}<br>");
    echo("Последовательность действий:<br>");
    foreach ($context->logAccept as $action) {
        echo("{$action[1]} ");
    }
    echo("<br>Выполнено итераций {$context->countIterations}<br>");
    echo("Лог выполнения:<br>");

    foreach ($context->logAccept as $value) {
        echo("Текущий результат {$value[0]}<br>Выполнено действие: {$value[1]}. Результат {$value[2]}<br>");
    }
    echo("Неудачные комбинации:");
    foreach ($context->logAttempts as $array) {
        echo("<br>");
        foreach ($array as $value) {
            echo("{$value} ");
        }
    }
}
?>
</body>
</html>