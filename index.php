<?php
//header
include_once './header.php';


if(!isset($GET['izbrano'])){
	$GET['izbrano'] = 0;
}
/*
get all categories and list them here
big "submit question" button
get questions of selected category and list them 
(chronological or by alphabet)
*/
    echo '<nav id="topics-bar">';
    echo '<a href="index.php?izbrano=0" class="topic">vse</a>';
    
    $stmt = $pdo->prepare("SELECT * FROM topics;");
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<a href="index.php?izbrano='.$row['id'].'" class="topic">'.$row['name'].'</a>';		
    }
    echo '</nav>';
?>

<a href="add_question.php"> VPRASAJ NEKAJ </a>

<?php
//footer
include_once './footer.php';
?>
