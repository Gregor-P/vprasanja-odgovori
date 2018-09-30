<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];


$stmt = $pdo->prepare("SELECT * FROM users_posts WHERE user_id=? AND post_id=?");
$stmt->execute([$user_id,$post_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    if($row['rating'] == 1){
        //user has already rated post
        $stmt = $pdo->prepare("UPDATE users_posts SET rating=? WHERE post_id = ? AND user_id=? ");
        $stmt->execute([-1,$post_id, $user_id]);
    }
    else{
        //insert row, rating = 1
        $stmt = $pdo->prepare("UPDATE users_posts SET rating=? WHERE post_id  = ? AND user_id=? ");
        $stmt->execute([1,$post_id, $user_id]);
    }
}
else{
        $stmt = $pdo->prepare("INSERT INTO users_posts(user_id, post_id, subscribed, rating) "
                            . "VALUES (?,?,?,?)");
        $stmt->execute([$user_id, $post_id, 0, 1]);
}

header("Location: ". $_SERVER['HTTP_REFERER']);