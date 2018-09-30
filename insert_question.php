<?php
include_once './database.php';
include_once './session.php';
$title = $_POST['title'];
$content = $_POST['content'];
$topic_id = $_POST['topic_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO posts (title,content,topic_id,user_id) "
                            . "VALUES (?,?,?,?)");
        $stmt->execute([$title,$content,$topic_id,$user_id]);
        
$id = $pdo->lastInsertId();

$stmtRel = $pdo->prepare("INSERT INTO users_posts(post_id, user_id, rating, subscribed) "
                       . " VALUES(?,?,?,?)");
$stmtRel->execute([$id, $user_id, 1, 0]);

header('Location: display_question.php?id='.$id);