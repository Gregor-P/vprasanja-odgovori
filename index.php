
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
}
else{
    $sortBy = 'rating';
}

    if(isset($_SESSION['user_id'])){
        echo '<a class="ask-question" href="add_question.php"> vprašaj kaj</a>';
    }else{
        echo '<a href="login.php" class="ask-question" id="not-signed-in"> Prijavi se! </a>';
    }
    
    $string = "SELECT *,p.id AS post_id FROM posts p"           //ustvari sql string in mu doda izbiro teme
            . " INNER JOIN users u ON u.id = p.user_id "       
            . $izbrano . " AND parent_id IS NULL";
    
    
    switch ($sortBy){                                           //glede na izbiro še doda sortiranje vprašanj
        case 'rating':
            $string = $string . " ORDER BY ratings DESC";       //TODO: ASC in DESC
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
