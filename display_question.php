
<?php
include_once './database.php';
include_once './session.php';
include_once './header.php';
include_once './comments.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT *,t.name AS topic_name,q.id AS post_id "
                    . "FROM posts q "
                    . "INNER JOIN users u ON q.user_id = u.id "
                    . "INNER JOIN topics t ON q.topic_id = t.id "
                    . "WHERE q.id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row){ //če post ne obstaja te vrne na index oz. če query ni uspel
    header("Location: index.php");
}

echo '<a id="post-topic" href="index.php?izbrano='.$row['topic_id'].'"> << Nazaj na '.$row['topic_name'].'</a>'; 
echo '<br/><br/>';
echo '<a id="sub" href="subscribe.php?post_id='.$id.'"> ⭐Sledi temu vprašanju </a>'; 

commentBlock($pdo, $row);



if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    //če še ne obstaja ustvari row v tabeli users_posts, kjer se lahko
    //zapiše če je user všečkal objavo in ali je subscrajban 
    
    $stmt = $pdo->prepare("SELECT post_id FROM users_posts WHERE user_id=? AND post_id=?");
    $stmt->execute([$user_id, $id]);
    $row = $stmt->fetch();
    
    if(!$row){
        $stmt = $pdo->prepare("INSERT INTO users_posts(user_id, post_id, subscribed) VALUES (?,?,?)");
        $stmt->execute([$user_id, $id, 0]);
    }
    commentForm($id);
    
    displayComments($pdo, $id);

}
