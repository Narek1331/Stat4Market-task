<?php
// Подключение к базе данных PostgreSQL
$dsn = "pgsql:host=localhost;dbname=your_database_name;user=your_username;password=your_password";
try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Задача 1: Выборка пользователей, у которых количество постов больше, чем у пользователя, который их пригласил
$query1 = "SELECT u.*
           FROM users u
           JOIN users i ON u.invited_by_user_id = i.id
           WHERE u.posts_qty > i.posts_qty";
$stmt1 = $pdo->query($query1);
$users1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Задача 2: Выборка пользователей, имеющих максимальное количество постов в своей группе
$query2 = "SELECT u.*
           FROM users u
           JOIN (
               SELECT group_id, MAX(posts_qty) AS max_posts
               FROM users
               GROUP BY group_id
           ) AS max_posts_per_group ON u.group_id = max_posts_per_group.group_id AND u.posts_qty = max_posts_per_group.max_posts";
$stmt2 = $pdo->query($query2);
$users2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Задача 3: Выборка групп, количество пользователей в которых превышает 10000
$query3 = "SELECT group_id, COUNT(*) AS user_count
           FROM users
           GROUP BY group_id
           HAVING COUNT(*) > 10000";
$stmt3 = $pdo->query($query3);
$groups = $stmt3->fetchAll(PDO::FETCH_ASSOC);

// Задача 4: Выборка пользователей, у которых пригласивший их пользователь из другой группы
$query4 = "SELECT u.*
           FROM users u
           JOIN users i ON u.invited_by_user_id = i.id
           WHERE u.group_id != i.group_id";
$stmt4 = $pdo->query($query4);
$users4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

// Вывод результатов или их обработка
// Пример вывода для задачи 1
echo "Результаты задачи 1:<br>";
foreach ($users1 as $user) {
    echo "ID: " . $user['id'] . ", Name: " . $user['name'] . ", Posts Quantity: " . $user['posts_qty'] . "<br>";
}
?>
