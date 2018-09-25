<?php
include_once './database.php';
include_once './session.php';

$post_id = $_GET['post_id'];
$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("SELECT subscribed FROM users_posts WHERE user_id =? AND post_id = ?");
$stmt->execute([$user_id, $post_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sub = $row['subscribed'];

if($sub == 0){
    $stmt = $pdo->prepare("UPDATE users_posts SET subscribed=? WHERE post_id  = ? AND user_id=? ");
    $stmt->execute([1,$post_id, $user_id]);
}
else{
    $stmt = $pdo->prepare("UPDATE users_posts SET subscribed=? WHERE post_id  = ? AND user_id=? ");
    $stmt->execute([0,$post_id, $user_id]);
}

header("Location: ". $_SERVER['HTTP_REFERER']);