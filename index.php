
<?php
//header
include_once './header.php';


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
                            . " WHERE topic_id IS NOT NULL");
        $stmt->execute();
    }
    else{
        $stmt = $pdo->prepare("SELECT *,p.id AS post_id FROM posts p"
                            . " INNER JOIN users u ON u.id = p.user_id"
                            . " WHERE topic_id=?");
        $stmt->execute([$_GET['izbrano']]);
    }

    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        echo '<br/><div class="question-block">';
        
        $stmt = $pdo->prepare("SELECT count(id) FROM users_posts "
                            . "WHERE post_id = ? "
                            . "AND rating = 1");
        $stmt->execute([$row['post_id']]);
        $vote_count = $stmt->fetch(PDO::FETCH_NUM);
        

        echo '<span class="votes-num">'. $vote_count[0] . '</span> | ';
        
        echo '<a id="question-title" href="display_question.php?id='.$row['post_id']
            .'">'. $row['title']. '</a>';

        echo '<p id="content">' . $row['content'] . '</p>';         //content

        echo '<p id="user-time">';                                  //user-time
        echo '<a href="">' . $row['username'] . '</a>';
        echo ' | '.$row['timestamp'];
        echo '</p>';

        echo '</div></a>';
    }


//footer
include_once './footer.php';
?>
