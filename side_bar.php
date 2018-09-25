<?php 
include_once './session.php';
include_once './database.php';
?>

<div id="side-bar">

    <h3>Vaša vprašanja:</h3>

<?php
    $stmt = $pdo->prepare("SELECT title,p.id AS post_id FROM posts p WHERE user_id=? AND title NOT LIKE ''");
    $stmt->execute([$_SESSION['user_id']]);
    echo '<ul>';
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<li><a href="display_post.php?id='.$row['post_id'].'">'.$row['title'].'</a></li>';
    }
    echo '</ul>';
?>
    <h3>Vprašanja ki jim sledite:</h3>
<?php
    $stmt = $pdo->prepare("SELECT * FROM posts p"
            . " INNER JOIN users_posts u ON u.post_id = p.id"
            . " WHERE subscribed = 1");
    $stmt->execute();
    echo '<ul>';
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<li><a href="display_post.php?id='.$row['post_id'].'">'.$row['title'].'</a></li>';
    }
    echo '</ul>';
?>

</div>