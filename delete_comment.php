<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];


$stmtOne = $pdo->prepare("DELETE FROM users_posts WHERE post_id=?");
$stmtOne->execute([$post_id]);
$stmtTwo = $pdo->prepare("DELETE FROM posts WHERE parent_id=?");
$stmtTwo->execute([$post_id]);

if($_SESSION['admin'] == 1){
    $stmtThree = $pdo->prepare("DELETE FROM posts WHERE id=?");
    $stmtThree->execute([$post_id]);
}
else{

    $stmtThree = $pdo->prepare("DELETE FROM posts WHERE id=? AND user_id=?");
    $stmtThree->execute([$post_id,$user_id]);
}

header("Location: ".$_SERVER['HTTP_REFERER']);