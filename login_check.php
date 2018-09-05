<?php
    include_once './session.php';
    include_once './database.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if (!empty($email) && !empty($pass)) {
        //pripravimo geslo
        $pass = sha1($salt.$pass);
        $query = "SELECT * FROM uporabniki WHERE email='$email' AND geslo='$pass'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) != 1) {
            //preusmeritev na login
            header("Location: login.php");
        }
        else {
            //vse je ok - naredi prijavo
            //rezultat select stavka - shrani v array
            $user = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['ime'] = $user['ime'];
            $_SESSION['priimek'] = $user['priimek'];
            $_SESSION['admin'] = $user['admin'];
            //preusmeritev na login
            header("Location: index.php");
        }
    }
    else {
        //preusmeritev na login
        header("Location: login.php");
    }
?>