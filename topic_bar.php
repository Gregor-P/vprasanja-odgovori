<?php


    echo '<nav id="topics-bar">';
    echo '<a href="index.php?izbrano=0" class="topic">vse</a>';
    
    $stmt = $pdo->prepare("SELECT * FROM topics;");
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<a href="index.php?izbrano='.$row['id'].'" class="topic">'.$row['name'].'</a>';		
    }
    
    //sort questions by rating, time, number of replies?
    
    ?>
    

    <?php //sestavi URL iz izbire teme in načina razvrščanja
    $url = '/vprasanja-odgovori/index.php';
    
    if(isset($_GET['izbrano'])){
        $izbira = '?izbrano='.$_GET['izbrano'];
    }
    else{
        $izbira = '?izbrano=0';
    }
    
    echo '<span id="sort-by">
        <p>Razvrsti:
        <a href="'.$url.$izbira.'&sortBy=time'.'"> čas </a>
        <a href="'.$url.$izbira.'&sortBy=rating'.'"> rating </a>
        </p>
    </span>';
    
    echo '</nav>';