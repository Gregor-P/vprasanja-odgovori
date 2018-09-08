<?php
    include_once './header.php';
    
    $user_id = $_SESSION['user_id'];
    
    
        $stmt = $link->prepare("SELECT username,name,last_name,email FROM users WHERE id=?;");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
?>

<h1></h1>

<form action="user_update.php" method="post">
    <input value="<?php echo $row['username']?>" type="text" name="username" placeholder="Ime" required="required" />
    <br/>
    <input value="<?php echo $row['name']?>" type="text" name="name" placeholder="Ime" required="required" />
    <br/>
    <input value="<?php echo $row['last_name']?>" type="text" name="last_name" placeholder="Priimek" required="required" />
    <br/>
    <input value="<?php echo $row['email']?>" type="email" name="email" placeholder="E-pošta" required="required" />
    <br/>
    <input type="password" name="pass1" placeholder="Geslo" required="required" />
    <br/>
    <input type="password" name="pass2" placeholder="Geslo ponovno" required="required" />
    <br/>
    <input type="submit" value="Spremeni" />
</form>
