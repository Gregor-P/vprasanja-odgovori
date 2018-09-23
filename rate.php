<?php
include_once './database.php';
include_once './session.php';

$rating = $_POST['rating'];
$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];


$stmt = $pdo->prepare("SELECT * FROM views WHERE user_id=? AND post_id=?");
$stmt->execute([$user_id,$post_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    if($row['rating'] == 1){
        //user has already rated post
        $stmt = $pdo->prepare("INSERT INTO views(answer_id, user_id, rating) VALUES (?,?,?)");
        $stmt->execute([$post_id, $user_id, -1]);
    }
    else{
        //insert row
        $stmt = $pdo->prepare("INSERT INTO views(answer_id, user_id, rating) VALUES (?,?,?)");
        $stmt->execute([$post_id, $user_id, 1]);
    }
}