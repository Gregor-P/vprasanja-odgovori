<?php
    include_once './header.php';
    
    $user_id = $_SESSION['user_id'];
    
    
        $stmt = $link->prepare("SELECT ime,priimek,email FROM uporabniki WHERE id=?;");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
?>

<h1></h1>

<form action="user_update.php" method="post">
    <input value="<?php echo $row['ime']?>" type="text" name="ime" placeholder="Ime" required="required" />
    <br/>
    <input value="<?php echo $row['priimek']?>" type="text" name="priimek" placeholder="Priimek" required="required" />
    <br/>
    <input value="<?php echo $row['email']?>" type="email" name="email" placeholder="E-pošta" required="required" />
    <br/>
    <input type="password" name="pass1" placeholder="Geslo" required="required" />
    <br/>
    <input type="password" name="pass2" placeholder="Geslo ponovno" required="required" />
    <br/>
    <input type="submit" value="Spremeni" />
</form>
