<?php
    include_once './header.php';
?>

<form action="insert_question.php" method="POST">
    <input type="text" name="title" placeholder="Naslov vprasanja" required="required"/>
    <br/>
    <textarea name="content" placeholder="dodatni text" ></textarea>

    <br/>
    <select name="topic_id">
        <?php
        $data = $pdo->query("SELECT * FROM topics")->fetchAll();
        
        while($row){
            echo $row['id'];
        }
        
        ?>
        <option value="1">tema #1</option>
        <option value="2">tema #2</option>
    </select>
    <br/>
    <input type="submit" value="vprasaj"/>
</form>

<?php
    include_once './footer.php';
?>