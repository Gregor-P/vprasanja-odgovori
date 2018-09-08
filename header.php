<?php
    include_once './session.php';
    include_once './database.php';
?>

<html>
    <nav id="header">
        <link rel="stylesheet" type="text/css" href="./style.css" /> 
<?php
    
    if(isset($_SESSION['user_id'])){

        if($_SESSION['admin'] == 1){
            echo 'Pozdravljeni <a href="user.php">' . $_SESSION['username'] . '<i>(admin)</i></a>';
            echo '<a href="index.php">Domov</a>';
        }else{
            echo 'Pozdravljeni <a href="user.php">' . $_SESSION['username'] . '</a>';
            echo '<a href="index.php">Domov</a>';
        }
        echo '<a href="logout.php">Izpis </a>';
    }
    else{
        echo '<a href="registration.php"> Registracija </a>';
        echo '<a href="login.php"> Prijava </a>';
    }




?>
    </nav>
</html>