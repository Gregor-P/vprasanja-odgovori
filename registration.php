<?php
    include_once './header.php';

?>
<h1>Registracija</h1>

<form action="user_insert.php" method="post">
    <input type="text" name="ime" placeholder="Ime" required="required" />
    <br/>
    <input type="text" name="priimek" placeholder="Priimek" required="required" />
    <br/>
    <input type="email" name="email" placeholder="E-pošta" required="required" />
    <br/>
    <input type="password" name="pass1" placeholder="Geslo" required="required" />
    <br/>
    <input type="password" name="pass2" placeholder="Geslo ponovno" required="required" />
    <br/>
    <input type="submit" value="Registriraj" />
</form>


<?php
        if(isset($_GET['error'])){
        echo '<p>Ta e-poštni naslov je že zaseden!</p>';
    }
    include_once './footer.php';
?>