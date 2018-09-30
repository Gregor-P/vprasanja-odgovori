
<?php
//header
include_once './header.php';
include_once './comments.php';


if(!isset($_GET['izbrano']) || $_GET['izbrano'] == 0){
    $izbrano = " WHERE 1 ";
}
else{
    $izbrano = " WHERE topic_id = ". $_GET['izbrano'];
}


if(isset($_GET['sortBy'])){
    $sortBy = $_GET['sortBy'];
    echo $sortBy;
}
else{
    $sortBy = 'rating';
}





    if(isset($_SESSION['user_id'])){
        echo '<p id="ask-question"><a href="add_question.php"> VPRAŠAJ NEKAJ </a></p>';
    }else{
        echo '<p id="not-signed-in"> Prijavi se če hočeš kaj vprašati </p>';
    }
    
    $string = "SELECT *,p.id AS post_id FROM posts p"
            . " INNER JOIN users u ON u.id = p.user_id"
            . " INNER JOIN users_posts s ON s.post_id = p.id"
            . $izbrano . " AND parent_id IS NULL";
    
    
    switch ($sortBy){
        case 'rating':
            $string = $string . " ORDER BY sum(s.id) DESC";
            break;
        case 'time':
            $string = $string . " ORDER BY p.timestamp DESC";
            break;
    }
    $stmt = $pdo->prepare($string);

    $stmt->execute();


    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($row['id'] !== NULL){
        commentBlock($pdo, $row, 0, 1);
        }
    }

//footer
include_once './footer.php';
?>
