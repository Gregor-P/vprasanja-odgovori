<?php
    include_once './session.php';
    include_once './database.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if (!empty($email) && !empty($pass)) {
        //pripravimo geslo
        $pass = sha1($salt.$pass);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND pass=?");
        $stmt->execute([$email,$pass]);
        $row = $stmt->fetch();
        if(!$row){
            //preusmeritev na login
            //header("Location: login.php");
            echo 'retard';
        }
        else {
            //vse je ok - naredi prijavo
            //rezultat select stavka - shrani v array
            
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
<<<<<<< HEAD
<<<<<<< HEAD
            $_SESSION['admin'] = $row['admin'];
=======
            //$_SESSION['admin'] = $row['admin']; !!!!!!!!!!!!!!!!!!
>>>>>>> 34accd439fe91e46d725a9328c10e59e996b6731
=======
            //$_SESSION['admin'] = $row['admin']; !!!!!!!!!!!!!!!!!!
>>>>>>> 34accd439fe91e46d725a9328c10e59e996b6731
            //preusmeritev na login
            header("Location: index.php");
        }
    }
    else {
        //preusmeritev na login
        header("Location: login.php");
    }
?>