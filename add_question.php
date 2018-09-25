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
        $stmt = $pdo->prepare("SELECT * FROM topics");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        
        ?>

    </select>
    <br/>
    <input type="submit" value="vprasaj"/>
</form>
<?php
    include_once './footer.php';
?>