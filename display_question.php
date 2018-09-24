
<?php
include_once './database.php';
include_once './session.php';
include_once './header.php';
include_once './comments.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT *,t.name AS topic_name FROM posts q "
        . "INNER JOIN users u ON q.user_id = u.id "
        . "INNER JOIN topics t ON q.topic_id = t.id "
        . "WHERE q.id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo '<p id="post-topic">'.$row['topic_name'].'</p>';       //post-topic


echo '<div class="question-block">';                        //question-block (div)

$stmt = $pdo->prepare("SELECT count(id) FROM users_posts "
                    . "WHERE post_id = ? "
                    . "AND rating = 1");
$stmt->execute([$id]);
$vote_count = $stmt->fetch(PDO::FETCH_NUM);

echo '<span class="votes-num">'. $vote_count[0] . '</span> | ';
        
echo '<span id="question-title">'. $row['title']. '</span>';

//upvote button
echo '<p id="content">' . $row['content'] . '</p>';         //content

echo '<p id="user-time">';                                  //user-time
echo '<a href="">' . $row['username'] . '</a>';
echo ' | '.$row['timestamp'];
echo '</p>';

echo '</div>';

?>

<form id="rating" action="rate.php" method="POST">
    <input type="hidden" name="post_id" value="<?php echo $id; ?>" />
    <input type="submit" name="1" value="1" />
</form>    

<?php

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

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
