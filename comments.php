<?php
include_once './database.php';
include_once './session.php';

if(isset($_SESSION['user_id'])){
    ?>

    <form action="insert_comment.php" method="POST">
        <input type="hidden" name="question_id" value="<?php echo $id;?>"/>
        
        <textarea id="comment-field" name="comment" rows="8" cols="50" style="resize:none;"></textarea>
        <br/>
        <input type="submit" value="Komentiraj"/>
    </form>

    <?php
}

$stmt = $pdo->prepare("SELECT *,a.id AS answer_id FROM answers a "
        . "INNER JOIN users u ON u.id = a.user_id "
        . "WHERE question_id =?");
$stmt->execute([$id]);

while($comment = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo '<div class="comment">';
    echo $comment['username'] .'<br/>';
    echo $comment['answer'] .'<br/>';
    if($comment['user_id']==$_SESSION['user_id'] || $_SESSION['admin'] == 1){
        echo '<a href="delete_comment.php?id='. $comment['answer_id'] .'">izbriši</a>';
        echo '<br/><br/>';
    }
    echo '</div>';
}
