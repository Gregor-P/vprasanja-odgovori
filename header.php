<?php
    include_once './session.php';
    include_once './database.php';
?>

<html>
    <nav id="header">
        <link rel="stylesheet" type="text/css" href="./style.css" /> 
<?php
    
    if(isset($_SESSION['user_id'])){
        echo 'Pozdravljeni <a href="user.php">' . $_SESSION['username'] . '</a>';
<<<<<<< HEAD
<<<<<<< HEAD
        if($_SESSION['admin'] == 1){
            echo '<i>(admin)</i>';
        }
        echo '<a href="index.php" class="header-btn">Domov</a>';
        echo '<a href="logout.php" class="logout-btn">Izpis </a>';
=======
        if(1){ //DODAJ ADMIN BOOL U BAZO AAA
            echo '<i>(admin)</i>';
        }
=======
        if(1){ //DODAJ ADMIN BOOL U BAZO AAA
            echo '<i>(admin)</i>';
        }
>>>>>>> 34accd439fe91e46d725a9328c10e59e996b6731
            echo '<a href="index.php">Domov</a>';
        echo '<a href="logout.php">Izpis </a>';
>>>>>>> 34accd439fe91e46d725a9328c10e59e996b6731
    }
    else{
        echo '<a href="registration.php" class="header-btn"> Registracija </a>';
        echo '<a href="login.php" class="header-btn"> Prijava </a>';
    }




?>
    </nav>
</html>