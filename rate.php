<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$rating = $_POST['rating'];
echo $rating;

$stmt = $pdo->prepare("SELECT * FROM users_posts WHERE user_id=? AND post_id=?");
$stmt->execute([$user_id,$post_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    $stmt = $pdo->prepare("UPDATE users_posts SET rating=? WHERE post_id = ? AND user_id=? ");
    switch($rating){
        case $row['rating']:
            $stmt->execute([0,$post_id, $user_id]);
            break;
        case 1:
            $stmt->execute([1,$post_id, $user_id]);
            break;
        case -1:
            $stmt->execute([-1,$post_id, $user_id]);
            break;
    }
}
else{
        $stmt = $pdo->prepare("INSERT INTO users_posts(user_id, post_id, subscribed, rating) "
                            . "VALUES (?,?,?,?)");
        $stmt->execute([$user_id, $post_id, 0, 1]);
}


$stmtCount = $pdo->prepare("SELECT sum(rating) FROM users_posts WHERE post_id = ?");
$stmtCount->execute([$post_id]);
$sum = $stmtCount->fetch(PDO::FETCH_NUM);

$stmtInsert = $pdo->prepare("UPDATE posts SET ratings=? WHERE id=?");
$stmtInsert->execute([$sum[0],$post_id]);

header("Location: ". $_SERVER['HTTP_REFERER']);
 