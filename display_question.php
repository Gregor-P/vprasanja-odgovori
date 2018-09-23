
<?php
include_once './database.php';
include_once './session.php';
include_once './header.php';

$id = $_GET['id'];




$stmt = $pdo->prepare("SELECT *,t.name AS topic_name FROM posts q "
        . "INNER JOIN users u ON q.user_id = u.id "
        . "INNER JOIN topics t ON q.topic_id = t.id "
        . "WHERE q.id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo '<p id="post-topic">'.$row['topic_name'].'</p>';       //post-topic

echo '<div class="question-block">';                        //question-block (div)


//number of upvotes
echo '  <p id="question-title"> | '. $row['title'] . '</p>';  //question-title

//upvote button
echo '<p id="content">' . $row['content'] . '</p>';         //content

echo '<p id="user-time">';                                  //user-time
echo '<a href="">' . $row['username'] . '</a>';
echo ' | '.$row['timestamp'];
echo '</p>';

echo '</div>';

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    //rating script

    
</script>
<form>
    <input type="button" value="click" id="btn" />
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
    include_once './comments.php';
}
