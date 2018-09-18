
<?php
include_once './database.php';
include_once './session.php';
include_once './header.php';

$id = $_GET['id'];




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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    //rating script

    
</script>
<form>
    <input type="button" value="click" id="btn" />
</form>


<?php

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT question_id FROM views WHERE user_id=? AND question_id=?");
    $stmt->execute([$user_id, $id]);
    $row = $stmt->fetch();
    
    if(!$row){
        $stmt = $pdo->prepare("INSERT INTO views(user_id, question_id, subscribed) VALUES (?,?,?)");
        $stmt->execute([$user_id, $id, 0]);
    }
    include_once './comments.php';
}
