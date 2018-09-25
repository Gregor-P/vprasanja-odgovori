<?php
    include_once './header.php';
    
    if(isset($_SESSION['user_id'])){
        header("Location: index.php");
    }
    
    
    include_once './googleLogin.php';
?>

<h1>Prijava</h1>

<form action="login_check.php" method="post">
    <label>E-pošta: </label>
    <input type="email" name="email" required="required" />
    <br/>
    <label>Geslo: </label>
    <input type="password" name="pass" required="required" />
    <br />
    <input type="submit" value="Prijavi" />
</form>


<?php
    include_once './footer.php';
?>