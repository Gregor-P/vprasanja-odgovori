<?php
    include_once './session.php';
    include_once './database.php';
?>

<html>

    <body>

    <nav id="header">
        <link rel="stylesheet" type="text/css" href="./style.css" /> 
        <meta charset="UTF-8"/>
<?php
    
    if(isset($_SESSION['user_id'])){
        if(isset($_SESSION['username'])){
            echo 'Pozdravljeni <a href="index.php">' . $_SESSION['username'] . '</a>';
        }
        else {
            echo 'Pozdravljeni <a href="index.php">' . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . '</a>';
        }

        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
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
    if($_SERVER['REQUEST_URI'] == "/vprasanja-odgovori/index.php" || isset($_GET['izbrano'])){
        include_once './topic_bar.php';
    }
   
?>
    </nav>
    <?php 
    if(isset($_SESSION['user_id'])){
        include_once './side_bar.php';
    }
    ?>
    <nav class="center">
