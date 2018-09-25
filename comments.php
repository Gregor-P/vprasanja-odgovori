<?php

include_once './session.php';


function commentForm($answer_id){                 //prikaže form za pisanje komentarja
    if(isset($_SESSION['user_id'])){
        echo '

        <form action="insert_comment.php" method="POST">
            <input type="hidden" name="parent_id" value="'. $answer_id .'"/>

            <textarea required="required" id="comment-field" name="comment" rows="3" cols="50" style="resize:none;"></textarea>
            <br/>
            <input type="submit" value="Odgovori"/>
        </form>';
    }
}

function upvoteForm($post_id){
        if(isset($_SESSION['user_id'])){
        echo '  <form class="rating" action="rate.php" method="POST">
                    <input type="hidden" name="post_id" value="'. $post_id.'" />
                    <input type="submit" name="1" value=" " />
                </form>';
        }
}

function commentBlock(PDO $pdo, $row, $isReply = 0, $onIndex = 0){   
    if($isReply == 1){
        echo '<span class="comment"><div class="question-block">';
    }
    else{
        $stmt = $pdo->prepare("SELECT count(id) FROM users_posts "
                    . "WHERE post_id = ? "
                    . "AND rating = 1");
        $stmt->execute([$row['post_id']]);
        $vote_count = $stmt->fetch(PDO::FETCH_NUM);
        echo '<div class="question-block">'; 
        if($onIndex == 0){
            upvoteForm($row['post_id']);
        }
        echo '<span class="votes-num">'. $vote_count[0] . '</span> | ';
        echo '<a id="question-title" href="display_question.php?id='.$row['post_id'].'">'. $row['title']. '</a>';
    }
    
    
    if(isset($_SESSION['user_id'])){ 
        
        if($row['user_id']==$_SESSION['user_id'] || $_SESSION['admin'] == 1){
            echo '<a style="float: right;" href="delete_comment.php?id='. $row['post_id'] .'"> X </a>';
            echo '<br/>';
        } 
    }
  
    echo '<p id="content">' . $row['content'] . '</p>';     //content
    echo '<p id="user-time">';                                  //user-time
    if($_SESSION['google'] == 'google'){
            echo '<a href="">' . $row['first_name'] . " " . $row['last_name'] . '</a> | '.$row['timestamp'];
    }
    else{
    echo '<a href="">' . $row['username'] . '</a> | '.$row['timestamp'];
    }
    echo '</p> </div>';
    if($isReply == 1){
        echo '</span>';
    }
}


function displayComments(PDO $pdo, $post_id){
    $stmt = $pdo->prepare("SELECT *,a.id AS post_id FROM posts a "
                        . "INNER JOIN users u ON u.id = a.user_id "
                        . "WHERE parent_id =?");
    $stmt->execute([$post_id]);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        commentBlock($pdo, $row);
        
        $stmtNew = $pdo->prepare("SELECT *,a.id AS post_id FROM posts a "
                            . "INNER JOIN users u ON u.id = a.user_id "
                            . "WHERE parent_id =?");
        $stmtNew->execute([$row['post_id']]);
        while($replies = $stmtNew->fetch(PDO::FETCH_ASSOC)){
            commentBlock($pdo, $replies, 1);
        }
        commentForm($row['post_id']);
    }
}


