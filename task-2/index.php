<?php
function countTuesdaysBetweenDates($startDate, $endDate) {
    // Преобразование дат в объекты DateTime
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    // Найти первый вторник после начальной даты
    $start->modify('next tuesday');

    // Найти последний вторник перед конечной датой
    $end->modify('last tuesday');

    // Посчитать количество вторников между начальной и конечной датами
    $interval = new DateInterval('P7D');
    $tuesdayCount = 0;
    while ($start <= $end) {
        $tuesdayCount++;
        $start->add($interval);
    }

    return $tuesdayCount;
}

// Пример использования функции
$startDate = '2024-03-01';
$endDate = '2024-03-31';
echo "Количество вторников между $startDate и $endDate: " . countTuesdaysBetweenDates($startDate, $endDate);
?>
