<?php
include_once './database.php';
include_once './session.php';

$rating = $_POST['rating'];
$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

/* change the database structure
 * so ratings can be applies to both questions and answers
 * merge questions/answers and views/ratings
 * retard!
 */

$stmt = $pdo->prepare("SELECT * FROM ratings WHERE user_id=? AND answer_id=?");
$stmt->execute([$user_id,$post_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(isset($row['id'])){
    //user has already rated post
}
else{
    //insert row
    $stmt = $pdo->prepare("INSERT INTO ratings(answer_id, user_id, rating) VALUES (?,?,?)");
    $stmt->execute([$post_id, $user_id, $rating]);
}

