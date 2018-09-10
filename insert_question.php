<?php

$title = $_POST['title'];
$content = $_POST['content'];
$topic_id = $_POST['topic_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO questions (title,content,topic_id,user_id) "
                            . "VALUES (?,?,?,?)");
        $stmt->execute([$title,$content,$topic_id,$user_id]);
        