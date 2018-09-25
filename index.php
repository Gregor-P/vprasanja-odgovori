
<?php
//header
include_once './header.php';
include_once './comments.php';

if(!isset($_GET['izbrano'])){
	$_GET['izbrano'] = 0;
}

if(isset($_SESSION['user_id'])){
    echo '<a href="add_question.php" id="ask-question"> VPRASAJ NEKAJ </a>';
}else{
    echo '<p id="not-signed-in">Prijavi se če hočeš kaj vprašati</p>';
}
    if($_GET['izbrano'] == 0 || !isset($_GET['izbrano'])){
        $stmt = $pdo->prepare("SELECT *,p.id AS post_id FROM posts p"
                            . " INNER JOIN users u ON u.id = p.user_id"
                            . " WHERE topic_id IS NOT NULL AND parent_id IS NULL"
                            . " ORDER BY p.timestamp DESC");
        $stmt->execute();
    }
    else{
        $stmt = $pdo->prepare("SELECT *,p.id AS post_id FROM posts p"
                            . " INNER JOIN users u ON u.id = p.user_id"
                            . " WHERE topic_id=? "
                            . " ORDER BY p.timestamp DESC");
        $stmt->execute([$_GET['izbrano']]);
    }
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        commentBlock($pdo, $row, 0, 1);
    }


//footer
include_once './footer.php';
?>
