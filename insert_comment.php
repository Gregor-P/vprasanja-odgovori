<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$content = $_POST['comment'];
$parent_id = $_POST['parent_id'];

$stmt = $pdo->prepare("INSERT INTO posts (content, user_id, parent_id) "
                    . "VALUES (?,?,?)");
        $stmt->execute([$content,$user_id,$parent_id]);
        
header('Location: '.$_SERVER['HTTP_REFERER']);
