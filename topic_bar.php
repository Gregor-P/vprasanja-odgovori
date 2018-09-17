<?php


    echo '<nav id="topics-bar">';
    echo '<a href="index.php?izbrano=0" class="topic">vse</a>';
    
    $stmt = $pdo->prepare("SELECT * FROM topics;");
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<a href="index.php?izbrano='.$row['id'].'" class="topic">'.$row['name'].'</a>';		
    }
    echo '</nav>';