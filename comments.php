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

$stmt = $pdo->prepare("SELECT *,a.id AS answer_id FROM posts a "
        . "INNER JOIN users u ON u.id = a.user_id "
        . "WHERE parent_id =?");
$stmt->execute([$id]);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
echo '<div class="question-block" class="comment">';                        //question-block (div)

//number of upvotes

//upvote button
echo '<p id="content">' . $row['content'] . '</p>';         //content

echo '<p id="user-time">';                                  //user-time
echo '<a href="">' . $row['username'] . '</a>';
echo ' | '.$row['timestamp'];
echo '</p>';

echo '</div>';
}
