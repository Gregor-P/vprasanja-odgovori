<?php
    include_once './header.php';

?>
<h1>Registracija</h1>

<form action="user_insert.php" method="post">
<<<<<<< HEAD
    <input type="text" name="username" placeholder="Uporabniško ime" required="required" /> *
    <br/>
    <input type="text" name="name" placeholder="Ime"/>
=======
    <input type="text" name="username" placeholder="Uporabniško Ime" required="required" />
    <br/>
    <input type="text" name="name" placeholder="Ime" />
    <br/>
    <input type="text" name="last_name" placeholder="Priimek" />
>>>>>>> 34accd439fe91e46d725a9328c10e59e996b6731
    <br/>
    <input type="text" name="last_name" placeholder="Priimek" />
    <br/>
    <input type="email" name="email" placeholder="E-pošta" required="required" />*
    <br/>
    <input type="password" name="pass1" placeholder="Geslo" required="required" />*
    <br/>
    <input type="password" name="pass2" placeholder="Geslo ponovno" required="required" />*
    <br/>
    <input type="submit" value="Registriraj" />
</form>


<?php
    if(isset($_GET['error'])){
        echo '<p>Ta e-poštni naslov je že zaseden!</p>';
    }
    include_once './footer.php';
?>