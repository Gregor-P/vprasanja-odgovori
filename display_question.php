<?php
include_once './database.php';
include_once './session.php';
include_once './header.php';
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT question_id FROM views WHERE user_id=? AND question_id=?");
$stmt->execute([$user_id, $id]);
$row = $stmt->fetch();
if(!$row){
    $stmt = $pdo->prepare("INSERT INTO views(user_id, question_id, subscribed) VALUES (?,?,?)");
    $stmt->execute([$user_id, $id, 0]);
}

$stmt = $pdo->prepare("SELECT *,t.name AS topic_name FROM questions q "
        . "INNER JOIN users u ON q.user_id = u.id "
        . "INNER JOIN topics t ON q.topic_id = t.id "
        . "WHERE q.id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


echo '<div class="question-block">';
echo $row['question'];
echo '<br/>';

echo $row['username'];
echo '<br/>';

echo $row['content'];
echo '<br/>';

echo $row['topic_name'];
echo '<br/>';

echo '</div>';

?>
<script>
    //rating script
</script>
<form action="rate.php" method="POST">
    <input type="button" name="up" value="like"/>
</form>
<?php

//include_once './comments.php';