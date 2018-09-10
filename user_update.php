<?php

include_once './session.php';
include_once './database.php';

$username = $_POST['username'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$user_id = $_SESSION['user_id'];

if (!empty($ime) && !empty($priimek) && !empty($email)
        && !empty($pass1) && ($pass1==$pass2)) {
    //vse ok
    $pass = $salt.$pass1;
    $pass = sha1($pass);

    $stmt = $pdo->prepare("UPDATE users SET username=?,pass=?,email=?,name=?,last_name=? WHERE id=?");
    $stmt->execute([$username,$pass,$email,$name,$last_name,$user_id]);

}

header("Location: user.php");