<?php
    include_once './session.php';
    include_once './database.php';
?>

<html>
    <nav id="header">
        <link rel="stylesheet" type="text/css" href="./style.css" /> 
        <meta charset="UTF-8"/>
<?php
    
    if(isset($_SESSION['user_id'])){
        echo 'Pozdravljeni <a href="user.php">' . $_SESSION['username'] . '</a>';

        if($_SESSION['admin'] == 1){
            echo '<i>(admin)</i>';
        }
        echo '<a href="index.php" class="header-btn">Domov</a>';
        echo '<a href="logout.php" class="logout-btn">Izpis </a>';

    }
    else{
        echo '<a href="index.php" class="header-btn">Domov</a>';
        echo '<a href="registration.php" class="header-btn"> Registracija </a>';
        echo '<a href="login.php" class="header-btn"> Prijava </a>';
    }

?>
    </nav>
</html>