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

$stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id =?");
$stmt->execute([$id]);
while($comment = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $comment['answer'] ."<br/>";
}
