<?php
include_once './session.php';
include_once './database.php';

$username = $_POST['username'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];


if (!empty($username) && !empty($email)
        && !empty($pass1) && ($pass1==$pass2)) {
    //vse ok
    $pass = $salt.$pass1;
    $pass = sha1($pass);
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    if(!$row){
        $stmt = $pdo->prepare("INSERT INTO users (username,pass,email,first_name,last_name) "
                            . "VALUES (?,?,?,?,?)");
        $stmt->execute([$username,$pass,$email,$name,$last_name]);
    }
    else{
        header("Location: registration.php?error=1");
    }
    
}
else {
    //preusmeritev nazaj
    header("Location: registration.php");
}

header("Location: login.php");

?>