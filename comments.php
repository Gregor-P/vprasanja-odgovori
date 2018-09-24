<?php

include_once './session.php';


function commentForm($answer_id){                 //prikaže form za pisanje komentarja
    if(isset($_SESSION['user_id'])){
        echo '

        <form action="insert_comment.php" method="POST">
            <input type="hidden" name="parent_id" value="'. $answer_id .'"/>

            <textarea id="comment-field" name="comment" rows="3" cols="50" style="resize:none;"></textarea>
            <br/>
            <input type="submit" value="Odgovori"/>
        </form>';
    }
}

function commentBlock($row, $isReply = 0){
    if($isReply == 1){
        echo '<div class="question-block" class="comment">';
    }
    else{
        echo '<div class="question-block">';       //question-block (div)
    }
    //upvote button goes here 
    echo '<p id="content">' . $row['content'] . '</p>';         //content
    echo '<hr/>';
    echo '<p id="user-time">';                                  //user-time
    echo '<a href="">' . $row['username'] . '</a>';
    echo ' | '.$row['timestamp'];

    if($row['user_id']==$_SESSION['user_id'] || $_SESSION['admin'] == 1){
        echo '<a style="float: right;" href="delete_comment.php?id='. $row['answer_id'] .'">izbriši</a>';
        echo '<br/>';
    }
       echo '</p>';
    echo '</div>';
}


function displayComments(PDO $pdo, $post_id){
    $stmt = $pdo->prepare("SELECT *,a.id AS answer_id FROM posts a "
                        . "INNER JOIN users u ON u.id = a.user_id "
                        . "WHERE parent_id =?");
    $stmt->execute([$post_id]);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        commentBlock($row);
        
        $stmt = $pdo->prepare("SELECT *,a.id AS answer_id FROM posts a "
                            . "INNER JOIN users u ON u.id = a.user_id "
                            . "WHERE parent_id =?");
        $stmt->execute([$row['answer_id']]);
        while($replies = $stmt->fetch(PDO::FETCH_ASSOC)){
            commentBlock($replies, 1);
        }
        commentForm($row['answer_id']);
    }
}


