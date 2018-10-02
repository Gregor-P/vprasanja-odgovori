<?php
include_once './database.php';
include_once './session.php';

$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];


/* Vsi potrebni SQL stavki za brisanje objav, izbrišejo se še vsi komentarji na njih
   in vse relacije v users_posts
*/

$stmtOne = $pdo->prepare("DELETE FROM users_posts WHERE post_id=?");
$stmtOne->execute([$post_id]);

$stmtTwo = $pdo->prepare("DELETE FROM posts WHERE parent_id=?");
$stmtTwo->execute([$post_id]);

$stmtFour = $pdo->prepare("DELETE FROM users_posts WHERE post_id = ?");
$stmtFour->execute([$post_id]);

$stmtThree = $pdo->prepare("DELETE FROM posts WHERE id=?");
$stmtThree->execute([$post_id]);


header("Location: ".$_SERVER['HTTP_REFERER']);