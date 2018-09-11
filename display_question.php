<?php
include_once './database.php';
include_once './session.php';
include_once './header.php';
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT *,t.name AS topic_name FROM questions q "
        . "INNER JOIN users u ON q.user_id = u.id "
        . "INNER JOIN topics t ON q.topic_id = t.id "
        . "WHERE q.id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    
echo $row['question'];
echo '<br/>';

echo $row['content'];
echo '<br/>';

echo $row['topic_name'];
echo '<br/>';

echo $row['username'];

include_once './comments.php';