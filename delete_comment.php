<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$answer_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM posts WHERE id=? AND user_id=?");
$stmt->execute([$answer_id,$user_id]);

header("Location: ".$_SERVER['HTTP_REFERER']);