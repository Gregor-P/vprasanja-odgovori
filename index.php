
<?php
//header
include_once './header.php';


if(!isset($_GET['izbrano'])){
	$_GET['izbrano'] = 0;
}

if(isset($_SESSION['user_id'])){
    echo '<a href="add_question.php" id="ask-question"> VPRASAJ NEKAJ </a>';
}else{
    echo '<p>Prijavi se če hočeš kaj vprašati</p>';
}
    if($_GET['izbrano'] == 0 || !isset($_GET['izbrano'])){
        $stmt = $pdo->prepare("SELECT * FROM questions;");
        $stmt->execute();
        
    }else{
        $stmt = $pdo->prepare("SELECT * FROM questions WHERE topic_id=?;");
        $stmt->execute([$_GET['izbrano']]);
    }

    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<br/><div class="question-block">';
	echo '<a href="display_question.php?id='.$row['id'].'" class="question-title">'.$row['question'].'</a>';		
        echo '<br/>';
        echo '<p>'.$row['content'].'</p>';
        echo '</div>';
    }


//footer
include_once './footer.php';
?>
