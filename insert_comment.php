<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$answer = $_POST['comment'];
$question_id = $_POST['question_id'];

$stmt = $pdo->prepare("INSERT INTO posts (content, user_id, parent_id) "
                    . "VALUES (?,?,?)");
        $stmt->execute([$answer,$user_id,$question_id]);
        
header('Location: display_question.php?id='.$question_id);